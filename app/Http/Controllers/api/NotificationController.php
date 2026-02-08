<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;
class NotificationController extends Controller
{
    use ApiTrait; 
    public function your_notifications(){
        try {
        $notifications = Notification::where("user_id",auth()->id())->get();
      
            $msg ="your_notifications";
            return $this->dataResponse($msg,  NotificationResource::collection($notifications),200);

       } catch (\Exception$ex) {
           return $this->returnException($ex->getMessage(), 500);
       }
    }
}