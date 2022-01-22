<?php

namespace App\Http\Controllers\Website\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ClientsAddress;
use App\Models\More;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        $id = Auth::user()->id;
        $commession = More::all('commission', 'id')->first();
        $carts = Cart::where('client_id', $id)->get();
        $total_price = 0;
        foreach ($carts as $cart) {
            if($cart->qty>$cart->product->qty){
                $cart->qty=$cart->product->qty;
                $cart->save();
                $message[]= (array ("message"=>"product {$cart->product->name} qty should not be more than the stock ",
                "product_id"=>$cart->product->id,
                "provider_id"=>$cart->product->provider_id  ) );
            }
            $total_price = $total_price + $cart->total_price;
        }
        $commession_price = ($commession['commission'] / 100) * $total_price;
        $final_price = $total_price + $commession_price;
        $addresses = ClientsAddress::where('client_id', $id)->get();
        
        return view('website.client.cart', ['message'=>$message ??null,'carts' => $carts, 'addresses' => $addresses, 'commession' => $commession, 'total_price' => $total_price, 'commession_price' => $commession_price, 'final_price' => $final_price]);
    }
    public function updateCart(Request $request)
    {
        $qty = $request->qty;
        $cart_id = $request->cart_id;
        $cart_product = Cart::find($cart_id);
        $product_price = $cart_product->product->price_after_discount;
        //   $cart_product->qty=$qty;
        //   $cart_product->total_price=$qty*$product_price;
        $cart_product->update([
            'qty' => $qty,
            'total_price' => $qty * $product_price
        ]);
        return response()->json(['status' => true, 'result' => 'Success']);
    }

    public function postCart(Request $request)
    {
        // dd($request);
        $products = $request->product_id;
        $auth_user = Auth::user()->id;
        // dd($carts[0]);

        foreach ($products as $key => $product) {
            $cart = Cart::where('client_id', $auth_user)->where('product_id', $product)->first();
            $real_product = Product::find($product);
            $price = $real_product->price_after_discount;
            if ($request->qty[$key] == 0) {
                continue;
            } else {


                if (!$cart) {
                    $cart_new = new Cart;
                    $cart_new->create([
                        'product_id' => $product,
                        'client_id' => Auth::user()->id,
                        'qty' => $request->qty[$key],
                        'total_price' => $price * $request->qty[$key]
                    ]);
                } else {
                    $cart->update([
                        'qty' => $request->qty[$key],
                        'total_price' => $price * $request->qty[$key]
                    ]);
                }
            }
        }
        return redirect()->route('client.cart.show');
    }
    public function deleteProviderCart(Request $request)
    {
        $id = Auth::user()->id;
        $carts = Cart::where('client_id', $id)->get();
        if ($carts) {
            foreach ($carts as $cart) {
                $cart->delete();
            }
            return redirect()->back()->with('message', 'products in cart is deleted');
        }
    }
    public function postProducrCart(Request $request)
    {
        $product = $request->product_id;
        $auth_user = Auth::user()->id;
        $cart = Cart::where('client_id', $auth_user)->where('product_id', $product)->first();
        $real_product = Product::find($product);
        $price = $real_product->price_after_discount;
        if ($request->qty == 0) {
            return redirect()->back();
        } else {


            if (!$cart) {
                $cart_new = new Cart;
                $cart_new->create([
                    'product_id' => $product,
                    'client_id' => Auth::user()->id,
                    'qty' => $request->qty,
                    'total_price' => $price * $request->qty
                ]);
            } else {
                $cart->update([
                    'qty' => $request->qty,
                    'total_price' => $price * $request->qty
                ]);
            }
            return response()->json(['status' => true, 'result' => 'Success']);
        }
    }
}
