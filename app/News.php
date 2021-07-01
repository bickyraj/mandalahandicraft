<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonModel;
class News extends Model
{
	use CommonModel;
    protected $guarded=['id'];


    public function image() {
    		return $this->image != null
    			? asset($this->upload_path.'news/' . $this->image)
    			: asset($this->upload_path . "no-image.jpg");
    	}


    
    public function modified_image() {
    		return $this->image != null
    			? asset($this->upload_path.'news/modified/' . $this->image)
    			: asset($this->upload_path . "no-image.jpg");
    	}

}
