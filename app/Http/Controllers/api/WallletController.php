<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\traits\ApiTrait;
use App\User;
use App\Http\Resources\ProblemReasonResource;
class WallletController extends Controller
{
    use ApiTrait;
    public function wallet_amount(){
        try{
         
         $user = auth()->user();
             $msg =     "wallet_amount";
             return $this->dataResponse($msg, $user->wallet_amount	,200);
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }
}