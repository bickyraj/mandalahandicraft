<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use SoftDeletes;

    public function getNameAttribute()
    {

    }
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'id' => 0,
            'name' => '',
        ]);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function color_product_images()
    {
        return $this->hasMany(ColorProductImage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function wish_list() {
        return $this->hasOne(Wishlist::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model', 'model_type', 'model_id');
    }

    public function firstImage()
    {
        return $this->morphOne(Image::class, 'model', 'model_type', 'model_id');
    }

    public function hasImages()
    {
        return $this->images->count() > 0;
    }

    public function getFirstImage()
    {
        if ($this->hasImages()) {
            return asset($this->upload_path . 'products/modified/' . $this->images->first()->image);
        }

        return asset("no-image.jpg");
    }

    public function isAuthorizedUser()
    {
        return optional($this->vendor)->id == auth()->id();
    }

    public function sizes()
    {
        return $this->belongsToMany(GroupSize::class, 'product_size', 'product_id', 'group_size_id');
    }

    /*following all functions are used during product editing*/

    public function hasSize()
    {

        return $this->sizes->count() > 0 ? true : false;
    }

    public function get_group_id()
    {
        return $this->sizes()->first()->group_id;
    }

    public function get_size_by_group($id)
    {

        return Group::find($id)->group_sizes;

    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function hasColor()
    {
        return $this->colors->count() > 0 ? true : false;
    }

    /**
     * to get discounted price
     * @return string
     */
    public function getDiscountedPriceAttribute()
    {
        $totalDiscount = 0;
        $actualPrice = $this->user_price;
        if ($this->discount_type === 0) {
            if ($this->discount > 0) {
                $totalDiscount = ($actualPrice * $this->discount / 100);
            }
        } else if ($this->discount_type === 1) {
            if ($this->discount > 0) {
                $totalDiscount = $this->discount;
            }
        }
        return ($actualPrice - $totalDiscount);
    }

    /**
     * to get discounted price
     * @return string
     */
    public function getTotalDiscountAttribute()
    {
        $totalDiscount = 0;
        $actualPrice = $this->user_price;
        if ($this->discount_type === 0) {
            if ($this->discount > 0) {
                $totalDiscount = ($actualPrice * $this->discount / 100);
            }
        } else if ($this->discount_type === 1) {
            if ($this->discount > 0) {
                $totalDiscount = $this->discount;
            }
        }

        return $totalDiscount;
    }

    public function getFeaturedProducts()
    {
        $products = Product::with('images')->with('firstImage')
            ->with('wish_list')
            ->where('featured', 1)
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        return $products;
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function getNewProducts()
    {
        $products = Product::with('images')->with('firstImage')
            ->with('wish_list')
            ->where('hot', 1)
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        return $products;
    }

    public function scopeHot($query)
    {
        return $query->where('hot', 1);
    }

    public function getSaleProducts()
    {
        $products = Product::with('images')->with('firstImage')
            ->with('wish_list')
            ->where('sale', 1)
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        return $products;
    }

    public function scopeSale($query)
    {
        return $query->where('sale', 1);
    }

    public function getPopularProducts()
    {
        $products = Product::with('images')->with('firstImage')
            ->with('wish_list')
            ->where('popular', 1)
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        return $products;
    }

    public function scopePopular($query)
    {
        return $query->where('popular', 1);
    }

    public function getAllProducts()
    {
        $products = Product::with('images')->with('firstImage')
            ->with('wish_list')
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        return $products;
    }

    public function hasAmountDiscountType()
    {
        return $this->discount_type == 1;
    }

    public function hasPercentageDiscountType()
    {
        return $this->discount_type == 0;
    }

    public function hasDiscount()
    {
        return $this->discount > 0;
    }

    public function discountAmount()
    {
        $costPrice = $this->user_price;
        if ($this->hasPercentageDiscountType()) {
            $discountPercentage = $this->discount;
            $discountAmount = ($discountPercentage / 100) * $costPrice;
        } else {
            $discountAmount = $this->discount;
        }

        return $discountAmount;
    }

    /*this is the price after discount*/
    public function sellingPrice()
    {
        $costPrice = $this->user_price;
        $discount_amount = $this->discountAmount();
        $sellingPrice = ($costPrice - $discount_amount);
        return $sellingPrice;

    }

    public function sellingPriceFixed()
    {
        return number_format($this->sellingPrice(), 2, '.', '');
    }

    public function scopeMale($query)
    {
        return $query->where('gender', 1);
    }

    public function scopeFemale($query)
    {
        return $query->where('gender', 0);
    }

    public function special()
    {

        if ($this->sale || $this->featured || $this->hot) {
            return true;
        }
        return false;

    }

    public function get_sale_status()
    {
        $status = "";
        if ($this->sale) {
            $status = 'Sale';
        } elseif ($this->featured) {
            $status = "Featured";
        } elseif ($this->hot) {
            $status = "Hot";

        }
        return $status;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function rating()
    {
        $sum = $this->reviews->reduce(function ($sum, $item) {
            return $sum + $item->rating;
        }, 0);

        if ($sum == 0) {
            return 0;
        }

        return number_format($sum / $this->reviews->count(), '1', '.', '');
    }

    public function getProductImage($productId = null)
    {
        $product = Product::findOrFail($productId);
        $productImage = url('uploads/no-image.jpg');

        if ($product->product_type == 1) {
            $colorProductImage = ColorProductImage::where('product_id', $productId)->first();

            if (isset($colorProductImage->image) && !empty($colorProductImage->image)) {
                $productImage = $colorProductImage->image();
            }
        } else {
            if (isset($product->images) && !empty($product->images)) {
                $productImage = $product->getFirstImage();
            }
        }

        return $productImage;
    }

}
