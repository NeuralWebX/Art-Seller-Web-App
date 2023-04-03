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
                    'image' => $product->product_image,
                ]
            ];
            session()->put('cart', $cart);
            alert()->error('sorry', 'product added to cart');
            return redirect()->back();
        }
        // If cart is not empty, check if the product already exists
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'quantity' => 1,
                'price' => $product->product_price,
                'image' => $product->product_image,
            ];
        }
        session()->put('cart', $cart);
        alert()->error('sorry', 'product added to cart');
        return redirect()->back();
    }
    public function list()
    {
        $cart = session()->get('cart');
        return sendJson('Add to cart data', $cart, 200);
    }
    public function remove($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session(['cart' => $cart]);
        return response()->json(['status' => 'success']);
    }
    public function increase()
    {
    }
}
