<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\MoreController;

class Services extends Controller
{
  
 
public function getMainServices(){
    $more=new MoreController();
    return response()->json(['main services'=>$more->getLocaleData(Service::all())]);
}
public function getSubServices(){
    $more=new MoreController();
    return response()->json(['sub services'=>$more->getLocaleData(SubServices::all())]);
}

}
