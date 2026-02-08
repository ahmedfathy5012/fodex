<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryResource extends JsonResource
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
            'description' => $this->description,
            'image' => $this->image ? asset('uploads/'.$this->image) : '',
          //  'items' => ItemResource::collection($this->items)
            ];
    }
}
