<?php

namespace App\Http\Controllers\Website\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addressIndex(){
     
        return view('website.client.profile.address.index');
    }
}
