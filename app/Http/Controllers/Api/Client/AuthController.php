<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientLogin;
use App\Http\Requests\ClientRegister;
use App\Http\Requests\ClientUpdate;
use App\Models\Client as userClint;
// use Facade\FlareClient\Http\Client;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AuthController extends Controller
{

    // protected function create(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'phone_number' => ['required', 'numeric', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    //     /* Get credentials from .env */
    //     $token = getenv("TWILIO_AUTH_TOKEN");
    //     $twilio_sid = getenv("TWILIO_SID");
    //     $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    //     $twilio = new Client ($twilio_sid, $token);


    //     $twilio->verify->v2->services($twilio_verify_sid)
    //         ->verifications
    //         ->create($data['phone_number'], "sms");
    //         userClint::create([
    //         'name' => $data['name'],
    //         'phone_number' => $data['phone_number'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    //     return redirect()->route('verify')->with(['phone_number' => $data['phone_number']]);
    // }



    public function register(ClientRegister $request){
        $validatedData=$request->validated();
        $token = "b62708c08866ef30b39db3ab263e2bfe";
        $twilio_sid = "AC060466ed6ae6732d8dfe766b525cf879";
        $twilio_verify_sid ="VA8b9553f392c59fd6e9c99eb728304651";
        $twilio = new Client ($twilio_sid, $token);
       $otp= $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($validatedData['phone_number'], "sms");

        $client=new userClint;
        $client->fill($validatedData);
        $client->password=bcrypt($request['password']);
        $client->api_token=Str::random(100);
       if($client->save()){
        redirect()->route('verify')->with(['phone_number' => $validatedData['phone_number']]); 
      

       }else{
        return response()->json(['errors'=>'client was not created '],400);
       }
    }


    public function verify(Request $request)
    {
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);
        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verification_code'], array('to' => $data['phone_number']));

          
        if ($verification->valid) {
            $user = tap(userClint::where('phone_number', $data['phone_number']))->update(['isVerified' => 1]);
            /* Authenticate user */
            // Auth::login($user->first());
            return redirect()->route('home')->with(['message' => 'Phone number verified']);
        }
        return back()->with(['phone_number' => $data['phone_number'], 'error' => 'Invalid verification code entered!']);
    }


    public function login(ClientLogin $request){
      $validatedData=$request->validated();
      $client=userClint::where('phone_number',$validatedData['phone_number'])->first();
      if($client){
          if(Hash::check($validatedData['password'],$client->password)){
              return response()->json(['client'=>$client],200);
          }else{
              return response()->json(['errors'=>'password mismach'],401);
          }
      }else{
          return response()->json(['errors'=>'client does not exist'],204);
      }
  
    }

//     public function forgetPassword(){
//    $this->verify()
//     }


    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password'=> 'required',
            'new_password' => 'required|confirmed',
        ]);
        if ($validator->fails())
        {
            return response([
                "message"=>'The given data was invalid.',
                "errors"=>$validator->errors()
            
            ], 422);


        }

        $id=Auth::user()->id;
        $client=userClint::find($id);
        if (Hash::check( $request->old_password,$client->password )){
            $client->password=bcrypt($request->new_password);
            $client->save();
            return response()->json(['message'=>'the new password is set as your current password'],201);
        }else{
            return response()->json(['errors'=>'the old password you entered is not correct '],422);
        }
    }


  public function resendVerificationCode(){
      return response()->json(['verification_code'=>0000],200);
  }


  public function updateProfile(ClientUpdate $request){
   
    $id=Auth::user()->id;
    $client=userClint::find($id);
    $validatedData=$request->validated();
    $client->fill($validatedData);
    if ($request->file('profile_photo_path')) {
        $photoName = $request->file('profile_photo_path')->store('profile_picture_client');
        $client->profile_photo_path = $photoName;
      }
    $client->save();
    return response()->json(['message'=>'clinet information was updated',
                               'the updaet client'=>$client   ],201);

  }


}
