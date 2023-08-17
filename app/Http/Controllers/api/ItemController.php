<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Seller;
use App\Http\Resources\SizeResource;
use App\Http\Resources\ExtraResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\CategoryResource;
use App\traits\ApiTrait;
use Validator;

class ItemController extends Controller
{
     use ApiTrait;
   public function item_details(Request $request){
       $item = Item::where('id',$request->item_id)->firstOrFail();
       return response()->json([
           'status' => true,
           'message' => 'item_details',
           'sizes' => SizeResource::collection($item->sizes),
           'extras' => ExtraResource::collection($item->extras)
           ]);
   } public function seller_categories(Request $request){
       $rules = [
            "seller_id" => "required",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
       $seller =  Seller::where("id",$request->seller_id)->first();
      
   if(!$seller){
             $msg = 'لا يوجد مطعم بهذا  الاسم';
               return $this->errorResponse($msg,404);
               //->Has('items')->orHas('subcategories')
         }
       $categories = Seller::where('id',$request->seller_id)->first()->mycategories()->orderBy('pivot_order_number', 'asc')->get()->unique();
     //  dd($categories);
      //orderBy('pivot_order_number', 'asc')->WhereHas('items')->orWhereHas('subcategories')->
       return response()->json([
           'status' => true,
           'message' => 'seller_categories',
           'data' => CategoryResource::collection($categories),
           ]);
   } public function seller_subcategories(Request $request){
        $items = Item::where([['subcategory_id',$request->subcategory_id],['seller_id',$request->seller_id]])->get();
       return response()->json([
           'status' => true,
           'message' => 'seller_subcategories',
           'data' => ItemResource::collection($items),
           ]);
   }public function searchitems(Request $request){
         $items = Item::Where('title', 'like', '%' . $request->name . '%')->get();
          return response()->json([
           'status' => true,
           'message' => 'searchitems',
           'data' => ItemResource::collection($items),
           ]);
   }public function searchitemseller(Request $request){
         $items = Item::Where('title', 'like', '%' . $request->name . '%')->where('seller_id',$request->seller_id)->get();
          return response()->json([
           'status' => true,
           'message' => 'searchitemseller',
           'data' => ItemResource::collection($items),
           ]);
   }
}
