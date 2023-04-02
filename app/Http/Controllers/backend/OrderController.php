<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Order;
use Mpdf\Mpdf;
use App\Http\Controllers\Controller;
use App\Http\Repository\OrderRepository;

class OrderController extends Controller
{
    protected $orders;
    public function __construct(OrderRepository $orders)
    {
        $this->orders = $orders;
    }
    public function index()
    {
        $authors = User::select('name', 'id', 'role_id')
            ->where('role_id', 2)
            ->get();
        if (auth()->user()->role_id == 1) {
            $orders = Order::with('orderDetails')->orderBy('created_at', 'DESC')->get();
        } else {
            $orders = Order::with('orderDetails')
                ->where('author_id', auth()->user()->id)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        return view('backend.pages.orders.index', compact('orders', 'authors'));
    }
    public function byAuthor($id)
    {
        $orders = Order::with('orderDetails')
            ->where('author_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
        return response()->json($orders);
    }
    public function preview($id)
    {
        $order = Order::with('orderDetails', 'orderDetails.product')->find($id);
        return view('backend.pages.orders.invoice',compact('order'));
    }
    public function invoice($id)
    {
        $order = Order::with('orderDetails', 'orderDetails.product')->find($id);
        // dd($order);
        // $pdf = PDF::loadView('orders.pdf', $order);
        // return $pdf->download('order.pdf');
        // $view = view('backend.pages.orders.invoice', ['order' => $order])->render();
        // $mpdf = new Mpdf(['tempDir' => storage_path('temp')]);
        // $mpdf->WriteHTML($view);
        // $mpdf->Output('invoice.pdf', 'D');
    }
}
