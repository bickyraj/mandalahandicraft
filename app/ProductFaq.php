<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFaq extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
