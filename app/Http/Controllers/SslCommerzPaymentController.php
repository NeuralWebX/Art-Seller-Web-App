<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Repository\ProductRepository;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Transaction;

class SslCommerzPaymentController extends Controller
{
    protected $products;
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }
    public function exampleEasyCheckout()
    {
        $carts = session()->get('cart');
        return view('ssl.exampleEasycheckout', compact('carts'));
    }

    public function exampleHostedCheckout($id)
    {
        return view('ssl.exampleHosted');
    }

    public function index(OrderRequest $request)
    {
        $carts = session()->get('cart');
        $post_data = array();
        $post_data['total_amount'] = totalPayAble();
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid();
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        try {
            DB::beginTransaction();
            $orderNumber = 'order-' . date('y') . '-' . date('Ymhsis');
            $orderExist = Order::where('order_number', 'like', $orderNumber)->get();
            if ($orderExist->count() > 0) {
                $orderNumber = 'order-' . date('y') . '-' . date('Ymhsis') . '-' . rand(1, 100);
            }
            $order = Order::create([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'order_status' => 'Pending',
                'payment_status' => 'Pending',
                'payment_method' => '',
                'customer_id' => auth()->user()->id,
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'order_number' => $orderNumber,
                'currency' => $post_data['currency']
            ]);
            foreach ($carts as $key => $value) {
                $product = Product::find($value['id']);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $value['id'],
                    'quantity' => 1,
                    'author_id' => Product::find($value['id'])->user_id,
                    'unit_price' => $value['price'],
                    'sub_total' => $value['sub_total'],
                ]);
            }
            // $transaction = Transaction::create([
            //     'author_id' => 1,
            //     'order_id' => $order->id,
            //     'artist_payable' => $post_data['total_amount'] * 80 / 100,
            //     'admin_payable' => $post_data['total_amount'] * 20 / 100,
            //     'admin_paid' => $post_data['total_amount'] * 20 / 100,
            // ]);
            foreach ($carts as $key => $value) {
                $product = Product::find($value['id']);
                $product->update([
                    'sell_status' => 1,
                ]);
            }
            session()->forget('cart');
            DB::commit();
            $sslc = new SslCommerzNotification();
            $payment_options = $sslc->makePayment($post_data, 'hosted');
            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            alert()->error('something went wrong');
            return redirect()->route('backend.shop.index');
        }
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $card_type = $request->input('card_type');
        $currency = $request->input('currency');
        $sslc = new SslCommerzNotification();
        $order_details = Order::with('orderDetails')
            ->where('transaction_id', $tran_id)
            ->first();
        if ($order_details->order_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
            if ($validation) {
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'order_status' => 'Processing',
                        'payment_method' => $card_type,
                        'payment_status' => 'Paid',
                    ]);
                $transactions = [];
                foreach ($order_details->orderDetails as $orderDetail) {
                    $eachProduct = $this->products->show($orderDetail->product_id);
                    $author = $eachProduct->user;
                    $transaction['author_id'] = $author->id;
                    $transaction['order_id'] = $orderDetail->order_id;
                    $transaction['product_id'] = $orderDetail->product_id;
                    $transaction['total_amount'] =
                        $eachProduct->product_price;
                    $transaction['artist_payable'] =
                        $eachProduct->product_price * 80 / 100;
                    $transaction['admin_payable'] = $eachProduct->product_price * 20 / 100;
                    $transaction['admin_paid'] = $transaction['admin_payable'];
                    array_push($transactions, $transaction);
                }
                Transaction::insert($transactions);
            }
        } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {
        } else {
            echo "Invalid Transaction";
        }
        session()->forget('cart');
        alert()->success('Order Placed Successfull');
        return redirect()->route('backend.shop.index');
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->order_status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['order_status' => 'Failed']);
        } else if ($order_details->status == 'Processing' || $order_details->order_status == 'Complete') {
        } else {
            echo "Transaction is Invalid";
        }
        alert()->error('Order Placed Failed');
        return redirect()->route('backend.shop.index');
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'order_status', 'currency', 'amount')->first();

        if ($order_details->order_status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['order_status' => 'Canceled']);
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
        alert()->success('Order Placed Cancelled');
        return redirect()->route('backend.shop.index');
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}