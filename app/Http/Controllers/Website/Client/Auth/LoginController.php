<?php

namespace App\Http\Controllers\Website\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:clientWeb', ['except' => ['logout']]);
    }
    public function loginPage(){
        return view('website.client.login');
    }

    public function login(ClientLogin $request){
      //  dd($request);
      //   $code=str_replace($request->pho,'',$request->phone_number);
      $validatedData = $request->validated();
      // dd($code);
          if(Auth::guard('clientWeb')
          ->attempt(
            ['phone_number'=>$validatedData['phone_number'],
            'password'=>$validatedData['password']
          ])){
            return redirect()->route('main');
          }
          else{
           return redirect()->back()->with('message',trans('auth.failed'));
          }
      }

      public function logout(Request $request){
        if(Auth::guard('clientWeb')->check()){
   
          Auth::guard('clientWeb')->logout();
         //  $request->session()->flush();
         //  $request->session()->regenerate();
          return  redirect()->route('client.login');
        }
       }
}
