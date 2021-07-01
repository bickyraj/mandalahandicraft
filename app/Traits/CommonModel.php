<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait CommonModel {
	protected $upload_path = "uploads/";
	
	//NOTE:getOriginal() method is intended to be used to get original value of an attribute loaded from the database.

	public function textStriped($limit = 100, $columnName = 'description') {
		return str_limit(strip_tags($this->getOriginal($columnName)), $limit);
	}

	public function image_path($column_name = 'image',$folder) {
		return public_path('uploads/'.$folder.'/'. $this->getOriginal($column_name));
	}

	public function delete_image($column_name = 'image',$folder) {
		$this->delete_related_images($column_name,$folder);
		File::delete($this->image_path($column_name,$folder));
	}

	// deletes images starting with the same name as current image name
	public function delete_related_images($column_name = 'image',$folder) {
		$image_name = $this->getOriginal($column_name);
		// if we don't have previous image then no need to delete it.
		if ( ! is_null($image_name) && file_exists($this->upload_path .$folder.'/modified/'.$image_name)) {
			$image_path = $this->upload_path .$folder.'/modified/'.$image_name;

			$img  = Image::make($image_path);
			$mask = $img->filename . '*.*';

			array_map('delete_if_exists', glob(public_path('uploads/'.$folder.'/modified/' . $mask)));
		}
	}

	

}