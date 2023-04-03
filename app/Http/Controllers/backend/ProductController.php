<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Repository\ProductRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    protected $products;
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkAdmin = Role::where('name', 'like', 'Super Admin')->first()->id;
        $checkAuthor = Role::where('name', 'like', 'Author')->first()->id;
        if ($checkAdmin == auth()->user()->id) {
            $products = Product::orderBy('updated_at', 'DESC')->get();
        } else {
            $products = Product::orderBy('updated_at', 'DESC')
                ->where('user_id', auth()->user()->id)
                ->get();
        }
        return view('backend.pages.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = categories();
        return view('backend.pages.product.create', compact('categories', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $this->products->create($request);
            alert()->success('Product Created Successfully');
            return to_route('backend.product.index');
        } catch (\Throwable $th) {
            alert()->error($th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->products->show($id);
        $products = $this->products->relatedProduct($product->category_id);
        return view('backend.pages.product.show', compact('product', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = categories();
        return view('backend.pages.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request,  $id)
    {
        $product = Product::find($id);
        try {
            $this->products->update($request, $product);
            alert()->success('Product Updated Successfully');
            return to_route('backend.product.index');
        } catch (\Throwable $th) {
            alert()->error($th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        try {
            $product->delete();
            alert()->success('Product Deleted Successfully');
            return to_route('backend.product.index');
        } catch (\Throwable $th) {
            alert()->error($th->getMessage());
            return redirect()->back();
        }
    }
}
