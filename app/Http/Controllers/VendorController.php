<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Color;
use App\GroupSize;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id = null)
    {

    }

    /**
     * detail page
     * @param $vendor
     * @param $vendorIdSlug
     * @param $categorySlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function vendorProduct($vendor = null, $vendorIdSlug = null, $categorySlug = null)
    {
        $limit = 12;
        $products = Product::query();
        $vendorId = makeDecrypt($vendorIdSlug);
        $vendor = User::findOrFail($vendorId);
        $products->where('vendor_id', $vendorId);

        $brands = Brand::pluck('brand_name','id');
        $colors = Color::pluck('name','id');
        $sizes = GroupSize::pluck('size','id');

        $categoryId = "";
        $categoryName = "";
        if($categorySlug != null) {
            $category = Category::where('slug', $categorySlug)->first();
            $categoryId = $category->id;
            $categoryIds = Category::where('parent_id', $categoryId)->pluck('id')->toArray();
            array_push($categoryIds, $categoryId);

            $categoryIds = Category::whereIn('parent_id', $categoryIds)->pluck('id')->toArray();
            $categoryName = $category->name;
            $products->whereIn('category_id', $categoryIds);
        }

        $products = $products->paginate($limit);
        $this->data['products'] = $products;
        $this->data['brands'] = $brands;
        $this->data['colors'] = $colors;
        $this->data['sizes'] = $sizes;
        $this->data['category_id'] = $categoryId;
        $this->data['category_name'] = $categoryName;
        $this->data['vendor'] = $vendor;

        return view('frontend.vendors.product', $this->data);
    }

    public function loadVendorProduct(Request $request, $limit = 12) {
        $products = Product::query();

        $products->where('vendor_id', $request->vendor_id);
        if (isset($request->limit) && !empty($request->limit)) {
            $limit = $request->limit;
        }

        if (isset($request->category_id) && !empty($request->category_id)) {
            $categoryIds = Category::where('parent_id', $request->category_id)->pluck('id')->toArray();
            array_push($categoryIds, $request->category_id);

            $categoryIds = Category::whereIn('parent_id', $categoryIds)->pluck('id')->toArray();

            $products->whereIn('category_id', $categoryIds);
        }

        if (isset($request->price_max) && !empty($request->price_max)) {
            $products->where('user_price', '<=', $request->price_max);
        }

        if (isset($request->price_min) && !empty($request->price_min)) {
            $products->where('user_price', '>=', $request->price_min);
        }

        if (isset($request->price_order) && !empty($request->price_order)) {
            if ($request->price_order == 'asc') {
                $products->orderBy('user_price', 'asc');
            } else if($request->price_order == 'desc') {
                $products->orderBy('user_price', 'desc');
            }
        }

        if (isset($request->brand_id) && !empty($request->brand_id)) {
            $products->whereIn('brand_id', $request->brand_id);
        }

        if (isset($request->sale) && $request->sale == 1) {
            $products->where('sale', $request->sale);
        }

        if (isset($request->popular) && $request->popular == 1) {
            $products->where('popular', $request->popular);
        }

        if (isset($request->feature) && $request->feature == 1) {
            $products->where('feature', $request->feature);
        }

        if (isset($request->color_id) && !empty($request->color_id)) {
            $productIds = DB::table('color_product')->whereIn('color_id', $request->color_id)->pluck('product_id');
            $products->whereIn('id', $productIds);
        }

        $products->limit($limit);

        $this->data['products'] = $products->paginate($limit);


        return view('frontend.vendors.load_vendor_product', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
