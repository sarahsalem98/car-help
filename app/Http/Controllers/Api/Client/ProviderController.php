<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SendNotificationController;
use App\Http\Requests\StoreCommentForProvider;
use App\Models\Category;
use App\Models\Client;
use App\Models\CommentAndRate;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    public function mainShowProvider($mainId)
    {
         $service = Service::find($mainId);
        //  $providers= DB::table('services')->select('services.id as main_service_id','providers.*')
        //  ->where('services.id','=',$mainId)
        //  ->join('sub_services', 'services.id', '=', 'sub_services.service_id')
        //  ->join('provider_subservices', 'sub_services.id', '=', 'provider_subservices.subservice_id')
        //  ->join('providers', 'providers.id', '=', 'provider_subservices.provider_id');
     
        // //  ->join('providers as p', 'p.id', '=', 'provider_addresses.provider_id')
   
        //  $providerWithAdress=DB::table('provider_addresses')->rightJoinSub($providers,'providers',function($join){
        //      $join->on('provider_addresses.provider_id','=','providers.id');
            
        //  })->get();
        $providers = $service->subservice()
        ->whereHas('provider.address')
        ->with('provider.address')
        ->get();
        // $pope=$providers->with('')
        return response()->json(["providers"  => $providers], 200);
    }

    public function addProviderToFavourites(Request $request)
    {
        $data=$request->validate([
            'provider_id'=>'required',
            'add'=>'required'
        ]);
        $clientid = Auth::user()->id;
        $client = Client::find($clientid);
        $provider = Provider::find($data['provider_id']);
        if ($provider) {
            if($data['add']==1){

                $client->favouriteProviders()->syncWithoutDetaching([$data['provider_id']=>['mainService_id'=>$request->mainService_id]]);
                return response()->json(["provider" => $provider], 201);
            }else{
                $client->favouriteProviders()->detach($data['provider_id']);
                return response()->json(["message" => 'provider is removed from favourites'], 200);

            }
        } else {
            return response()->json(['errors' => 'this provider is not found '], 404);
        }
    }

    public function showFavouriteProviders()
    {
        $clientid = Auth::user()->id;
        $client = Client::find($clientid);
        return  response()->json(['providers' => $client->favouriteProviders()->with('address.city')->get()], 200);
    }

    public function showProviderProfile($providerId)
    {
        $provider = Provider::find($providerId);
        if ($provider) {

            return response()->json(['provider' =>
            Provider::where('id', $providerId)->with('subServices', 'address.city', 'brandTypes', 'workHour', 'product.category')->get()], 200);
        } else {
            return response()->json(['errors' => "provider with this id {$providerId} is not found "], 404);
        }
    }

    public function showProductCategory($providerId)
    {

        $products = Product::where('provider_id', $providerId)->with('category')->get();

        return response()->json(['provider' => $products], 200);
    }

    public function addCommentToProvider(StoreCommentForProvider $request)
    {
        $auth=Auth::user()->name;
        $validatedData = $request->validated();
        $comment = new CommentAndRate;
        $comment->fill($validatedData);
        $comment->client_id = Auth::user()->id;
        $comment->save();
        $allCommentsAvg = CommentAndRate::where('provider_id', $validatedData['provider_id'])->avg('rate');
        $provider = Provider::find($validatedData['provider_id']);
        $provider->rate = $allCommentsAvg;
        $provider->save();
        $order = Order::find($validatedData['order_id']);
        $order->status = 4;
        $order->save();

        SendNotificationController::sendNotification(
            $order->provider_id,
            0,
            $order->id,
            $order->order_type,
            ' لديك تعليق',
            "قام {$auth} بالتعليق على الخدمة الخاصة بك رقم {$order->id}",
            "you have new comment",
            "{$auth} commeted on your service {$order->id}"
        );
        return response()->json(['message' => 'comment is added succfully for this provider and provider rate was updated and order status is completed'], 201);
    }

    public function mapProviders(Request $request)
    {
        $data = $request->validate([
            'distance' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);
        // dd($request->distance);
        $providers = Provider::has('address')->with('subServices')->get();
        $selsectedProviders = array();
        if ($data['distance'] == 0) {
            return response()->json(['providers' => $providers], 200);
        }
        foreach ($providers as $provider) {
            // $distance = sqrt(($data['lat']-$provider->address->lat)^2 - ($data['long']-$provider->address->long)^2);
            $long1 = deg2rad($data['long']);
            $long2 = deg2rad($provider->address[0]->long);
            $lat1 = deg2rad($data['lat']);
            $lat2 = deg2rad($provider->address[0]->lat);
            //Haversine Formula
            $dlong = $long2 - $long1;
            $dlati = $lat2 - $lat1;
            $val = pow(sin($dlati / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($dlong / 2), 2);
            $res = 2 * asin(sqrt($val));
            $radius = 3958.756;
            $distance = $res * $radius * 1.609344;
            if ($distance <= $data['distance']) {
                array_push($selsectedProviders, $provider);
            }
           
        }
        return response()->json(['providers' => $selsectedProviders], 200);
    }
}
