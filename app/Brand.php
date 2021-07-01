<?php

namespace App;

use App\Traits\CommonModel;
use Illuminate\Database\Eloquent\Model;

class Brand extends BaseModel
{
    use CommonModel;
    protected $fillable = ['brand_name', 'image', 'ordering', 'url'];

    public function images()
    {

        return $this->hasMany(ColorProductImage::class);

    }

    public function image() {
        return $this->image != null
            ? asset($this->upload_path.'color/' . $this->image)
            : asset($this->upload_path . "no-image.jpg");
    }


    public function modified_image() {
        return $this->image != null
            ? asset($this->upload_path.'color/modified/' . $this->image)
            : asset($this->upload_path . "no-image.jpg");
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
