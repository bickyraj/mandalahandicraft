<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function products()
    {
    	return $this->hasMany(OrderProduct::class);
    }

    public function orderItems()
    {
    	return $this->belongsToMany(Product::class, 'order_products','order_id','product_id')->withPivot('rate','quantity','size_id','color_id','status','vendor_id')->withTimeStamps();
    }

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }


    public function shipping_address()
    {
        return $this->hasOne(Shipping::class,'order_id');
    }



   



    
}
