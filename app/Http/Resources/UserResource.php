<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    protected $showToken;

    public function __construct($resource, $showToken = false)
    {
        parent::__construct($resource);
        $this->showToken = $showToken;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->when($this->showToken, $this->auth_token),
            'token_type' => $this->when($this->showToken, 'bearer'),
            'expires_in' => $this->when($this->showToken, auth('api')->factory()->getTTL() * 60),
        ];
    }
}
