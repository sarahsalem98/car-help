<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;

class Services extends Controller
{
 
public function getMainServices(){
    return response()->json(['main services'=>Service::all()]);
}
public function getSubServices(){
    return response()->json(['sub services'=>SubServices::all()]);
}

}
