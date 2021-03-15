<?php

namespace App\Controllers;

use Core\Request;
use App\Models\Product;
use App\Repositories\Product\PdoProductRepository;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;

class ProductController
{
    /** @var ProductServiceInterface */
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService(new PdoProductRepository(new Product()));
    }

    public function get(Request $request)
    {
        $products = $this->productService->get($request->sort_by ?? 'created_at' , $request->sort_type ?? 'desc');

        return view('products', ['products' => $products->items()]);
    }

    public function create()
    {
        return view('create_product');
    }

    public function store(Request $request)
    {
        return $this->productService->store($request->getData());
    }

    public function show(Request $request)
    {
        $product = $this->productService->show($request->id);

        return view('product',['product' => $product]);
    }
}