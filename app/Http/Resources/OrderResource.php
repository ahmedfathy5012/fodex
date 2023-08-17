<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderItem2Resource;
use App\Models\OrderItem;
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//dd($this->items);
//dd(OrderItem::where("order_id",$this->id)->get());
        return [
            'id' => $this->id,
            'seller_name' => $this->seller->name ?? '',
            'seller_id' => intval($this->seller_id),
            'seller_image' => $this->seller->image_link ?? '',
            'order_code' => strval($this->id),
            'order_status' => intval($this->status),
            'cancel' => $this->cancel ? 1 :0,
            'delivery_status' => intval($this->delivery_status),
            'delivery_phone' => $this->driver->phone ?? '',
            'delivery_name' => $this->driver->name ?? '',
            'receiving_address' => $this->address ?? '',
             'receiving_flat_number' =>$this->flat_number ?? 0 ,
             'receiving_floor_number' => $this->floor_number ?? 0 ,
            'receiving_building_number' => $this->building_number,
            
           // 'receiving_time' => '',
          //  'payment_method' => ,
          'order_price' => [
               'price'  => intval($this->price) - intval($this->delivery_fee),
                'discount' => intval($this->priceafterdiscount) - (intval($this->price)),
                'delivery_fee'=> intval($this->delivery_fee),
                ///'taxis' => 
                'price_after_discount' =>  intval($this->priceafterdiscount) - intval($this->delivery_fee),
                'total' => intval($this->price),
                'total_after_discount' => intval($this->priceafterdiscount),
                'currency' => $this->seller->currency ?? ""
              ],
          'items' => OrderItem2Resource::collection($this->order_items),
          'payment_method' => new PaymentResource($this->payment) ?? null,
          'seller_lat'    => $this->seller->address->lat ?? null,
          'seller_lon'    => $this->seller->address->lon ?? null,
          'seller_address' => $this->seller->address->address ?? "",
          'recieving_lat' => $this->lat ?? null,
          "recieving_lon" => $this->lon ?? null,
          'delivery_image' => $this->driver ? asset("uploads/".$this->driver->image) : "",
          'client_name' => $this->user->name ?? "",
          'client_phone' => $this->user->phone ?? "",
          'seller_phone' => $this->seller->phone ?? "",
          'seller_status' => intval($this->seller_status),
         'currency' => $this->seller->currency ?? ""

            
            ];
    }
}
