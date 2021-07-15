<?php

namespace App\Http\Controllers;

use App\Category;
// use App\Custom\Cart;
use App\Http\Controllers\BaseController;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Cart;

class CartController extends BaseController
{
    public $cartVariable = 'cart-items';

    public function __construct()
    {
        parent::__construct();
        // $this->data['allCategories'] = Category::select('id', 'name', 'slug')->get();
    }

    public function addToCart($slug, Request $request)
    {
        $currentCartItem = 'current-cart-item';
        $product = Product::whereSlug($slug)->firstOrFail();
        $cart_data = [
            'id' => $product->id,
            'name' => $product->title,
            'qty' => $request->quantity ?? 1,
            'price' => $product->sellingPrice(),
            // 'taxRate'=>200,
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'firstImage' => $product->getFirstImage(),
                'stock' => $product->quantity,
                'all_sizes' => $product->hasSize() ? $product->sizes : null,
                'all_colors' => $product->hascolor() ? $product->colors : null,
            ]
        ];

        $cart = Cart::content();
        if ($cart->count() > 0) {
            $rowId = $cart->search(function ($cartItem, $rowId) use ($product) {
                return $cartItem->id == $product->id;
            });

            if ($rowId) {
                $currentItem = Cart::get($rowId);
                $cart_total_quantity = $this->findCommonQty($currentItem->id);
                if (($cart_total_quantity + $request->quantity) > $product->quantity) {

                    return back()->with('failure_message', 'We currently do not have enough items in stock.');
                }
            }
        }

        if ($request->quantity > $product->quantity) {
            return back()->with('failure_message', 'We currently do not have enough items in stock.');
        }

        Cart::add($cart_data);
        return back()->with('success_message', 'Product added to cart.');
    }

    public function removeFromCart($rowId)
    {


        Cart::remove($rowId);
        return back()->with('success_message', 'Product removed from cart.');
    }



    public function destroyCart()
    {
        Cart::destroy();
        return back()->with('success_message', 'Cart successfully destroyed!');
    }



    public function updateCart(Request $request)
    {
        //dd($request->all());
        foreach ($request->product_ids as $k => $rowId) {

            $item = Cart::get($rowId);

            $product = Product::findOrFail($item->id);

            $update_data = [
                'id' => $product->id,
                'name' => $product->title,
                'qty' => isset($request->cart_quantity[$rowId]) ? $request->cart_quantity[$rowId] : 1,
                'price' => $product->sellingPrice(),
                // 'taxRate'=>200,

                'options' => [
                    'size' => isset($request->size[$rowId]) ? $request->size[$rowId] : null,
                    'color' => isset($request->color[$rowId]) ? $request->color[$rowId] : null,
                    'firstImage' => $product->getFirstImage(),
                    'stock' => $product->quantity,
                    'all_sizes' => $product->hasSize() ? $product->sizes : null,
                    'all_colors' => $product->hascolor() ? $product->colors : null,

                ]
            ];

            $cart_total_quantity = $this->findCommonQty($product->id);

            if ($product->quantity < $request->cart_quantity[$rowId]) {
                return back()->with('failure_message', "We currently do not have enough items in stock for product " . ucwords($product->title));
            } else {

                if ($product->quantity < ($cart_total_quantity)) {

                    return back()->with('failure_message', "We currently do not have enough items in stock for product " . ucwords($product->title));
                } else {
                    Cart::update($rowId, $update_data);
                }
            }
        }

        // $product=Product::find($request->get('product_id'));
        // $cart=Cart::content();

        //increment the quantity
        // if ($request->get('product_id') && ($request->get('increment')) == 1) {
        // 	$rowId=$cart->search(function ($cartItem, $rowId) use ($request) {
        //          return $cartItem->id==$request->get('product_id');
        //             });


        //    $item = Cart::get($rowId);


        //   if($product->quantity>$item->qty)
        //   {
        //   	Cart::update($rowId, $item->qty + 1);
        //   }
        //   else
        //   {
        //   	return back()->with('failure_message',"We currently do not have enough items in stock.");

        //   }


        // }

        //decrease the quantity
        // if ($request->get('product_id') && ($request->get('decrease')) == 1) {
        //    $rowId=$cart->search(function ($cartItem, $rowId) use ($request) {
        //          return $cartItem->id==$request->get('product_id');
        //             });
        //     $item = Cart::get($rowId);

        //            if($item->qty>1)
        //            {
        //            	 Cart::update($rowId, $item->qty - 1);

        //            }else
        //            {
        //            	return back()->with('failure_message',"You must have atleast 1 quantity of product");

        //            }

        // }

        return back()->with('success_message', 'Cart successfully Update!');
    }

    public function findCommonQty($product_id)
    {
        //dd(Cart::content()->groupBy('id'));

        $cartItems = Cart::content()->where('id', $product_id);
        $qtySum = 0;
        foreach ($cartItems as $k => $v) {
            $qtySum += $v->qty;
        }
        return $qtySum;
    }

    public function checkout()
    {
        return view('frontend.cart.checkout', $this->data);
    }

    public function cartItems()
    {
        return view('frontend.carts.index', $this->data);
    }
}
