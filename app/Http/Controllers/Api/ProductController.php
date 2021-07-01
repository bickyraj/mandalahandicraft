<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function products(Request $request)
    {

        $products = Product::with(['category']);

        if ($request->has('latest')) {
            $products->latest();
        }

        if ($request->has('hot')) {
            $products->hot();
        }

        if ($request->has('featured')) {
            $products->featured();
        }

        if ($request->has('sale')) {
            $products->sale();
        }
        if ($request->has('popular')) {
            $products->popular();
        }

        return ProductResource::collection($products->paginate(10));
    }

    public function detail(Product $product)
    {
        return new ProductResource($product);
    }

}
