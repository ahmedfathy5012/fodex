<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeContentResource extends JsonResource
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
            'icon' => $this->image ? asset('uploads/'.$this->image) : '',
              'sellers' => collect(SellerResource::collection($this->sellers()->orderBy('order_number','asc')->get()))->sortBy('distance')->values()->toArray()
              ];
    }
}
