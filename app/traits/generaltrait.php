<?php

namespace App\traits;



trait generaltrait
{
    public function uploadimage($image, $file)
    {
        $imageName = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
        $photo = $image->storeAs($file, $imageName, 'uploads');
        return $photo;
    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
    public function notification_key()
    {
        return 'AAAAVXr9TPk:APA91bHZNUKiOeJhtedm_gz7oZcug24feavhrfwKjsHgrDWDgnc53FSr_p8vAFUxt--RuFWSoHxW1ouaxjnmQEZMiw-MZDty5UkTgQMiNPM1PeGdigHoKBhJp-210VVsMTOHepZBcjEK';
    }
    public function notification_body($title, $text, $to)
    {
        $data = [
            "to" => $to,
            "notification" => [
                // "title" => $not->title,
                // 'body' => $not->text,
            ],
            "data" => [
                "title" => $title,
                'body' => $text,
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                'type' => 'public'
            ],
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $this->notification_key(),
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $result = curl_exec($ch);
        dd($this->notification_key());
        return $result;
    }
}
