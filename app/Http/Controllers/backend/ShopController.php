<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Repository\ProductRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $products;
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }
    public function index()
    {
        $products = $this->products->index();
        return view('backend.pages.shop.index', compact('products'));
    }
    public function preview($id)
    {
        $product = $this->products->show($id);
        return view('backend.pages.product.show', compact('product'));
    }
}