<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItem2Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // if($this->item->discount > 0){
        //     $discount = $this->item->discount * $this->quantity;
        // }else{
        //     $discount = 0;
        // }
        $size = \App\Models\Size::where("id",$this->size_id)->first();
        return [
             'id' => intval($this->id),
            'title' => $this->item ? $this->item->title : '',
            'image' => $this->item->imageone ? asset('uploads/'.$this->item->imageone->image) : '',
            'price' => strval($this->price),
            'extras' => $this->extras->pluck('title'),
            'size_title' => $this->size->title ?? "",
            // 'extra_names' => implode(" ",$this->extras->pluck('title')->toArray()),
            'count' => intval($this->quantity)
            ];
    }
}
