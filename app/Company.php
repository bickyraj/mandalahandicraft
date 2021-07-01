<?php

namespace App;
use App\Traits\CommonModel;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Company extends BaseModel
{
	use CommonModel;
    public function getEstablishedDateAttribute($value) {
		return new Carbon($value);
	}

	public function name() {
		return ucfirst($this->name);
	}

	public function logo() {
		return $this->logo != null
			? asset($this->upload_path.'company/' . $this->logo)
			: asset($this->upload_path . "no-image.jpg");
	}


	public function modified_logo() {
		return $this->logo != null
			? asset($this->upload_path.'company/modified/' . $this->logo)
			: asset($this->upload_path . "no-image.jpg");
	}




	
}
