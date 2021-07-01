<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'     => 'required|integer|min:1',
            'brand_id'        => 'nullable|integer|min:1',
            'title'           => 'required|string|max:255',
            'image'           => 'image|max:5120',
            'quantity'        => 'required|integer|min:0',
            'discount'        => 'nullable|integer|min:0',
            'discount_type'   => 'nullable|boolean',
            'user_price'      => 'required|numeric|min:0',
            'whole_sheller_price' => 'nullable|numeric|min:0',
            'description'     => 'nullable|max:10000',
        ];
    }


    public function messages()
    {
        return [
            'image.image' => 'Size information must be a valid image.',
        ];
    }
}
