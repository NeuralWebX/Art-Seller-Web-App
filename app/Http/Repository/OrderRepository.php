<?php

namespace App\Http\Repository;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderRepository
{
    // Add your custom code here

    public function find(int $id): ?Order
    {
        return $order = Order::find($id);
    }

    public function create(OrderRequest $request)
    {
        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id,
            'currency' => $request->currency,
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
        ]);
        $orderDetails = OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'sub_total' => $request->sub_total,
        ]);
    }

    public function update(int $id, OrderRequest $request)
    {
        $item = Order::find($id);
        $item->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id,
            'currency' => $request->currency,
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
        ]);
        return $item;
    }

    public function delete(int $id): bool
    {
        return $order = Order::destroy($id) > 0;
    }
}
