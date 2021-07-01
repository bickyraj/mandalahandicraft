<?php

namespace App\Http\Requests\Api;


use Illuminate\Validation\Rule;
class LoginRequest extends CommonRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email'       => 'required|email',
            // 'phoneNumber' => 'required',
            'password'    => 'required|string|min:5',
        ];
    }
}
