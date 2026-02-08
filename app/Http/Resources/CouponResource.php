<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'title' => $this->title ?? "",
            "description" => $this->description ?? "",
            'code' =>$this->name,
            'start' => $this->date_from,
            'end' => $this->date_to,
            'value' => $this->value,
            'is_percentage' => $this->percentage,
            'minmum_price' => $this->minmum_price,
            //'seller_ids' => $this->sellers->pluck("id")
          
            
            ];
    }
}
