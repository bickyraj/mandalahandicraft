<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class RegisterRequest extends CommonRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:5|confirmed',
            'phone' => 'nullable|string',
            'from'  => ['required', Rule::in(['facebook', 'google', 'normal'])],
            // 'from'  => ['required', Rule::in(['facebook','google'])],
            'instance_token' => 'required_if:from,facebook,google',
        ];
    }



    public function messages()
    {
        return [
            'instance_token.required_if' => 'instance_token field is required!',
           
        ];
    }
}
