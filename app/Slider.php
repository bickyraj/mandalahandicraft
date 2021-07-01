<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonModel;
class Slider extends BaseModel
{
    use CommonModel;
    public function image() {
    		return $this->image != null
    			? asset($this->upload_path.'sliders/full/' . $this->image)
    			: asset($this->upload_path . "no-image.jpg");
    	}

    public function modified_image() {
    		return $this->image != null
    			? asset($this->upload_path.'sliders/modified/' . $this->image)
    			: asset($this->upload_path . "no-image.jpg");
    	}

    public function mobile_image() {
        return $this->image != null
            ? asset($this->upload_path.'sliders/mobile/' . $this->image)
            : asset($this->upload_path . "no-image.jpg");
    }
}
