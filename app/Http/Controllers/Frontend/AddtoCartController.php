<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddtoCartController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            alert()->error('sorry', 'product not available');
            return redirect()->back();
        }
        $cart = session()->get('cart');
        // If cart is empty, then this is the first item being added
        if (!$cart) {
            $cart = [
                $product->id => [
                    'id' => $product->id,
                    'name' => $product->product_name,
                    'quantity' => 1,
                    'price' => $product->product_price,
                    'sub_total' => $product->product_price,
                    'image' => $product->product_image,
                ]
            ];
            session()->put('cart', $cart);
            alert()->success('Yay !!', 'product added to cart');
            return redirect()->back();
        }
        // If cart is not empty, check if the product already exists
        if (isset($cart[$product->id])) {
            alert()->success('Oppps', 'Only one at a time');
            return redirect()->back();
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'quantity' => 1,
                'price' => $product->product_price,
                'sub_total' => $product->product_price,
                'image' => $product->product_image,
            ];
        }
        session()->put('cart', $cart);
        alert()->success('Yay !!', 'product added to cart');
        return redirect()->back();
    }
    public function list()
    {
        $cart = session()->get('cart');
        return sendJson('Add to cart data', $cart, 200);
    }
    public function remove()
    {
        $id = request()->input();
        $id = key($id);
        $cart = session()->get('cart');
        unset($cart[$id]);
        session(['cart' => $cart]);
        alert()->error('Oopps !!', 'Product removed from cart');
        return back();
    }
    public function increase($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session(['cart' => $cart]);
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error', 'message' => 'Product not found in cart.']);
    }
    public function clearcart()
    {
        session()->forget('cart');
        alert()->info('Oops !', 'Shopping cart has been cleared');
        return redirect()->back();
    }
}
