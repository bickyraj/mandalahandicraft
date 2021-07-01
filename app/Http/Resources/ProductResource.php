<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'category' => optional($this->category)->name,
            'brand' => optional($this->brand)->name,
            'title' => $this->title,
            'product_code' => $this->product_code,
            'images' => $this->images->map(function ($image) {
                return $image->image(512, 512);
            })->toArray(),
            'quantity' => $this->quantity,
            'discountType' => $this->discount_type === 1 ? 'amount' : 'percentage',
            'discount' => $this->discount,
            'price' => $this->sellingPrice(),
            'description' => $this->description,
            'specification' => $this->specification,
            'sale' => $this->sale,
            'gender' => !is_null($this->gender) ? $this->gender === 1 ? 'male' : 'female' : null,
            'sizes' => $this->hasSize() ? $this->sizes->map(function ($size) {
                return array(
                    'id' => $size->id,
                    'name' => $size->size,

                );

            }) : null,
            'colors' => $this->hasColor() ? $this->colors->map(function ($color) {
                return array(
                    'id' => $color->id,
                    'name' => $color->name,

                );

            }) : null,
            'reviews' => $this->reviews->map(function ($review) {
                return array(
                    'id' => $review->id,
                    'user' => !is_null($review->user) ? $review->user->name : null,
                    'comment' => $review->review,

                );

            }),
            'rating' => $this->rating(),
            'createdAt' => $this->created_at->timestamp,
            'updatedAt' => $this->updated_at->timestamp,
        ];
    }
}
