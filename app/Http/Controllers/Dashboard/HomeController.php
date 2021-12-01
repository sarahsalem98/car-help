<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\More;
use App\Models\Order;
use App\Models\Provider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome(){
        $clients=Client::count();
        $providers=Provider::count();
        $orders=Order::where('status',4)->count();
        $more=More::pluck('commission')[0];
        // dd($more);
       $revenue=$orders*$more;

        return view('Admin.home',['clients'=>$clients,'providers'=>$providers,'orders'=>$orders,'revenue'=>$revenue]);
    }
}
