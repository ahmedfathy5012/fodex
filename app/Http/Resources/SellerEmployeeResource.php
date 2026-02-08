<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerEmployeeResource extends JsonResource
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
            'name' =>$this->name,
            'phone' => $this->phone,
            "seller_id" => intval($this->seller_id),
            "seller_name" => $this->seller->name ?? "",
            "open" =>$this->seller->open ? 1 : 0,
            "availability" => $this->seller->availability ? 1 : 0,
            "block" => $this->block ? 1 : 0,
            'api_token' => $this->api_token,
            
          
            
            ];
    }
}
