<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
     use SoftDeletes;
     protected $guarded = ['id'];
     public $timestamps = false;

     public function order() {
     	return $this->belongsTo(Order::class);
     }

     public function product() {
     	return $this->belongsTo(Product::class);
     }

     public function size()
     {
     	return $this->belongsTo(GroupSize::class);
     }

     public function color()
     {
     	return $this->belongsTo(Color::class);

     }

    
}
