<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Mail\OrderDelivered;
use App\Mail\OrderProcessing;
use Illuminate\Support\Facades\Mail;
use App\Order;
use App\OrderProduct;

class OrderController extends BaseController
{
    private $viewPath = 'admin.order';
    
    public function __construct() {
        parent::__construct();
        $this->website['routeType'] = 'order';

    }

   
    public function index()
    {
      
        if (auth()->user()->hasRole('admin')) {
           $vendor_orders = Order::with('user')->whereHas('products.product', function ($query) {
                                            $query->where('vendor_id', '!=',auth()->id());
                                })->latest()->get();
           
            // $vendor_orders=Order::with('user')->latest()->get();

           // $this->data['vendor_orders']=$vendor_orders->filter(function ($item) {
           //                                  return $item->status=='pending';
           //                              })->values();
           $this->data['vendor_orders']=$vendor_orders;
           // dd($this->data['vendor_orders']);
           // $this->data['vendor_processing_orders']=$vendor_orders->filter(function ($item) {
           //                                  return $item->status=='processing';
           //                              })->values();
           // $this->data['vendor_delivered_orders']=$vendor_orders->filter(function ($item) {
           //                                  return $item->status=='delivered';
           //                              })->values();     


           $admin_orders= Order::with('user')
                                ->whereHas('products.product', function ($query) {
                                            $query->where('vendor_id', auth()->id());
                                })->latest()->get();
          $this->data['admin_orders']=$admin_orders;





            // $this->data['admin_pending_orders']=$admin_orders->filter(function ($item) {
            //                                  return $item->status=='pending';
            //                              })->values();
            // $this->data['admin_processing_orders']=$admin_orders->filter(function ($item) {
            //                                  return $item->status=='processing';
            //                              })->values();
            // $this->data['admin_delivered_orders']=$admin_orders->filter(function ($item) {
            //                                  return $item->status=='delivered';
            //                                                  })->values();


        } else {
            // $this->data['vendor_orders'] =Order::with('user')->orderByRaw("FIELD(status , 'pending', 'processing', 'delivered') ASC")->whereHas('products.product', function ($query) {
            //                                     $query->where('vendor_id', auth()->id());
            //                         })->latest()->get();

            $this->data['vendor_orders']=Order::with('user')->whereHas('products.product', function ($query) {
                                            $query->where('vendor_id',auth()->id());
                                })->latest()->get();



        }

        return view($this->viewPath . '.view', $this->data);
    }


    

    public function changeStatus($id) {

        
        $order=Order::find(request()->get('order_id'));
        $status = strtolower(request()->status);
       
        
       
        $email = $order->user->email;

         if($order->products()
            ->where('id',$id)->where('vendor_id',auth()->user()->id)
            ->update(['status'=>$status]))
         {
             // if($status == 'processing') {
             $order_product=OrderProduct::with(['product:id,title,slug','size','color'])->where('id',$id)->first();
            
                 Mail::to($email)->send(new OrderProcessing($order_product));
             // } else if ($status == 'delivered') {


             //     Mail::to($email)->send(new OrderDelivered($order));
             // }

            return response()->json('Order status changed to ' . $status);

         }else
         {
            return response()->json(['status'=>false]);
         }
        
       

        
    }


    public function getProducts(Order $order) {
        $type=request()->get('type');
        $products=$order->products()->with(['product:id,title,slug','color:id,name','size:id,size'])->get();
        $products=$products->filter(function ($item) use ($type) {
            if($type=='owner')
            {
                return $item->product_id==auth()->user()->isMyProduct($item->product_id);

            }else
            {
                return $item->product_id!==auth()->user()->isMyProduct($item->product_id);

            }
            })->values();
        $products->map(function ($item) use ($order) {
          $item['order_code'] = $order->order_code;

          return $item;
        });
        return response()->json(['products'=>$products,'shipping'=>$order->shipping_address]);
        // return response()->json($order->products()->with('product:id,title,slug')->get())->withHeaders([
        //     'Cache-Control' => 'public, max-age=604800', // caches for one week
        // ]);
    }


   
   
}
