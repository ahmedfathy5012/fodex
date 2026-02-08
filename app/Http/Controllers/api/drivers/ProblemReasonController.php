<?php

namespace App\Http\Controllers\api\drivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProblemReason;
use Validator;
use Carbon\Carbon;
use App\traits\ApiTrait;
use App\Models\ProblemReasonOrder;
use App\Models\Order;
use App\Http\Resources\ProblemReasonResource;
class ProblemReasonController extends Controller
{
    use ApiTrait;
    public function fetch_problem_reasons(Request $request){
        try{
         
         $problems = ProblemReason::get();
             $msg =     "fetch_problem_reasons";
             return $this->dataResponse($msg, ProblemReasonResource::collection($problems),200);
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function send_problem_on_order(Request $request){
          try{
              $user = auth()->user();
       
        $rules = [
            "order_id" => "required|numeric",
            "problem_reason_id" => "required|numeric"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
         $order = Order::where("id",$request->order_id)->first();
     
         if(!$order){
             $msg = 'لا يوجد طلب بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }
           $problem = ProblemReason::where("id",$request->problem_reason_id)->first();
     
         if(!$problem){
             $msg = 'لا يوجد مشكله بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }
         $problemorder = new ProblemReasonOrder;
         $problemorder->order_id = $request->order_id;
         $problemorder->problem_reason_id = $request->problem_reason_id;
         $problemorder->driver_id = auth()->id();
         $problemorder->comment = $request->comment;
         $problemorder->save();
         $msg =     "تم ارسال المشكله بنجاح";
             return $this->successResponse($msg,200);
          }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }
}