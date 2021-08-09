<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonModel;

class Review extends Model
{
    use CommonModel;

    protected $guarded = ['id'];

    public function setRatingAttribute($value) {
    	return $this->attributes['rating'] = $value * 10;
    }

    public function getRatingAttribute($value) {
    	return $value / 10;
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image_name != null
        ? asset($this->upload_path.'reviews/modified/' . $this->image_name)
        : asset($this->upload_path . "no-image.jpg");
    }
}
