<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Major;
use App\Http\Resources\SellerResource;
use Carbon\Carbon;
use Validator;
use App\traits\ApiTrait;

class SearchSellerController extends Controller
{
    use ApiTrait;
    public function search_sellers(Request $request)
    {
        try {
            $user = auth()->user();
            $word = $request->word;
            $direction = $request->direction ?? 'asc';
            $rules = [
                //   "major_id" => "required"
                'direction' => 'nullable|in:asc,desc',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }
            //   $major = Major::where("id",$request->major_id)->first();
            //  if(!$major){
            //      $msg = "لا يوجد قسم رئيسى بهذا الاسم";
            //       return $this->errorResponse($msg,404);
            //  }
            $sellers = Seller::when($word, function ($query) use ($word) {
                $query->where("name", 'LIKE', "%$word%");
            })->orderBy('id', $direction)->get();
            $sellers = collect(SellerResource::collection($sellers))->sortBy('distance')->filter(function ($value) {
                return $value["distance"] <= 20;
            })->values()->toArray();
            $msg = "بحث البائعين";
            return $this->dataResponse($msg, $sellers, 200);
        } catch (\Exception $ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
