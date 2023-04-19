<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetails', 'orderDetails.product')->get();
        return view('backend.pages.customerOrder.index', compact('orders'));
    }
}
