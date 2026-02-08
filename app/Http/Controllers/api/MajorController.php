<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MajorResource;
use App\Models\Major;
use App\Models\Offer;
use App\Models\MajorOffer;
use App\Models\HomeContent;
use App\Http\Resources\OfferResource;
use App\Http\Resources\HomeContentResource;
use App\traits\ApiTrait;
class MajorController extends Controller
{
      use ApiTrait;
    public function fetch_majors(Request $request){
        $majors = Major::orderBy("order_number","asc")->get();
        return response()->json([
            'status' => true,
            'message' => 'all majors',
            'data' => MajorResource::collection($majors)
            ]);
    }  public function fetch_home_adds(Request $request){
     $offers = Offer::all();
           $offer_collection = [];
         foreach($offers as $offer){
         foreach($offer->zones as $zone){
      $status = $this->is_in_polygon($request->lon,$request->lat,$zone->areas);
                   if($status){
                      $offer_collection[]=new OfferResource($offer);
                   }
              }
         }
        return response()->json([
            'status' => true,
            'message' => 'all offers',
            'data' => $offer_collection
            ]);
    }public function major_classifications(Request $request){
          $major = Major::where('id',$request->major_id)->firstOrFail();
        return response()->json([
            'status' => true,
            'message' => 'major',
            'data' => new MajorResource($major)
            ]);
    }public function major_adds(Request $request){
           $offers = MajorOffer::all();
    //       $offer_collection = [];
    //      foreach($offers as $offer){
    //      foreach($offer->zones as $zone){
    //   $status = $this->is_in_polygon($request->lon,$request->lat,$zone->areas);
    //               if($status){
    //                   $offer_collection[]=new OfferResource($offer);
    //               }
    //           }
    //      }
        return response()->json([
            'status' => true,
            'message' => 'all offers',
            'data' => OfferResource::collection($offers)
            ]);
    }public function home_content(Request $request){
         $majors = HomeContent::all();
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
            'message' => 'all majors',
            'data' =>$majors_collection
            ]);
    }
}
