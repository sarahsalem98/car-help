<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePriceForPublicPrivaterders;
use App\Models\OrderPrice;
use App\Models\Provider;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function addPriceToPublicPrivateOrders(StorePriceForPublicPrivaterders $request){
        $validatedDate=$request->validated();
        $order=Order::where('id',$validatedDate['order_id'])->get()[0];
        if($order->status==0){
            if($order->provider_id==null || $order->provider_id==Auth::user()->id){
                $price=new OrderPrice;
                $price->fill($validatedDate);
                $price->provider_id=Auth::user()->id;
                $price->save();
                return response()->json(['message'=>"price added successfully to this order {$request->order_id}",
                                         'price added'=>$price ],201);
            }else{
                return response()->json(['message'=>'you are not allowed to add price this order'],405);
            }
        }else{
            return response()->json(['message'=>'this order has already taken '],400);
        }
     
       
    }

}
