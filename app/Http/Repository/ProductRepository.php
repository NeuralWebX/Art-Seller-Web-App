<?php

namespace App\Http\Repository;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductRepository
{
    /**
     * Create a new product.
     *
     * @param  array  $data
     * @return \App\Models\Product
     */
    public function create(StoreProductRequest $request)
    {
        $product_number = 'product-' . getNumber();
        $productExists = Product::where('product_number', $product_number)->exists();
        if ($productExists) {
            $product_number = 'product-' . getNumber();
        }
        $image_name = null;
        if ($request->hasFile('product_image')) {
            $image_name = date('Ymdhsis') . '.' . $request->file('product_image')->getClientOriginalExtension();
            $request->file('product_image')->storeAs('/uploads/product', $image_name);
        }
        Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_details' => $request->product_details,
            'product_number' => $product_number,
            'user_id' => auth()->user()->id,
            'product_image' => $image_name,
            'product_price' => $request->product_price,
            'product_status' => $request->product_status,
        ]);
    }

    /**
     * Update a product.
     *
     * @param  \App\Models\Product  $product
     * @param  array  $data
     * @return \App\Models\Product
     */
    public function update(UpdateProductRequest $request, $product)
    {
        $image_name = $product->product_image;
        if ($request->hasFile('product_image')) {
            $image_name = date('Ymdhsis') . '.' . $request->file('product_image')->getClientOriginalExtension();
            $request->file('product_image')->storeAs('/uploads/product', $image_name);
        }
        $product->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'product_details' => $request->product_details,
            'product_image' => $image_name,
            'product_price' => $request->product_price,
            'product_status' => $request->product_status,
        ]);
    }
}
