<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserWalletTransformation;
use App\DataTables\UserWalletTransformationDataTable;
use App\traits\generaltrait;
use App\Models\Notification;
class UserwalletController extends Controller 
{
   use generaltrait;
  public function create()
  {
    $users = User::select("id","phone","name","user_code")->get();
    return view("admindashboard.userwallets.create",compact("users"));
  }public function store(Request $request){
        $key = $this->notification_key();
      $transfer =new  UserWalletTransformation;
      $transfer->user_id = $request->user_id;
      $transfer->employee_id = auth()->id();
      $transfer->value = $request->value;
      $transfer->save();
      $user = User::where("id",$request->user_id)->first();
      $user->wallet_amount +=$request->value;
      $user->save();
       $not = new Notification;
        $not->user_id = $user->id;
        $not->title ="اشعار جديد";
        $not->text = "تم ايداع مبلغ ".$transfer->value ."الى محفظتك"; 
        $not->save();
         $to = $user->device_token;
        $data = [
            "to" =>$to,
             "notification" =>[
                    "title" => $not->title,
                    'body' => $not->text,
                ],
            "data" =>[
                    "title" => $not->title,
                    'body' => $not->text,
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                    'type' => 'public'
                ], 
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key='.$key,
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
      $result=curl_exec($ch);
      return redirect()->route("userwallets");
  }  public function index(UserWalletTransformationDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.userwallets.index');
    }
  
}

?>