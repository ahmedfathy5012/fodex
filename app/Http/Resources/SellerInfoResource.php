<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\traits\generaltrait;
use App\Http\Resources\TagResource;
use App\Http\Resources\PaymentResource;
class SellerInfoResource extends JsonResource
{
   use generaltrait;
    public function toArray($request)
    {
       
        return 
        [
            'id' => $this->id,
           
            ];
        
    }
}
