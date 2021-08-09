<?php

namespace App\Http\Controllers\Admin;

use App\ColorProduct;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Category;
use App\Brand;
use App\Group;
use App\Color;
use App\ColorProductImage;
use Illuminate\Support\Facades\DB;
use App\Review;
use Intervention\Image\Facades\Image;
use App\Services\ImageUpload\Strategy\UploadWithAspectRatio;
use App\Services\ReviewImageUploader;

class ProductController extends BaseController
{
    private $image_prefix = 'product';

    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'product';
        $this->data['categories'] = Category::where('is_parent', 0)->orderBy('name')->get();
        $this->data['brands'] =  Brand::orderBy('brand_name')->get();
        $this->data['groups'] = Group::orderBy('name')->get();
        $this->data['colors'] = Color::orderBy('name')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $products = auth()->user()->products()->latest()->with('category:id,name')->select('id', 'category_id', 'title', 'image', 'quantity', 'discount', 'discount_type', 'user_price');
            return Datatables::of($products)
                ->editColumn('image', function ($p) {
                    return '<div class="img-container">' . '<img src="' . $p->getProductImage($p->id) . '" style="" />' . '</div>';
                })->editColumn('title', function ($p) {
                    return $p->title . '<a target="_blank" href="' . route('get_reviews', $p->id) . '" class="btn btn-simple btn-twitter">
                                                <i class="fa fa-comments"></i> Reviews · (' . $p->reviews->count() . ')
                                            <div class="ripple-container"></div></a>' . ' ' . '<a href="'.route('admin.productfaq.index', [$p->id]).'">Faqs</a>';
                })->editColumn('discount', function ($p) {
                    return $p->discount_type == 1 ? 'Rs.' . $p->discount : $p->discount . '%';
                })->editColumn('user_price', function ($p) {
                    return 'Rs.' . $p->user_price;
                })->addColumn('action', function ($p) {
                    return (string)view('admin.product.options', ['product' => $p]);
                })->rawColumns(['title', 'action', 'image'])->make(true);
        }

        return view('admin.product.view', $this->data);
    }



    public function getVendorProducts()
    {
        if (auth()->user()->hasRole('admin')) {
            $products = Product::where('vendor_id', '!=', auth()->user()->id)->latest()->with(['vendor:id,name,email', 'category:id,name'])->select('id', 'vendor_id', 'category_id', 'title', 'image', 'quantity', 'discount', 'discount_type', 'user_price');
            return Datatables::of($products)
                ->editColumn('image', function ($p) {
                    return '<div class="img-container">' . '<img src="' . $p->getProductImage($p->id) . '" style="" />' . '</div>';
                })->editColumn('discount', function ($p) {
                    return $p->discount_type == 1 ? 'Rs.' . $p->discount : $p->discount . '%';
                })->editColumn('user_price', function ($p) {
                    return 'Rs.' . $p->user_price;
                })->addColumn('action', function ($p) {
                    return (string)view('admin.product.options', ['product' => $p]);
                })->rawColumns(['action', 'image'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.product.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $image_path_from_public = 'products';
        $image_name = null;
        if (!is_null($request->image)) {
            $image_name = upload_image($request->image, $this->image_prefix, $image_path_from_public);
        }
        $product = Product::create([
            'category_id'         => $request->category_id,
            'vendor_id'           => auth()->id(),
            'brand_id'            => $request->brand_id,
            'title'               => $request->title,
            'slug'                => bsb_str_slug($request->title),
            'image'               => $image_name,
            'quantity'            => $request->quantity,
            'discount'            => $request->discount,
            'discount_type'       => $request->discount_type, // 0 => percentage, 1 => amount
            'user_price'          => $request->user_price,
            'old_price'          => $request->old_price,
            'whole_sheller_price' => $request->whole_seller_price,
            'description'         => $request->description,
            'short_description'   => $request->short_description,
            'specification'       => $request->specification,
            'gender'              => $request->gender,
            'popular'             => isset($request->popular) ? 1 : 0,
            'sale'                => isset($request->sale) ? 1 : 0,
            'hot'                 => isset($request->hot) ? 1 : 0,
            'featured'            => isset($request->featured) ? 1 : 0,
            'product_type'        => $request->product_type,
            'video_url'           => $request->video_url,
            'dimensions'          => $request->dimensions,
            'weight'              => $request->weight,
            'materials'           => $request->materials,
        ]);

        if ($product) {

            if ($request->images & is_array($request->images)) {
                $uploadImages = [];
                foreach ($request->images as $image) {
                    $imageName      = upload_image($image, $this->image_prefix, $image_path_from_public);
                    $this->fitImage(508, 600, $imageName, $image_path_from_public, $image_path_from_public . '/modified');
                    $uploadImages[] = ['image' => $imageName];
                }

                $product->images()->createMany($uploadImages);
            }


            $product->sizes()->sync($request->group_size_id);
            $product->colors()->sync($request->color_id);

            if (isset($request->color_images) && !empty($request->color_images))
                foreach ($request->color_images as $colorId => $images) {

                    foreach ($images as $image) {
                        $image_name = upload_image($image, $this->image_prefix, $image_path_from_public);
                        $this->fitImage(508, 600, $image_name, $image_path_from_public, $image_path_from_public . '/modified');

                        ColorProductImage::create([
                            'product_id'  => $product->id,
                            'color_id'  => $colorId,
                            'image' => isset($image_name) ? $image_name : null,
                        ]);
                    }
                }
            return back()->with('success_message', 'Product successfully added.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (!$product->isAuthorizedUser()) {

            return redirect()->back()->with('failure_message', 'Access Denied! You are not authorized to edit this product');
        }

        $this->data['edit']           = true;
        $this->data['product']        = $product;
        return view('admin.product.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {

        //        dd($request->all());

        if (!$product->isAuthorizedUser()) {

            return redirect()->back()->with('failure_message', 'Access Denied! You are not authorized to update this product');
        }

        $image_path_from_public = 'products';
        $image_name = null;
        if (!is_null($request->image)) {
            $image_name = upload_image($request->image, $this->image_prefix, $image_path_from_public);
        }

        $product->update([
            'category_id'         => $request->category_id,
            'brand_id'            => $request->brand_id,
            'title'               => $request->title,
            'quantity'            => $request->quantity,
            'discount'            => $request->discount,
            'discount_type'       => $request->discount_type, // 0 => percentage, 1 => amount
            'user_price'          => $request->user_price,
            'old_price'          => $request->old_price,
            'image'               => $image_name,
            'whole_sheller_price'  => $request->whole_seller_price,
            'description'         => $request->description,
            'short_description'         => $request->short_description,
            'specification'       => $request->specification,
            'gender'              => $request->gender,
            'popular'             => isset($request->popular) ? 1 : 0,
            'sale'             => isset($request->sale) ? 1 : 0,
            'hot'             => isset($request->hot) ? 1 : 0,
            'featured'             => isset($request->featured) ? 1 : 0,
            'product_type'             => $request->product_type,
            'video_url' => $request->video_url,

        ]);

        $productType = $request->product_type;
        if ($productType == 1) {
            $product->images()->delete();
        } else {
            $product->color_product_images()->delete();
            DB::table('color_product')->where('product_id', $product->id)->delete();
        }


        if ($product) {
            $image_path_from_public = 'products';
            if ($request->images & is_array($request->images) && $productType == 0) {

                $uploadImages = [];
                foreach ($request->images as $image) {
                    $imageName      = upload_image($image, $this->image_prefix, $image_path_from_public);
                    $this->fitImage(508, 600, $imageName, $image_path_from_public, $image_path_from_public . '/modified');
                    $uploadImages[] = ['image' => $imageName];
                }

                $product->images()->createMany($uploadImages);
            }

            $product->sizes()->sync($request->group_size_id);

            if (isset($request->color_images) && !empty($request->color_images) && $productType == 1) {
                $product->colors()->sync($request->color_id);

                foreach ($request->color_images as $colorId => $images) {

                    foreach ($images as $image) {
                        $image_name = upload_image($image, $this->image_prefix, $image_path_from_public);
                        $this->fitImage(508, 600, $image_name, $image_path_from_public, $image_path_from_public . '/modified');


                        ColorProductImage::create([
                            'product_id'  => $product->id,
                            'color_id'  => $colorId,
                            'image' => isset($image_name) ? $image_name : null,
                        ]);
                    }
                }
            }
            return back()->with('success_message', 'Product successfully updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (!$product->isAuthorizedUser()) {

            return redirect()->back()->with('failure_message', 'Access Denied! You are not authorized to delete this product');
        }



        try {
            foreach ($product->images as $image) {

                $image->delete_image('image', 'products');
            }


            $product->images()->delete();

            $product->delete();

            return back()->with('success_message', 'Product successfully deleted.');
        } catch (\Exception $exception) {
            return back()->with('failure_message', 'Product could not be deleted. Please try again later.');
        }
    }




    public function showSize()
    {
        $group_id = request()->get('group_id');
        $group   = Group::find($group_id);
        $data       = '';

        if ($group->group_sizes->count() > 0) {

            $data .= '<div class="form-group" style="margin-top: 30px;">';
            $data .= '<label for="group_size_id">Sizes</label>';
            $data .= '<select name="group_size_id[]" id="group_size_id" class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" multiple="true"
        >';
            // $data .= '<option value="">Choose Size</option>';
            foreach ($group->group_sizes as $size) {
                $data .= '<option value="' . $size->id . '" data-icon="glyphicon glyphicon-text-size">' . $size->size . '</option>';
            }
            $data .= '</select>';
            $data .= '<div class="material-icons select-drop-down-arrow">keyboard_arrow_down</div>';
            $data .= '</div>';

            return response()->json(['status' => true, 'data' => $data]);
        }

        return response()->json(['status' => false]);
    }


    public function removeImage()
    {

        $image_id = request()->get('id');
        $productType = request()->get('type');

        if ($productType == 0) {
            $image = Image::find($image_id);

            if ($image) {
                $image->delete_image('image', 'products');
                $delete = $image->delete();
            }
        } else {
            $colorImage = ColorProductImage::find($image_id);

            if ($colorImage) {
                $delete = $colorImage->delete();
            }
        }

        if ($delete) {
            return response()->json(['status' => true, 'Message' => 'Success!']);
        } else {
            return response()->json(['status' => false, 'Message' => 'Failed!']);
        }
    }



    public function getReviews($id)
    {
        $this->data['product'] = $product = Product::find($id);
        if (request()->ajax()) {

            $reviews = $product->reviews()->with('user:id,name,email')->latest()->get();


            return Datatables::of($reviews)->addColumn('action', function ($r) {
                return (string)view('admin.product.review_delete', ['review' => $r]);
            })->rawColumns(['action'])->make(true);
        }

        return view('admin.product.reviews', $this->data);
    }


    public function deleteReview($id)
    {
        $review = Review::find($id);
        if ($review->delete()) {
            return back()->with('success_message', 'Review successfully deleted.');
        }
    }

    public function storeProductReviews(Request $request)
    {
        try {
            $image_name = null;
            $image_path_from_public='reviews';
            $review = new Review();
            $review->user_id = auth()->user()->id;
            $review->name = $request->name;
            $review->product_id = $request->product_id;
            $review->title = $request->title;
            $review->country = $request->country;
            $review->rating = $request->rating;
            $review->review = $request->review;
            if ($request->hasFile('image')) {

                $image = $request->file('image');

                $uploader = new ReviewImageUploader(new UploadWithAspectRatio());

                $data['image'] = $uploader->saveOriginalImage($image);

                $this->cropAndSaveImage(
                    $uploader,
                    $data['image'],
                    $request->x1,
                    $request->y1,
                    $request->w,
                    $request->h
                );
                $image_name = $data['image'];

            } else if ( ! is_null($request->file('image'))) {
                $image_name = upload_image($request->file('image'), $this->image_prefix,$image_path_from_public);
                $this->fitImage(1920,850,$image_name,$image_path_from_public,$image_path_from_public.'/modified');
                $this->fitImage(480,578,$image_name,$image_path_from_public,$image_path_from_public.'/mobile');
            }

            $review->image_name = $image_name;
            $review->save();
            session()->flash('success_message', 'Saved successfully.');

        } catch (\Throwable $th) {
            session()->flash('error_message', 'Something went wrong. Please try again.');
            \Log::info($th->getMessage());
            return redirect()->back();
        }

        return redirect()->route('get_reviews', $request->product_id);
    }

    public function updateProductReviews(Request $request)
    {

    }

    public function createProductReview($productId)
    {
        $this->data['edit'] = false;
        $this->data['product'] = Product::find($productId);
        return view('admin.product.review_create', $this->data);
    }

    private function cropAndSaveImage($uploader, $filename, $posX1, $posY1, $width, $height)
    {
        $imgPath = $uploader->getFullImagePath($filename);

        $fullImage = Image::make($imgPath);

        $cropDestPath = $uploader->getModifiedImagePath($filename);

        $uploader->cropAndSaveImage($fullImage, $cropDestPath, $posX1, $posY1, $width, $height);

        $uploader->cropAndSaveImageMobile($fullImage, $filename);
    }
}
