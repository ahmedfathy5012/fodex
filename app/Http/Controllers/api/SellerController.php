<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Tag;
use App\Http\Resources\SellerResource;
use App\Http\Resources\PaginationResource;
class SellerController extends Controller
{
   public function closest_sellers(Request $request){
       $sellers = Seller::where('block',0)->paginate(30);
         return response()->json([
            'status' => true,
            'message' => 'closest sellers',
            'pagination' => new PaginationResource($sellers), 
            'data' => collect(SellerResource::collection($sellers))->sortBy('distance')->filter(function ($value) {     
                return $value["distance"] <= 20;     })->values()->toArray()
            ]);
   } public function major_shops(Request $request){
       $sellers = Seller::where('block',0)->where('major_id',$request->major_id)->paginate(50);
         return response()->json([
            'status' => true,
            'message' => 'closest sellers',
            'pagination' => new PaginationResource($sellers), 
            'data' => collect(SellerResource::collection($sellers))->sortBy('distance')->filter(function ($value) {   
                return $value["distance"] < 20;     })->values()->toArray()
            ]);
   }public function seller_tags(Request $request){
       if(Tag::where('id',$request->tag_id)->first()){
         $sellers = Tag::where('id',$request->tag_id)->first()->sellers()->paginate(50);
           return response()->json([
            'status' => true,
            'message' => 'seller_tags',
            'pagination' => new PaginationResource($sellers), 
            'data' => collect(SellerResource::collection($sellers))->sortBy('distance')->filter(function ($value) {   
                return $value["distance"] <= 20;     })->values()->toArray()
            ]);
           
       }else{
            return response()->json([
            'status' => false,
            'message' => 'هذا التاج غير موجود',
          
            'data' => []
            ]);
         }
         
   }
}
