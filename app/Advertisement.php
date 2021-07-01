<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends BaseModel
{
	

    public function image() {
    	return $this->morphOne(Image::class, 'model', 'model_type', 'model_id');
    }




}
