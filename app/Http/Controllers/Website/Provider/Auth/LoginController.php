<?php

namespace App\Http\Controllers\Website\Provider\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:providerWeb', ['except' => ['logout']]);
    }

    public function loginPage(){
      return view('website.provider.login');
    }
    
}
