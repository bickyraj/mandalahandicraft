<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\DB;

class OrderPlacedController extends Controller
{
    public function save($cartItems)
    {

    	DB::transaction(function () use ($cartItems, &$order) {
    		/** @var Order $order */
    		$order = Order::create(['order_code'=>$this->getNextOrderNumber(),'user_id' => auth()->id()]);

    		$dataToSave = [];
    		dd('fuck');
    		foreach ($cartItems as $item) {
    			$dataToSave[] = [
    				'product_id' => $item['id'],
    				'rate'       => $item['sellingPrice'],
    				'quantity'   => $item['quantity'],
    				'size'       => $item['size'] ?? "",
    			];

    			Product::find($item['id'])->decrement('quantity', $item['quantity']);
    		}

    		$order->products()->createMany($dataToSave);
    	});

    	return $order;
    }


    function getNextOrderNumber()
    {
        //Get the last created order
        $lastOrder = Order::orderBy('created_at', 'desc')->first();

        if ( ! $lastOrder )
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.

            $number = 0;
        else 
            $number = substr($lastOrder->order_code, 3);

        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.
     
        return 'ORD' . sprintf('%06d', intval($number) + 1);
    }
}
