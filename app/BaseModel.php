<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
class BaseModel extends Model
{
	protected $default_pagination_limit = 20;
    protected $guarded = ['id'];
    protected $upload_path = "uploads/";
    public function created_at($format = 'M d, h:i a') {
    	return $this->created_at->format($format);
    }

    public function updated_at($format = 'M d, h:i a') {
    	return $this->updated_at->format($format);
    }

   
}
