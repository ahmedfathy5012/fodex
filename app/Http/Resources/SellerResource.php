<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\traits\generaltrait;
use App\Http\Resources\TagResource;
use App\Http\Resources\PaymentResource;
use App\traits\ApiTrait;
use App\Models\SellerZone;
use App\Models\Zone;
use App\User;
use App\Models\DeliveryArea;
class SellerResource extends JsonResource
{
   use generaltrait,ApiTrait;
    public function toArray($request)
    {
        $out_of_range = 1;

        
           $zones= Zone::get();
               $delivery_fee = null;
                 // $out_of_range = 0;
                  
                     if(count($this->zones_of_seller) > 0){
               foreach($this->zones_of_seller as $seller_zone){
                      if($this->inside($request->lat,$request->lon,$seller_zone->areas)){
                          $out_of_range = 0;
                          break;
               }
              
              
              }
               }
               
                 
                  if($this->lat && $this->lon){
                foreach($zones as $zone){
              if($this->inside($request->lat,$request->lon,$zone->areas)){
                  
                 $distance = $this->res_distance($request->lat,$request->lon,$this->address->lat,$this->address->lon,'K');
               if($price_dels = $zone->prices()->where("from_distance","<",$distance)->where("to_distance",">",$distance)->first()){
                   $delivery_fee = $price_dels->price;
                   break;
               }
                    //$out_of_range = 1;
              
              }
          }
                  }
          if($delivery_fee == null){
                         // $out_of_range = 1;
          }
           $delivery_areas = DeliveryArea::get();
            $extra_del_price = 0;
              if($this->lat && $this->lon){
             foreach($delivery_areas as $delivery_area){
              if($this->inside($user->address->lat,$user->address->lon,$delivery_area->areas)){
                $extra_del_price = $delivery_area->price;
                break;
               }
              }
              }
        
        if($request->lat && $request->lon && $this->address){
            $distance1 = $this->distance($request->lat,$this->address->lon,$this->address->lat,$request->lon,'K');
            $distance = round($distance1,3);
             
        //      foreach($this->zones_of_seller as $zone){
        //  $status = $this->inside(doubleval($request->lat),doubleval($request->lon),$zone->areas);
        //           if($status){
                      
        //               $out_of_range = 0;
        //               $delivery_free = doubleval(SellerZone::where([["zone_id","=",$zone->id],
        //               ["seller_id","=",$this->id]])->first()->delivery_money);
        //           }
        //       }
        }else{
            $distance = 100154;
        }
        if(count($this->categories) == 0){
            $seller_type = "a";
        }else{
             $seller_type = "b"; 
        }
        $is_favorite = 0; 
       if($request->user_id){
           $user = User::where("id",$request->user_id)->first();
           if($user){
               if(in_array($this->id,$user->favorite_sellers->pluck("id")->toArray())){
                   $is_favorite = 1;
               }
           }
       }
    
        return 
        [
            'id' => $this->id,
            'name' => $this->name,
            'lat' => $this->address ? $this->address->lat : 0,
            'lon' => $this->address ? $this->address->lon : 0,
            'address' => $this->street ? $this->address->address : '',
            'major_id'=> intval($this->major_id),
            'closed' => $this->open ? 0 : 1,
            'delivery_time' => intval($this->prepare_time),
            // 'image' => $this->image ? asset('uploads/'.$this->image->image) : '',
            'image'=>'',
            'distance' => $distance,
            'cover_image' => $this->cover ? asset('uploads/'.$this->cover) : '',
            'logo_image' => $this->logo ? asset('uploads/'.$this->logo) : '',
            'seller_type' =>$seller_type,
            'categories' => count($this->categories) > 0 ? $this->categories->pluck('title') : [],
            'tags' => TagResource::collection($this->tags),
            'payments' => PaymentResource::collection($this->payments),
            "rate" => $this->rate,
            "curreny" => $this->currency,
            "is_new" => $this->is_new ? 1 : 0,
            "discount" => doubleval($this->discount),
            "available" => $this->availability ? 1 : 0,
           // "delivery_free" => $delivery_free,
            "payment_methods" => implode(",",$this->payments->pluck("title")->toArray()),
            'rates_number' => count($this->rates),
            'out_of_range' => $out_of_range,
            "is_favorite" => $is_favorite,
            'is_subcategory' => $this->is_subcategory ? 1 : 0,
            'agreed' => intval($this->agreed),
            "delivery_fee" => doubleval($delivery_fee + $extra_del_price)
            
            ];
        
    }
}
