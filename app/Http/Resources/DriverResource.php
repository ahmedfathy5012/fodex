<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
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
            'api_token' => $this->api_token,
            "lat" => $this->address->lat ?? "",
            "lon" => $this->address->lon ?? "",
            "is_company" => intval($this->is_company)
          
            
            ];
    }
}
