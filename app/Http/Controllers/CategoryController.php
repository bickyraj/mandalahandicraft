<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function getCategoryProducts($slug)
    {
        try {
            $validator = Validator::make(['slug' => $slug], [
                'slug' => 'required|exists:categories,slug'
            ]);

            if ($validator->fails()) {
                throw new \Exception("Category does not exists.", 404);
            }

            $category = Category::where('slug', $slug)->first();
            $products = $category->products;
            return view('frontend.categories.index', compact('category', 'products'));
        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
            abort(404);
        }
    }
}
