<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\MajorClassification;
use App\Http\Resources\SellerResource;
use App\Models\Seller;
use App\Http\Resources\MajorClassificationResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\HomeContentResource;
use App\Models\Major;
use App\traits\generaltrait;
use App\Models\MajorclassificationContent;
use App\Models\MajorClassificationSeller;
use App\Models\MajorsclassificationOffer;
use Illuminate\Support\Facades\File; 
use App\DataTables\SellerClassDataTable;
use App\traits\ApiTrait;
class MajorClassificationapiController extends Controller{
    
    use ApiTrait;
    
    public function majorclassifications(Request $request){
        $majors = MajorClassification::where("major_id",$request->major_id)->orderBy('order_number','asc')->get();
         $majors_collection = [];
         foreach($majors as $major){
         foreach($major->zones as $zone){
      $status = $this->is_in_polygon($request->lon,$request->lat,$zone->areas);
                   if($status){
                      $majors_collection[]=new HomeContentResource($major);
                   }
              }
         }
        return response()->json([
            'status' => true,
            'message' => 'majorclassifications',
            'data' => $majors_collection
        ]);
    }public function majorclassificationsads(Request $request){
      $offers =  MajorsclassificationOffer::where("majorclassification_id",$request->majorclassification_id)->get();
      if(count($offers) > 0){
           return response()->json([
            'status' => true,
            'message' => 'all offers',
            'data' => OfferResource::collection($offers)
            ]);
      }else{
           $offers = Offer::all();
        return response()->json([
            'status' => true,
            'message' => 'all offers',
            'data' => OfferResource::collection($offers)
            ]);
      }
    }public function majorclassificationscontent(Request $request){
       $majorcontent = MajorclassificationContent::where("majorclassification_id",$request->majorclassification_id)->get();
        return response()->json([
            'status' => true,
            'message' => 'all majors',
            'data' => HomeContentResource::collection($majorcontent)
            ]);
    }public function majorclassificationsellers(Request $request){
      $major =  MajorClassification::where("id",$request->id)->orderBy('order_number','asc')->first();
           return response()->json([
            'status' => true,
            'message' => 'all sellers',
            'data' =>   SellerResource::collection($major->sellers()->orderBy('order_number','asc')->get())->sortBy('distance')->values()->toArray()
            ]);
    }
}