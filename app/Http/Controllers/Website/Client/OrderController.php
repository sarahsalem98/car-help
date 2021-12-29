<?php

namespace App\Http\Controllers\Website\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicPrivateOrder;
use App\Models\Car;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function makeOrder(StorePublicPrivateOrder $request){
        $validateData = $request->validated();
        // dd($validateData['images']);
        if ( $validateData['order_type'] == 1) {
            $order = new Order;
            $order->fill($validateData);
            $order->client_id = Auth::user()->id;
            if ($request->hasfile('images')) {

                foreach ($request->file('images') as $image) {
                    $name = $image->store('public_private_order_images');
                    $data[] = $name;
                }
                $order->images = json_encode($data);
            }
            // $order->save();

            return response()->json(['status' => true, 'result' => 'Success']);

            //دفع          
        } else {
            return response()->json(['errors' => 'this order type is not public or private '], 400);
        }
    }
    public function makeOrderCar(Request $request){
        // dd($request);
         $data=$request->validate([
             'name'=>'required',
             'type'=>'required',
             'chassis_number'=>'required',
             'model_id'=>'required|exists:car_models,id',
             'details'=>'required',
             'images'=>'required',
             'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
             'provider_id'=>'required',
             'order_type'=>'required'

         ]);
         $car=new Car;
         $car->name=$data['name'];
         $car->type=$data['type'];
         $car->chassis_number=$data['chassis_number'];
         $car->client_id=Auth::user()->id;
         $car->model_id=$data['model_id'];
         $car->save();

         $order=new Order;
         $order->provider_id=$data['provider_id'];
         $order->order_type=$data['order_type'];
         $order->car_id=$car->id;
         $order->client_id=Auth::user()->id;
         $order->details=$data['details'];
         if ($request->hasfile('images')) {

            foreach ($request->file('images') as $image) {
                $name = $image->store('public_private_order_images');
                $images[] = $name;
            }
            $order->images = json_encode($images);
        }
        $order->save();

        return response()->json(['status' => true, 'result' => 'Success']);

    }
    public function publicOrder(){
       return view('website.client.publicOrder'); 
    }

    public function makePublicOrder(){

    }
}
