<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdertemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->item->discount > 0){
            $discount = $this->item->discount * $this->quantity;
        }else{
            $discount = 0;
        }
        $size = \App\Models\Size::where("id",$this->size_id)->first();
        return [
             'id' => intval($this->id),
            'title' => $this->item ? $this->item->title : '',
            'image' => $this->item->imageone ? asset('uploads/'.$this->item->imageone->image) : '',
            'price' => intval($size->price) * $this->quantity,
          'price_after_discount' =>  intval($size->price) * $this->quantity - $discount,
          'discount' => $discount,
          'item_id' => $this->item_id,
          'major_id' => $this->item->major_id,
          'size' => $this->size ? $this->size->title : '',
            'extra' => $this->extras->pluck('id'),
             'extra_names' => $this->extras->pluck('title'),
            'count' => intval($this->quantity)
            ];
    }
}
