<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{



    public function clearCart(){
        $id=Auth::user()->id;
        $cart=Cart::where('client_id',$id);
        $cart->delete();
        return response()->json(['message'=>'cart is emptyed'],200);
    }
  public function cart(){
      $id=Auth::user()->id;
      $name=Auth::user()->name;
     $message=array();
      $carts=Cart::where('client_id',$id)->get();
    //   if (!$carts->isEmpty()) {
          foreach($carts as $cart){
              $product=Product::find($cart->product_id);
              if($cart->qty>$product->qty){
               
                $message[]= (array ("message"=>"product {$product->name} qty should not be more than the stock ",
                                   "product_id"=>$product->id,
                                   "provider_id"=>$product->provider_id  ) );
                $cart->qty=$product->qty;
                $cart->save();
              }else{
                  $message[]=(array("message"=>"product {$product->name} qty is in the stock ;)",
                  "product_id"=>$product->id ,
                  "provider_id"=>$product->provider_id )) ;

                  
              }
          }
          return response()->json(["cart"=>Cart::where('client_id',$id)->with('product.provider')->get(),
                                  "info"=>$message],200);
    //   }else{
    //     return response()->json(["cart"=>'no items were found in this cart'
    //     ],204);
    //   }
  }

  

    public function addTocart(Request $request, $product_id)
    {
        $data=$request->validate([
            'qty'=>'required|numeric'
        ]);

        $product = Product::find($product_id);
        $id = Auth::user()->id;
        $name = Auth::user()->name;
        $cart = Cart::where('product_id', $product_id)->where('client_id', $id)->first();
        $product=Product::find($product_id);
       
        if($data['qty']<=$product->qty){
            if ($cart) {
                if (!empty($data['qty'])) {
                  
                    $cart->update([
                        "qty" => $data['qty'],
                        "total_price" => $product->price_after_discount * $data['qty']
                    ]);
                    return response()->json([
                        "cart" => Cart::where('client_id',$id)->with('product.provider')->get()
                    ], 201);
                } else {
                    $cart->delete();
                    return response()->json(['message' => 'product is deleted successfully',
                    "cart" => Cart::where('client_id',$id)->with('product.provider')->get()
                ], 200);
                }
            } else {
                $newCart = new Cart;
                $newCart->client_id = $id;
                $newCart->qty = $data['qty'];
                $newCart->product_id = $request->product_id;
                $newCart->total_price = $product->price_after_discount * $data['qty'];
                $newCart->save();
    
                return response()->json([
                    "message" => "this product has been added successfully to {$name} cart ",
                    "cart" => Cart::where('client_id',$id)->with('product.provider')->get()
                ], 201);
            }
        }else{
            return response()->json(['errors'=>'the qty of the added items is more than in the stock'],400);
        }
   
    }
}
