<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
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

class ProviderController extends Controller
{
    public function mainShowProvider($mainId)
    {
        $service = Service::find($mainId);
        $providers = $service->subservice()
            ->whereHas('provider')
            ->with('provider.address')
            ->get();
        return response()->json(["providers"  => $providers], 200);
    }

    public function addProviderToFavourites($mainService_id,$providerId,$add)
    {
        $clientid = Auth::user()->id;
        $client = Client::find($clientid);
        $provider = Provider::find($providerId);
        if ($provider) {
            if($add==1){

                $client->favouriteProviders()->syncWithoutDetaching([$providerId=>['mainService_id'=>$mainService_id]]);
                return response()->json(["provider" => $provider], 201);
            }else{
                $client->favouriteProviders()->detach($providerId);
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
        $providers = Provider::has('address')->get();
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
