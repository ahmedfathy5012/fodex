<?php

namespace App\Services;

use App\Services\Constants;

class SendNotification
{

    private static $URL = "https://fcm.googleapis.com/fcm/send";  

  

    public function send($token, $title,$text)
    {
        $data = [
            "to" =>$token,
            "data" =>[
                    "title" => $title,
                    'body' => $text,
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"
                ], 
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . Constants::NOTIFICATION_KEY, 
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $result=curl_exec($ch);
        return true;
    }
}