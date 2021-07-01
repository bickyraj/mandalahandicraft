<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'id'        => $this->id,
            'title'     => $this->title,
            'sub_title' =>$this->sub_title,
            'offer_title'=>$this->offer_title,
            'url'       => $this->url,
            'image'  =>$this->modified_image(),
            'createdAt' => $this->created_at->timestamp,
            'updatedAt' => $this->updated_at->timestamp,
        ];
    }
}
