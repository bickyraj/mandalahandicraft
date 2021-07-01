<?php

namespace App;
use App\Traits\CommonModel;

use Illuminate\Database\Eloquent\Model;

class Image extends BaseModel
{
    use CommonModel;
    public $timestamps = false;

    public function parent() {
    	return $this->morphTo('model', 'model_type', 'model_id');
    }



    public function image() {
    		return $this->image != null
    			? asset($this->upload_path.'products/' . $this->image)
    			: asset($this->upload_path . "no-image.jpg");
    	}


    
    public function modified_image() {
    		return $this->image != null
    			? asset($this->upload_path.'products/modified/' . $this->image)
    			: asset($this->upload_path . "no-image.jpg");
    	}


        /*ads image*/
        public function ads_image() {
           
                return $this->image != null
                    ? asset($this->upload_path.'ads/' . $this->image)
                    : asset($this->upload_path . "no-image.jpg");
            }

   
    
}
