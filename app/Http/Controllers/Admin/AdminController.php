<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\OrderProduct;
use App\Suscriber;
use App\User;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function index()
    {
        $this->data['total_products'] = auth()->user()->products->count();
        // $orders=Order::whereHas('products.product', function ($query) {
        //                     $query->where('vendor_id', auth()->id());
        //         })->latest()->get();

        // $this->data['pending_orders']= $orders->filter(function ($item) {
        //     return $item->status=='pending';
        //   })->values()->count();

        // $this->data['processing_orders']    = $orders->filter(function ($item) {
        //     return $item->status=='processing';
        // })->values()->count();
        // $this->data['delivered_orders']    = $orders->filter(function ($item) {
        //     return $item->status=='delivered';
        // })->values()->count();

        $this->data['pending_products'] = OrderProduct::
            where([['vendor_id', auth()->user()->id], ['status', 'pending']])
            ->count();

        $this->data['processing_products'] = OrderProduct::
            where([['vendor_id', auth()->user()->id], ['status', 'processing']])
            ->count();
        $this->data['delivered_products'] = OrderProduct::
            where([['vendor_id', auth()->user()->id], ['status', 'delivered']])
            ->count();

        return view('admin.index', $this->data);
    }

    public function subscribers()
    {
        $this->data['routeType'] = 'subscriber';
        $this->data['subscribers'] = Suscriber::latest()->paginate($this->default_pagination_limit);

        return view('admin.subscriber.view', $this->data);
    }

    public function changeConversionRate()
    {
        $company = $this->data['company'];
        $company->conversion_rate = request()->conversion_rate;
        $company->save();
    }

}
