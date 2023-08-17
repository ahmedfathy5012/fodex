<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MajorClassificationResource extends JsonResource
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
            'id' => intval($this->id),
            'title' => $this->title,
            'image' => $this->image ? asset('uploads/'.$this->image) : '',
            'sellers' => SellerResource::collection($this->sellers()->orderBy('order_number','asc')->get())->sortBy('distance')->values()->toArray()
            ];
    }
}