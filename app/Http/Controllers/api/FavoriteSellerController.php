<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\User;
use App\Models\Seller;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\SellerResource;
class FavoriteSellerController extends Controller
{
    public function favorite_seller(Request $request){
        $seller = Seller::where("id",$request->seller_id)->first();
        $user = auth()->user();
        $validator = Validator::make($request->all(),[
            'seller_id' => "required"],
            [
            'required' => 'حقل المطعم مطلوب'    ]);
            if($validator->passes()){

        if($seller){
            $arr=[];
         array_push($arr, $request->seller_id);
         if (in_array($request->seller_id, $user->favorite_sellers->pluck("id")->toArray())){
             $user->favorite_sellers()->detach($arr);
               return response()->json(['status' => true,'message' => 'تم الحذف من المفضله بنجاح']);
         }else{
             $user->favorite_sellers()->attach($arr); 
               return response()->json(['status' => true,'message' => 'تم الاضافه الى المفضله بنجاح']);
         }
        }else{
            return response()->json(['status' => false,'message' => 'لا يوجد مطعم بهذا الاسم'],404);
        }                
            }else{
                return response()->json(['status' => false,'message' => $validator->errors()->first()],422);
            }
        
    } public function your_favorite_sellers(){
            $sellers = auth()->user()->favorite_sellers;
            return response()->json(['status'=> true,'message'=> 'المطاعم المفضله ',
            'data' => SellerResource::collection($sellers)]);
    }
}