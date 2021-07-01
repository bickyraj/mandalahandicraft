<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;

class CartController extends Controller
{
    public function myOrders()
    {
        $user = auth()->guard('api')->user();

        $orders = $user->orders()->with('products', 'products.product:id,title')->latest()->get();

        return OrderResource::collection($orders);
    }
}
