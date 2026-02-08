<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(count($this->sizes) > 0){
            $item_type = 'b';
        }else{
             $item_type = 'a';
        }
        return [
            'id' => intval($this->id),
            'title' => $this->title,
            'description' => $this->description ?? "",
            'image' => [$this->image_link],
            'price' => intval($this->price),
            'discount' => intval($this->discount),
            'calory' => $this->calory,
            "available" => $this->available ? 1 : 0,
            'item_type' => $item_type,
            'currency' => $this->Currency ?? ""
            ];
    }
}
