<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendNotificationController extends Controller
{
    static function sendNotification(Request $request,$isClient,$order_id,$order_type,$title,$body)

    { 
        
        if($isClient==1){
            $id=Auth::user()->id;
            $firebaseToken =Client::where('id',$id)->pluck('device_token');
    
        }else{

            $firebaseToken =Provider::where('id',$request->provider_id)->pluck('device_token');
        }
        $SERVER_API_KEY = 'AAAAXV426tk:APA91bHtqNVU4U63DTWNk7Ljl2XyPWLWVzhH8o3sKjghAxJaXxLTmtIi-MXNkBN_kTr6jUF3bgtHdSAC9s9Va8xw8BN8KrZcrqgcJzRZ9E5AamsPdb73_5sKe2yqcU1ltsPCXHKjCHVH';


        $data = [
             "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body
            ] ,   "data" => [
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                "order_id"=>$order_id,
                "order_type"=>$order_type
            ]

        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
      return  $response = curl_exec($ch);
    }

}
