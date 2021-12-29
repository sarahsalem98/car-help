<?php

namespace App\Http\Controllers\Website\Provider\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function showProducteOrders(){
        $id=Auth::user()->id;
        $orders=Order::where('order_type',2)
        ->where('provider_id',$id)->get();
        // dd($publicPrivateOrders);
        return view('website.provider.order.product.index',['orders'=>$orders]);
    }
}
