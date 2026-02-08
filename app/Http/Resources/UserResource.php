<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AddressResource;
class UserResource extends JsonResource
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
            'phone_verify' => intval($this->phone_verify),
            'phone' => $this->phone,
            'email' => $this->email ?? "",
            'api_token' => $this->api_token,
            'device_token' => $this->device_token,
             'lat' => $this->address !=null ? $this->address->lat !=null ? strval($this->address->lat) : '':'',
             'lon' => $this->address !=null ? $this->address->lon !=null ? strval($this->address->lon) : '':'',
             "address" => $this->address ? new AddressResource($this->address) : null
          
            
            ];
    }
}
