<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
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
            'status' => ucfirst($this->status),
            'createdAt' => $this->created_at->timestamp,
            'products' => OrderProductResource::collection($this->products),
        ];
    }
}
