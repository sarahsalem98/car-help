<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function publicOrderIndex(){
        $publicOrders=Order::where('order_type',0)->get();
        return view('Admin.Order.public',['publicOrders'=>$publicOrders]);
    }
    public function privateOrderIndex(){
        $privateOrders=Order::where('order_type',1)->get();
        return view('Admin.Order.private',['privateOrders'=>$privateOrders]);
    }
    public function productOrderIndex(){
        $productOrders=Order::where('order_type',2)->get();
        // $orderDeatails=ProductOrder::
        return view('Admin.Order.product',['productOrders'=>$productOrders]);
    }
}
