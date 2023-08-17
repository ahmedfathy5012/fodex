<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\traits\generaltrait;
use App\Models\Order;
class CaptainResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
        
       
     
    public function toArray($request)
    {
  
        $distance = 232332;
      if($this->address && $this->address && auth()->user()->address && auth()->user()->address){
        $distance = $this->distance($this->address->lat ?? null,$this->address->lon,auth()->user()->address->lat ?? null,auth()->user()->address->lon ?? null,'K');
            
      }
      $distance_seller = 2323;
      if($request->order_id){
             $order = Order::whereId($request->order_id)->first();

           if($order->seller->address && $order->seller->address && $this->address && $this->address){
        $distance_seller = $this->distance($this->address->lat ?? null,$this->address->lon,$order->seller->address->lat ?? null,$order->seller()->address->lon ?? null,'K');
            
      }
      }
        return [
            'id' => $this->id,
            'name' =>$this->name,
            'phone' => $this->phone,
            'start_shift' => $this->start_shift ?? null,
         'end_shift' => $this->end_shift ?? null,
          "available" => intval($this->available),
          "distance_from_company" => $distance,
          "distance_from_seller" => $distance_seller
            
            ];
    }
}
