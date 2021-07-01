<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'title' => $this->title,
            'image' => $this->image(),
            'description' => $this->description,
            'createdAt' => $this->created_at->timestamp,
            'updatedAt' => $this->updated_at->timestamp,
        ];
    }
}
