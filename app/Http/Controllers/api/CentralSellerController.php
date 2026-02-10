<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Models\Seller;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CentralSellerController extends Controller
{
    use ApiTrait;
    public function get_central_sellers(Request $request)
    {
        try {
            $direction = $request->direction ?? 'asc';
            $rules = [
                'direction' => 'nullable|in:asc,desc',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }

            $sellers = Seller::withoutGlobalScope(\App\Scopes\CentralRestaurantVisibilityScope::class)->where('block', 0)->where('is_central', 1)
                ->orderBy('id', $direction)->get();
            $sellers = collect(SellerResource::collection($sellers))->sortBy('distance')->filter(function ($value) {
                return $value["distance"] <= 20;
            })->values()->toArray();
            $msg = "البائعين المركزيين";
            return $this->dataResponse($msg, $sellers, 200);
        } catch (\Exception $ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
