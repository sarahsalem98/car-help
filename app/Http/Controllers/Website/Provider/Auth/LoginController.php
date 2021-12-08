<?php

namespace App\Http\Controllers\Website\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:providerWeb', ['except' => ['logout']]);
    }

    public function loginPage(){
      return view('website.provider.login');
    }


    public function login(ProviderLogin $request){
      $validatedData = $request->validated();
        if(Auth::guard('providerWeb')
        ->attempt(
          ['phone_number'=>$validatedData['phone_number'],
          'password'=>$validatedData['password']
        ])){
          return redirect()->route('provider.statistics');
        }
        else{
         return redirect()->back()->with('message',trans('auth.failed'));
        }
    }


    public function logout(Request $request){
     if(Auth::guard('providerWeb')->check()){

       Auth::guard('providerWeb')->logout();
      //  $request->session()->flush();
      //  $request->session()->regenerate();
       return  redirect()->route('provider.login.page');
     }
    }
    
}
