<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientLogin;
use App\Http\Requests\ClientRegister;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function register(ClientRegister $request){
        $validatedData=$request->validated();
        $client=new Client;
        $client->fill($validatedData);
        $client->password=bcrypt($request['password']);
        $client->api_token=Str::random(100);
       if($client->save()){
           return response()->json([
               'message'=>'client has been created suceesfully',
                'verification_code'=>0000           
            ],201); 

       }else{
        return response()->json(['errors'=>'client was not created '],400);
       }
    }

    public function login(ClientLogin $request){
      $validatedData=$request->validated();
      $client=Client::where('phone_number',$validatedData['phone_number'])->first();
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

    public function forgetPassword(){

    }
    public function resetPassword(){

    }


  public function resendVerificationCode(){
      return response()->json(['verification_code'=>0000],200);
  }


}
