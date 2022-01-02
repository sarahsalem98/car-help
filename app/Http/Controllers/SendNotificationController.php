<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Notification;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendNotificationController extends Controller
{
    static function sendNotification($user_id,$isClient,$order_id,$order_type,$title,$body ,$title_en,$body_en)

    { 
        
        if($isClient==1){
            // $id=Auth::user()->id;
            $firebaseToken =Client::where('id',$user_id)->pluck('device_token');
    
        }else{

            $firebaseToken =Provider::where('id',$user_id)->pluck('device_token');
        }
        $SERVER_API_KEY = 'AAAA1nmg8oc:APA91bE96NqqUOI1TNbE2N7tvFj7jL-jAREu0ox9jUHDq3_LHJQfW0KbLB7432xwkY27cznN84SgQdPyzJnGN366S0_CvKjnTvlse9J0t_zi-UX2YNO8Y7RNVp2WFzuHLb6_v4GFW04B';


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

        $notification=new Notification;
        $notification->order_id=$order_id;
        $notification->order_type=$order_type;
        $notification->title=$title;
        $notification->body=$body;
        $notification->title_en=$title_en;
        $notification->body_en=$body_en;
        $notification->user_id= $user_id;
        $notification->is_client=$isClient;
        $notification->save();
      return  $response = curl_exec($ch);
    }

    public function notificationApiClient(){
        $id=Auth::user()->id;
        $notifications=Notification::where('user_id',$id)->where('is_client',1)->get();
        return response()->json(['notifications'=>$notifications],200);
    }
    public function notificationApiProvider(){
        $id=Auth::user()->id;
        $notifications=Notification::where('user_id',$id)->where('is_client',0)->get();
        return response()->json(['notifications'=>$notifications],200);
    }


}
