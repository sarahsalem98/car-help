<?php

namespace App\Http\Controllers\Website\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
   public function orderIndex(){
       $orders=Order::all();
       $id=Auth::user()->id;
       $productOrders=Order::where('order_type',2)->where('client_id',$id)->get();
       $publicOrders=Order::where('order_type',0)->where('client_id',$id)->get();
       $privateOrders=Order::where('order_type',1)->where('client_id',$id)->get();
       return view('website.client.profile.orders.index',
       ['productOrders'=>$productOrders
       ,'publicOrders'=>$publicOrders
       ,'privateOrders'=>$privateOrders]);
   }
}
