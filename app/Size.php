<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['size_name', 'ordering', 'status'];


    public function products()
    {
        return $this->belongToMany(Product::class,'product_size','group_size_id','product_id');
    }
}
