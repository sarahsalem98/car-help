<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

  public function cart(){
      $id=Auth::user()->id;
      $name=Auth::user()->name;
    //   $message[]='';
      $carts=Cart::where('client_id',$id)->get();
      if (!$carts->isEmpty()) {
          foreach($carts as $cart){
              $product=Product::find($cart->product_id);
              if($cart->qty>$product->qty){
               
                $message[]= (array ("message"=>"product {$product->name} qty should not be more than the stock ",
                                   "product_id"=>$product->id ) );
                $cart->qty=$product->qty;
                $cart->save();
              }else{
                  $message[]=(array("message"=>"product {$product->name} qty is in the stock ;)",
                  "product_id"=>$product->id  )) ;

                  
              }
          }
          return response()->json([" {$name}'s cart"=>Cart::where('client_id',$id)->get(),
                                  "info"=>$message],200);
      }else{
        return response()->json([" {$name}'s cart"=>'no items were found in this cart'
        ],204);
      }
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
                        "the updated product  in the cart of  client {$name}" => $cart,
                        "{$name}'s cart" => Cart::where('client_id', $id)->get()
                    ], 201);
                } else {
                    $cart->delete();
                    return response()->json(['message' => 'product is deleted successfully'], 200);
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
                    "{$name}'s cart" => Cart::where('client_id', $id)->get()
                ], 201);
            }
        }else{
            return response()->json(['errors'=>'the qty of the added items is more than in the stock'],400);
        }
   
    }
}
