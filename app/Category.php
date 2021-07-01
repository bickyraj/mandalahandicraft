<?php

namespace App;
use App\Traits\CommonModel;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    use CommonModel;

   public function image() {
        return $this->image != null
            ? asset($this->upload_path.'category/modified/' . $this->image)
            : asset($this->upload_path . "no-image.jpg");
    }

    public function getNameAttribute($value) {
    	return ucfirst($value);
    }

    public function sub_categories()
    {
		return $this->hasMany(Category::class,'parent_id');
	}

	public function parent_category()
	{

        return $this->belongsTo(Category::class,'parent_id');
    }

    public function is_parent()
     {

	   return $this->parent==0;//if category table ko parent filed 1 xa vane return true otherwise false
	 }


     public function scopeParentCategories($query)
     {
        return $query->where('parent_id',null)->orderBy('name')->paginate($this->default_pagination_limit);

     }


     public function has_children() {
        return $this->sub_categories->count();
     }


     public function products() {
        return $this->hasMany(Product::class);
     }

     public function has_products() {
        return $this->products()->count();
     }

    public function getHeaderMenu() {
       return Category::where('show_on_menu', 1)
           ->whereNull('parent_id')
           ->pluck('name', 'id');
    }

    public function getParentCategory() {
        return Category::whereNull('parent_id')
            ->pluck('name', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // recursive, loads all descendants
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

//    public function getAllCategories($categoryId = null) {
//        $categories = Category::with('childrenRecursive')
//            ->where('id', $categoryId)
//            ->get();
//    }

    public function getAllCategories()
    {
        $categoryIds    = [];

        if ($this) {
            $children = $this->children;
            foreach ($children as $k => $child) {
                $categoryIds[] = $child->id;
                $allCategories = $child->getAllCategories();
                $categoryIds     = array_merge($categoryIds, $allCategories);
            }
        }

        return $categoryIds;
    }
}
