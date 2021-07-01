<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorProductImage extends BaseModel
{

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function color()
    {
        return $this->belongsTo(Color::class);
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
}
