<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePriceForPublicPrivaterders;
use App\Models\OrderPrice;
use App\Models\Provider;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProviderCancellation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public $orderStatus = [1, 2,3,4, 5];
       //1->قيد التنفيذ
       //2->تم التجهيز
       //3->تم الاستلام
       //4->مكتمله
       //5->ملغاه

   public  function mainPage(){
       $id=Auth::user()->id;
       $newOrdersCount=Order::where('status',0)->where('provider_id',$id)->orWhere('provider_id',null)->count();
       $nowOrdersCount=Order::where('status',1)->orWhere('status',2)->where('provider_id',$id)->count();
       $finishedOrdersCount=Order::where('status',3)->where('provider_id',$id)->count();
       $canceledOrdersCount=Order::where('status',4)->where('provider_id',$id)->count();
       $providerProducts=Product::where('provider_id',$id)->sum('qty');
    return response()->json(['new_orders_count '=>$newOrdersCount,
                              'now_orders_count'=>$nowOrdersCount,
                              'finished_orders_count'=>$finishedOrdersCount,
                              'canceled_orders_count'=>$canceledOrdersCount,
                              'provider_products'=>$providerProducts
   ],200);

   }





    public function addServicePrice(StorePriceForPublicPrivaterders $request){
        $validatedDate=$request->validated();
        $order=Order::where('id',$validatedDate['order_id'])->get()[0];
        if($order->status==0){
            if($order->provider_id==null || $order->provider_id==Auth::user()->id){
                $price=new OrderPrice;
                $price->fill($validatedDate);
                $price->provider_id=Auth::user()->id;
                $price->save();
                return response()->json(['message'=>"price added successfully to this order {$request->order_id}",
                                         'price'=>$price ],201);
            }else{
                return response()->json(['message'=>'you are not allowed to add price this order'],405);
            }
        }else{
            return response()->json(['message'=>'this order has already taken '],400);
        }
     
       
    }


    public function showProviderServices(){
        $id=Auth::user()->id;
        $name=Auth::user()->enginner_name;
   
        $orders=Order::where('provider_id',$id)->where('order_type',0)->orWhere('order_type',1)->orWhere('provider_id',null)->get();
        return response()->json(["orders"=>$orders],200);
    }



    public function showSpecificOrder($order_id){
        $id=Auth::user()->id;
        $order=Order::where('id',$order_id)->with('client','price','address','providerCancel.reason','comment','product')->get();
        return response()->json(["order"=>$order],200);
    }


    public function cancelOrder(Request $request){

        $data = $request->validate([
            'order_id' => 'required',
            'cancel_id' => 'required',
        ]);
     
        $order = Order::find($data['order_id']);
        if ($order->status == 0) {
            $cancel = new ProviderCancellation;
            $cancel->order_id = $data['order_id'];
            $cancel->provider_id = Auth::user()->id;
            $cancel->cancel_id =$data['cancel_id'];
            $cancel->save();
            $order->status = $this->orderStatus[4];
            $order->save();
            return response()->json(['message' => 'cancelation reason has been added to this service'], 201);
        } else {
            return response()->json(['message' => 'you are not allowed to cancel this service'], 405);
        }

        //دفع

    
    }

    public function completeService($service_id){
            $service=Order::find($service_id);
            if($service->status==$this->orderStatus[0]){
                $service->status=$this->orderStatus[3];
                $service->save();
                return response()->json(['message'=>"service {$service_id} is completed"],200);
            }else{
               return response()->json(['errors'=>'you are not allowed to perform this action'],400);
            }
    }



public function showProductOrders(){
    $id=Auth::user()->id;
    $name=Auth::user()->enginner_name;
    $orders=Order::where('provider_id',$id)->where('order_type',2)->get();
    return response()->json(["orders"=>$orders],200);
}


public function acceptOrder($order_id){
    $order=Order::find($order_id);
    if($order->status==0){
        $order->status=$this->orderStatus[0];
        $order->save();
        return response()->json(['message'=>"order {$order_id} is accepted "],200);    
    }else{
        return response()->json(['errors'=>'you are not allowed to perform this action'],400);
    }
}

public function isPrepared($order_id){
    $order=Order::find($order_id);
    if($order->status==$this->orderStatus[0]){
        $order->status=$this->orderStatus[1];
        $order->save();
        return response()->json(['message'=>"order {$order_id} is prepared "],200);    
    }else{
        return response()->json(['errors'=>'you are not allowed to perform this action'],400);
    }

}

public function isDeliverd($order_id){
    $order=Order::find($order_id);
    if($order->status==$this->orderStatus[1]){
        $order->status=$this->orderStatus[3];
        $order->save();
        return response()->json(['message'=>"order {$order_id} is deliverd and completed "],200);    
    }else{
        return response()->json(['errors'=>'you are not allowed to perform this action'],400);
    }  

}








}
