<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentForProvider;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreProductOrder;
use App\Http\Requests\StorePublicPrivateOrder;
use App\Models\Cart;
use App\Models\ClientCancellation;
use App\Models\CommentAndRate;
use App\Models\OrderPrice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public $publicPrivateOrderStatus = [1, 3, 4];
    //1->قيد التنفيذ
    //3->مكتمله
    //4->ملغاه


    public function addCommentToProvider(StoreCommentForProvider $request, $provider_id)
    {
        $validatedData = $request->validated();
        $comment = new CommentAndRate;
        $comment->fill($validatedData);
        $comment->client_id = Auth::user()->id;
        $comment->provider_id = $provider_id;
         $comment->save();
        $allCommentsAvg=CommentAndRate::where('provider_id',$provider_id)->avg('rate') ;
        $provider=Provider::find($provider_id);
        $provider->rate=$allCommentsAvg;
        $provider->save();
        return response()->json(['message'=>'comment is added succfully for this provider and provider rate was updated '],201);
    } 


    public function cart(Request $request,$product_id){

      $product=Product::find($product_id);
      $id=Auth::user()->id;
      $name=Auth::user()->name;
      $cart=Cart::where('product_id',$product_id)->where('client_id',$id)->first();
      if($cart){
         if(!empty($request->qty)){
            $cart->update([
                "qty"=>$request->qty,
               "total_price"=>$product->price_after_discount * $request->qty
               ]);
               return response()->json(["the updated product  in the cart of  client {$name}"=>$cart,
                                         "{$name}'s cart"=>Cart::where('client_id',$id)->get()],201);
            }else{
              $cart->delete();
              return response()->json(['message'=>'product is deleted successfully'],200);
            }

      }else{
        $newCart=new Cart;
        $newCart->client_id=$id;
        $newCart->qty=$request->qty;
        $newCart->product_id=$request->product_id;
        $newCart->total_price=$product->price_after_discount * $request->qty;
        $newCart->save();
  
        return response()->json(["message"=>"this product has been added successfully to {$name} cart ",
                                  "{$name}'s cart"=>Cart::where('client_id',$id)->get() ],201);
      }

    }



















    public function makePublicPrivateOrder(StorePublicPrivateOrder $request)
    {

        $validateData = $request->validated();
        $order = new Order;
        $order->fill($validateData);
        $order->client_id = Auth::user()->id;
        $order->provider_id = $request->provider_id;
        if ($request->hasfile('images')) {

            foreach ($request->file('images') as $image) {
                $name = $image->store('public_private_order_images');
                $data[] = $name;
            }
            $order->images = json_encode($data);
        }
        $order->save();

        return response()->json([
            'message' => 'order was created successfully',
            'the created order' => $order
        ], 201);

        //دفع                

    }

    public function makeProductOrder(StoreProductOrder $request){
      $id=Auth::user()->id;
      $carts=Cart::where('client_id',$id)->get();
      if(!$carts->isEmpty()){
        $validateData=$request->validated();
        $order=new Order;
        $order->fill($validateData);
        $order->client_id =$id;
        $order->save();
    //    $order=Order::find(3);
        foreach($carts as $cart){
            $order->product()->attach($cart->product_id,[
                'qty'=> $cart->qty,
                'total_price'=>$cart->total_price
            ]);
            $cart->delete();
        }
   
        return response()->json(['message'=>'product order has been made succefully',
                                 'created order '=>$order->where('id',$order->id)->with('product')->get() ],201);
      }else{
          return response()->json(['errors'=>'cart is empty'],204);
      }
  
//دفع
    }

    public function showPublicOrders()
    {
        $id = Auth::user()->id;
        $orders = Order::where('provider_id', null)->where('client_id', $id)->with('client.city')->get();
        if ($orders) {

            return response()->json(['all public orders ' => $orders], 200);
        } else {
            return response()->json(['errors ' => "no public orders found"], 404);
        }
    }

    public function showPrivateOrders()
    {
        $id = Auth::user()->id;
        $orders = Order::whereNotNull('provider_id')->where('client_id', $id)->with('client.city')->get();
        if ($orders) {

            return response()->json(['all private orders ' => $orders], 200);
        } else {
            return response()->json(['errors ' => "no private orders found"], 404);
        }
    }


    public function showSpecificPublicOrPrivateOrder($order_id)
    {
        $order = Order::where('id', $order_id)->with('provider', 'client.address', 'price.provider','cancel.reason')->get();
        return response()->json(["the order with {$order_id} id" => $order], 200);
    }

    public function acceptPrice($price_id, $order_id)
    {
        $price = OrderPrice::where('id', $price_id)->where('order_id', $order_id)->get()[0];
        $order = Order::find($order_id);
        OrderPrice::where('id', '!=', $price_id)->where('order_id', $order_id)->delete();

        if ($order->provider_id == null) {
            $order->provider_id = $price->provider_id;
        }
        $order->status = $this->publicPrivateOrderStatus[0];
        $order->save();
        //الاشعارات
        return response()->json(['message' => "this price is accepted and other prices for the same order is deleted"], 200);
    }

    public function refusePrice($price_id, $order_id)
    {
        OrderPrice::where('id', $price_id)->where('order_id', $order_id)->delete();
        //الاشعارات
        return response()->json(['message' => "this price is deleted"], 200);
    }

    public function cancelOrder(Request $request){
  
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'cancel_id' => 'required',
            ]);
            if ($validator->fails())
            {
                return response([
                    "message"=>'The given data was invalid.',
                    "errors"=>$validator->errors()
                
                ], 422);
            }
            $order=Order::find($request->order_id);
            if($order->status==0){
                $cancel=new ClientCancellation;
                $cancel->order_id=$request->order_id;
                $cancel->client_id=Auth::user()->id;
                $cancel->cancel_id=$request->cancel_id;
                $cancel->save();
                $order->status=$this->publicPrivateOrderStatus[2];
                $order->save();
                return response()->json(['message'=>'cancelation reason has been added to this order'],201); 
            }else{
                return response()->json(['message'=>'you are not allowed to cancel this order'],405);
            }
            
     //دفع
 
}
}
