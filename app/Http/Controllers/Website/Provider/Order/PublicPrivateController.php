<?php

namespace App\Http\Controllers\Website\Provider\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicPrivateController extends Controller
{
    public function showPublicePrivateOrders(){
        $id=Auth::user()->id;
        $publicPrivateOrders=Order::whereIn('order_type',[0,1])
        ->where('provider_id',$id)
        ->orWhere('provider_id',null)->get();
        // dd($publicPrivateOrders);
        return view('website.provider.order.publicPrivate',['public_private_orders'=>$publicPrivateOrders]);
    }
}
