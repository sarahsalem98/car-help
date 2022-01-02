<?php

namespace App\Http\Controllers\Website\Provider\Order;

use App\Http\Controllers\Controller;
use App\Models\CancellationReasons;
use App\Models\More;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public $orderStatus = [1, 2,3,4, 5];
      //1->قيد التنفيذ
       //2->تم التجهيز
       //3->تم التسليم
       //4->مكتمله
       //5->ملغاه
    private function operation($order){
        $total_price=0;
        foreach($order->product as $pro){
    
            $total_price = $total_price+$pro->pivot->total_price;
        }
        $commession= More::all('commission', 'id')->first();
        $commession_price=($commession['commission']/100)*$total_price;
        $final_price=$total_price+$commession_price;
        return array('total_price'=>$total_price,'commession'=>$commession,'commession_price'=>$commession_price,'final_price'=>$final_price);
    }





    public function showProducteOrders(){
        $id=Auth::user()->id;
        $orders=Order::where('order_type',2)
        ->where('provider_id',$id)->get();
        // dd($publicPrivateOrders);
        return view('website.provider.order.product.index',['orders'=>$orders]);
    }


    public function showProductNewOrder($order_id){
    $order=Order::find($order_id);
    $cacellationReasons=CancellationReasons::all();
    $data=$this->operation($order);
    return view('website.provider.order.product.newShow',['cacellationReasons'=>$cacellationReasons,'order'=>$order,'total_price'=>$data['total_price'],'commession'=>$data['commession'],'commession_price'=>$data['commession_price'],'final_price'=>$data['final_price']]);
    }

    

    public function showIsAccepted($order_id){
      
        $order=Order::find($order_id);
        $data=$this->operation($order);
        return view('website.provider.order.product.isAcceptedShow',['order'=>$order,'total_price'=>$data['total_price'],'commession'=>$data['commession'],'commession_price'=>$data['commession_price'],'final_price'=>$data['final_price']]);
    }

    public function acceptOrder($order_id){
        // dd($order_id);
        $order=Order::find($order_id);
        if($order->status==0){
            $order->status=$this->orderStatus[0];
            $order->save();
            return redirect()->route('provider.order.is.accepted.show',['order_id'=>$order_id]);    
        }else{
            return redirect()->back()->with('message','you are not allowed to perform this action on this order');
        }
    }
    public function showIsPrepared($order_id){
        $order=Order::find($order_id);
        $data=$this->operation($order);
        return view('website.provider.order.product.isPreparedShow',['order'=>$order,'total_price'=>$data['total_price'],'commession'=>$data['commession'],'commession_price'=>$data['commession_price'],'final_price'=>$data['final_price']]);
    }

    public function prepareOrder($order_id){
        $order=Order::find($order_id);
        if($order->status==$this->orderStatus[0]){
            $order->status=$this->orderStatus[1];
            $order->save();
            return redirect()->route('provider.order.is.prepared.show',['order_id'=>$order_id]);    
        }else{
            return redirect()->back()->with('message','you are not allowed to perform this action on this order');
        }

    }

    public function delivereOrder(Request $request){

        $order=Order::find($request->order_id);
        if($order->status==$this->orderStatus[1]){
            $order->status=$this->orderStatus[2];
            $order->save();
            return response()->json(['status' => true, 'result' => 'Success']);  
        }else{
            return redirect()->back()->with('message','you are not allowed to perform this action on this order');
        }  
    }
    public function showComplete($order_id){
        // dd($order_id);
        $rate=['one','two','three','four','five'];
        $order=Order::find($order_id);
        $data=$this->operation($order);
        return view('website.provider.order.product.completeShow',['rate'=>$rate,'order'=>$order,'total_price'=>$data['total_price'],'commession'=>$data['commession'],'commession_price'=>$data['commession_price'],'final_price'=>$data['final_price']]); 
    }
    public function showCancel($order_id){
        $order=Order::find($order_id);
        $data=$this->operation($order);
        return view('website.provider.order.product.cancelShow',['order'=>$order,'total_price'=>$data['total_price'],'commession'=>$data['commession'],'commession_price'=>$data['commession_price'],'final_price'=>$data['final_price']]); 
    }
}
