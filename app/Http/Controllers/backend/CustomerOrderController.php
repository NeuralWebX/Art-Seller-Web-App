<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetails', 'orderDetails.product')->get();
        return view('backend.pages.customerOrder.index', compact('orders'));
    }
    public function download($art_id)
    {
        $user = auth()->user();
        $order = Order::where('customer_id', $user->id)
            ->whereHas('orderDetails', function ($query) use ($art_id) {
                $query->where('product_id', $art_id);
            })
            ->first();
        if ($order) {
            $filePath = Product::find($art_id)->product_image;
            return Storage::download($filePath);
        } else {
            alert()->error('please purchase before download');
            return redirect()->back();
        }
    }
}