<?php
use App\Category;
use App\GroupSize;
use App\Color;
use App\ColorProductImage;
use App\OrderProduct;
use App\Product;
use Vinkla\Hashids\Facades\Hashids;

function upload_image(\Illuminate\Http\UploadedFile $image, $prefix = "",$path) {
	// modify the image name and upload it and return modified image name.
	$image_name_with_extension          = $image->getClientOriginalName();
	$modified_image_name_with_extension = "{$prefix}-shop-" . date('YmdHis') . "-" . str_random(5) . "-" . str_replace(" ", "-", $image_name_with_extension);
	 $image_path = public_path('uploads/') . $path;

	if ($image->move($image_path, $modified_image_name_with_extension)) {
		return $modified_image_name_with_extension;
	} else {
		return redirect()->back()->with('failure_message', 'Sorry, something went wrong while uploading the image. Please try again later!');
	}
}

function admin_url_material($url) {
	return asset("admin_material/" . $url);
}

function material_dashboard_url($url) {
	return asset("material_dashboard/" . $url);
}

function delete_if_exists($file_path) {
	\Illuminate\Support\Facades\File::delete($file_path);
}

function bsb_str_slug($str) {
	$str_final = str_replace('&', 'and', $str);

	return str_slug($str_final) . '-' . date('YmdHis');
	//return str_slug($str_final);
}

function string_to_array($string) {
	// removes all white spaces and return array
	return preg_split('/\s+/', $string);
}

function my_asset($url) {
	return asset("{$url}");
}

function frontend_url($url) {
	return my_asset("frontend/{$url}");
}

function successResponse($message, $code = 200) {
	return response()->json([
		'status'  => true,
		'message' => $message,
		'code'    => $code,
	], $code);
}

function failureResponse($message, $code = 422) {
	return response()->json([
		'status'  => false,
		'message' => $message,
		'code'    => $code,
	], $code);
}

function getCategoryChild($categoryId) {
    $children = Category::with('sub_categories')->where('parent_id', $categoryId)->pluck('name', 'id');
}


if (! function_exists('previous_route')) {
    /**
     * Generate a route name for the previous request.
     *
     * @return string|null
     */
    function previous_route()
    {

        $previousRequest = app('request')->create(app('request')->create(URL::previous()));

        try {
            $routeName = app('router')->getRoutes()->match($previousRequest)->getName();
        } catch (NotFoundHttpException $exception) {
            return null;
        }

        return $routeName;
    }


}



/*recursive function to delete all child nodes of parent categories*/
function findAndDeleteChild($sub_categories)
    {
    	foreach($sub_categories as $category)
    	{
    		$category->delete();
    		$category->delete_image('image','category');
    		if($category->has_children())
    		{
    			findAndDeleteChild($category->sub_categories);

    		}


    	}
    	return;

    }






    /*order id generate*/





function getSubCategory($categoryId = null) {
    $children = Category::with('sub_categories')->where('parent_id', $categoryId)->get();
    return $children;
}


function getProductImage($productId = null) {
    $product = Product::findOrFail($productId);
    $productImage = url('uploads/no-image.jpg');

    if ($product->product_type == 1) {
        $colorProductImage = ColorProductImage::where('product_id', $productId)->first();

        if (isset($colorProductImage->image) && !empty($colorProductImage->image)) {
            $productImage = $colorProductImage->modified_image();
        }
    } else {
        if(isset($product->images) && !empty($product->images)) {
            $productImage = $product->getFirstImage();
        }
    }

    return $productImage;
}



function get_size_name($id)
{

    if(!is_null($id))
    {

      $groupSize = GroupSize::find($id);
        return $groupSize->size;

    }

        return '-';
}



function get_color_name($id)
{



    if(!is_null($id))
    {

      $color = Color::find($id);

      return $color->name;

    }

        return '-';
}



function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
{
    $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
    $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
    parse_str(request()->getQueryString(), $query);
    unset($query[$pageName]);
    $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentPageItems,
        $collection->count(),
        $perPage,
        $currentPage,
        [
            'pageName' => $pageName,
            'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
            'query' => $query,
            'fragment' => $fragment
        ]
    );

    return $paginator;
}

function getColorProductImage($productId = null, $colorId = null) {

    $product = Product::findOrFail($productId);
    $productImage = url('uploads/no-image.jpg');

    if ($product->product_type == 1) {
        $colorProductImage = ColorProductImage::where('product_id', $productId)
            ->where('color_id', $colorId)
            ->first();

        if (isset($colorProductImage->image) && !empty($colorProductImage->image)) {
            $productImage = $colorProductImage->image();
        }
    } else {
        if(isset($product->images) && !empty($product->images)) {
            $productImage = $product->getFirstImage();
        }
    }

    return $productImage;
}

function getOrderTotal($orderId = null) {
    $total = 0;
    $products = OrderProduct::where('order_id', $orderId)->get();

    if($products->count()) {
        foreach ($products as $product) {
            $total += $product->rate*$product->quantity;
        }
    }

    return $total;
}

function getCategorySlug($categoryId = null) {
    $category = Category::findOrFail($categoryId);

    return $category->slug;
}


function getAllColorProductImage($productId = null, $colorId = null) {
    $product = Product::findOrFail($productId);
    $productImage = [];

    if ($product->product_type == 1) {
        $colorProductImages = ColorProductImage::where('product_id', $productId)
            ->where('color_id', $colorId)
            ->get();

        if ($colorProductImages->count()) {
            foreach($colorProductImages as $colorProductImage) {
                if (isset($colorProductImage->image) && !empty($colorProductImage->image)) {
                    $productImage[$colorProductImage->id] = $colorProductImage->modified_image();
                }
            }
        }
    } else {
        if(isset($product->images) && $product->images->count()) {
            $productImages = $product->images->toArray();

            foreach($product->images as $image) {
                $productImage[$image->id] = $image->modified_image();
            }
        }
    }

    return $productImage;
}

function getRelatedProducts($categoryId = null) {

    $categoryIds = Category::where('parent_id', $categoryId)->pluck('id')->toArray();
    array_push($categoryIds, $categoryId);

    $categoryIds = Category::whereIn('parent_id', $categoryIds)->pluck('id')->toArray();

    $products = Product::whereIn('category_id', $categoryIds)
        ->orderBy('id', 'desc')
        ->get();

    return $products;
}


function randomPassword($length = 8, $string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max    = mb_strlen($string, '8bit') - 1;
    for ( $i = 0; $i < $length; ++ $i ) {
        $pieces[] = $string[ random_int(0, $max) ];
    }

    return implode('', $pieces);
}

function makeEncrypt($id) {

    $encode = Hashids::encode($id);
    return $encode;
}

function makeDecrypt($hash) {
    $decode = Hashids::decode($hash);

    if(isset($decode['0'])) {
        return $decode['0'];
    }

    return false;
}




