<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Cart;
use App\Custom\Payment\PaymentContract;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use App\Shipping;
use App\Mail\OrderProcessing;

class PaymentController extends BaseController
{
	private $paymentType;
	private $token;
	private $amount;
	private $orderedProductsFromDatabase;

	public function __construct(Request $request)
	{
		$this->paymentType = $request->input('paymentType');
		$this->token       = $request->input('token');

	}

    public function process(Request $request)
    {
        $request->validate([
            // 'shipping_name' => 'required'
    		// 'paymentType' => 'required|string|in:paypal,normal,khalti,esewa',
    		// 'products'    => 'required',
    		// 'first_name'  =>'required|string|max:50',
    		// 'last_name'   =>'required|string|max:50',
    		// 'phone'       =>'required|max:20',
    		// 'address'     =>'required|max:200',
    		// 'order_comment'=>'nullable|max:1000',
            'card_number' => 'numeric'
    	]);

        try {
            // save order
            $cartItems = Cart::content();

            DB::transaction(function () use ($request, $cartItems) {
                $user = auth()->user();

                /** @var Order $order */
                $order = Order::create([
                    'order_code'=>$this->getNextOrderNumber(),
                    'user_id' => $user->id,
                    // 'payment_type' => $this->paymentType,
                    // 'payment_detail' => json_encode($paymentGateway->getResponse())
                ]);

                $order->shipping_address()->firstOrcreate([
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    // 'first_name'=>$request->first_name,
                    // 'last_name'=>$request->last_name,
                    // 'address'  =>$request->address,
                    // 'message'=>$request->order_comment,
                    'contact_number' =>$request->phone_number,
                    'shipping_name' => $request->shipping_name,
                    'shipping_email' => $request->shipping_email,
                    'shipping_phone_number' => $request->shipping_phone_number,
                    'shipping_street_address' => $request->shipping_street_address,
                    'shipping_city' => $request->shipping_city,
                    'shipping_postal_code' => $request->shipping_postal_code,
                    'shipping_country' => $request->shipping_country,
                    'billing_name' => $request->billing_name,
                    'billing_email' => $request->billing_email,
                    'billing_phone_number' => $request->billing_phone_number,
                    'billing_street_address' => $request->billing_street_address,
                    'billing_city' => $request->billing_city,
                    'billing_postal_code' => $request->billing_postal_code,
                    'billing_country' => $request->billing_country,
                    'credit_card_no' => $request->credit_card_no,
                    'expired_month' => $request->expired_month,
                    'expired_year' => $request->expired_year
                ]);

                $dataToSave = [];
                foreach ($cartItems as $item) {
                    $product = Product::where('id', $item->id)->first();
                    if(!$product) {
                        $msg="Product not found.";
                        return redirect()->back()->with('failure_message',$msg);
                    }

                    $dataToSave[] = [
                        'product_id' => $product->id,
                        'rate'       => $product->sellingPrice(),
                        'quantity'   => $item->qty,
                        'size_id'    => $item->options->size,
                        'color_id'   =>$item->options->color,
                        // 'vendor_id'  =>$product->vendor_id,
                    ];

                    $hasEnoughQuantity = $product->quantity >= $item->qty;

                    if ($hasEnoughQuantity) {
                        $product->decrement('quantity', $item->qty);
                    }
                }

                $order->products()->createMany($dataToSave);
            });

             // Mail::to(auth()->user()->email)->send(new OrderProcessing($order));
            Cart::destroy();
            //  return $this->handle($request, $this->parseClassFromPaymentGatewayName());
        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
        }

        return redirect()->route('home');
    }


    private function parseClassFromPaymentGatewayName()
    {
    	$class = "\\App\\Custom\\Payment\\" . ucfirst($this->paymentType);

    	return new $class;
    }


    private function handle(Request $request, PaymentContract $paymentGateway)
    {

    	$this->calculateTotalAmount($request);
    	$paymentGateway->verify($this->token, $this->amount * 100);

    	if ( ! $paymentGateway->isVerified()) {

    		return back()->with('failure_message',$paymentGateway->getErrorMessage());
    	}

    	$order=$this->addDataToDatabase($request, $paymentGateway);
    	 // Mail::to(auth()->user()->email)->send(new OrderProcessing($order));

    	Cart::destroy();
    	return redirect()->route('home')->with('success_message','Your order is successfully placed. We will contact you soon!');


    }




    private function addDataToDatabase(Request $request, PaymentContract $paymentGateway)
    {

       $cartItems=json_decode($request->products);
        return  DB::transaction(function () use ($request, $paymentGateway,$cartItems) {
    		$user = auth()->user();
    		$shipping_address=new Shipping();
    	    /** @var Order $order */
    		$order = Order::create([
    			'order_code'=>$this->getNextOrderNumber(),
    			'user_id' => $user->id,
    			'payment_type' => $this->paymentType,
    			'payment_detail' => json_encode($paymentGateway->getResponse())
    		]);

    		$order->shipping_address()->firstOrcreate([
    			'user_id'=>$user->id,
                'order_id'=>$order->id,
    			'first_name'=>$request->first_name,
    			'last_name'=>$request->last_name,
    			'contact_number'    =>$request->phone,
    			'address'  =>$request->address,
    			'message'=>$request->order_comment


    		]);

    		$dataToSave = [];
    		foreach ($cartItems as $item) {

    			$product = $this->orderedProductsFromDatabase()->firstWhere('id', $item->id);

    			if(!$product) {
    				$msg="Product with id:{$product->id} not found.";
    				return redirect()->back()->with('failure_message',$msg);
    			}

    			$dataToSave[] = [
    				'product_id' => $product->id,
                    'rate'       => $product->sellingPrice(),
    				'quantity'   => $item->qty,
    				'size_id'       => $item->options->size,
    				'color_id'      =>$item->options->color,
                    'vendor_id'    =>$product->vendor_id,

    			];

    			$hasEnoughQuantity = $product->quantity >= $item->qty;

    			if ($hasEnoughQuantity) {
    				$product->decrement('quantity', $item->qty);
    			}
    		}

    		$order->products()->createMany($dataToSave);
    		return  $order;


    	});
    }


    private function calculateTotalAmount(Request $request)
    {
    	$totalPrice = 0;
    	$cartItems=json_decode($request->products);
    	foreach ($cartItems as $item) {
    		/** @var Product $product */
    		$product = $this->orderedProductsFromDatabase[] = Product::findOrFail($item->id);

    		$hasEnoughQuantity = $product->quantity >= $item->qty;
    		if ( ! $hasEnoughQuantity) {
    			throw new \Exception("{$product->title} has only {$product->quantity} items left.", 422);
    		}

    		$totalPrice += $product->sellingPrice() * $item->qty;
    	}

    	$this->amount =  $totalPrice;
    }

    private function orderedProductsFromDatabase()
    {
    	return collect($this->orderedProductsFromDatabase);
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

        return 'ORD' . sprintf('%05d', intval($number) + 1);
    }




}
