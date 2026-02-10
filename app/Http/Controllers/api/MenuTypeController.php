<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuType\MenutypeResource;
use App\Http\Resources\SellerResource;
use App\Models\MenuType;
use App\Models\Seller;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuTypeController extends Controller
{
    use ApiTrait;
    public function fetch_menu_types(Request $request)
    {
        try {
            $direction = $request->direction ?? 'asc';
            $rules = [
                'direction' => 'nullable|in:asc,desc',
                'seller_id' => 'required|exists:sellers,id',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }


            
            $menu_types = MenuType::where('seller_id', $request->seller_id)
                ->orderBy('id', $direction)
                ->get();
            $resourceData = MenutypeResource::collection($menu_types);
            $msg = "أنواع المنيو";
            return $this->dataResponse($msg, $resourceData, 200);
        } catch (\Exception $ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
