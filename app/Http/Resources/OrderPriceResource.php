<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderPriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->discount > 0){
            $discount = $this->discount * $this->count_number;
        }else{
            $discount = 0;
        }
        return [
             'id' => intval($this->id),
            'title' => $this->item ? $this->item->title : '',
            'image' => $this->image ? asset('uploads/'.$this->image) : '',
            'price' => $this->item ? intval($this->item->price) * $this->count_number : 0,
          'price_after_discout' => $this->item ? intval($this->item->price) * $this->count_number - $discount  : 0,
          'discount' => $discount,
          'item_id' => $this->item_id,
          'major_id' => $this->major_id,
          'size' => $this->size ? $this->size->title : '',
            'extra' => $this->extras->pluck('id'),
            'count' => $this->count_number,
        'currency' => $this->seller->currency ?? ""
            ];
    }
}
