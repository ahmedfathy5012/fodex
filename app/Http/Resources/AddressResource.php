<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Extradetail;
use App\Http\Resources\SellerResource;
class AddressResource extends JsonResource
{
    
    public function toArray($request)
    {
      
        return [
            'id' => intval($this->id),
           "address" => $this->address ?? "",
           "flat_number" => strval($this->flat_number) ?? "",
           "floor_number" => strval($this->floor_number) ?? "",
           "building_number" => strval($this->building_number) ?? "",
           "phone" => strval($this->phone) ?? "",
           "building_type" => strval($this->building_type) ?? "",
           "lat" => strval($this->lat) ?? "",
           "lon" => strval($this->lon) ?? "",
           "active"=> $this->active ? 1 :0
            ];
    }
}
