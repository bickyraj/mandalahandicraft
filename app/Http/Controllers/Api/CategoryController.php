<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $main_categories = Category::where('is_parent', 0)->orderBy('priority', 'asc')->get();
        return CategoryResource::collection($main_categories);
    }

    public function products($category_id)
    {
        $category = Category::findOrFail($category_id);

        $products = $category->products()->with('category:id,name')->paginate(10);

        return ProductResource::collection($products);
    }

}
