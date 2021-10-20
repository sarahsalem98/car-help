<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
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
        return response()->json(["all provider for {$service->name} main service"  => $providers], 200);
    }

    public function addProviderToFavourites($providerId)
    {
        $clientid = Auth::user()->id;
        $client = Client::find($clientid);
        $provider=Provider::find($providerId);
        if($provider){
            $client->favouriteProviders()->syncWithoutDetaching(Provider::find($providerId));
            return response()->json(["message" => "this Provider{$provider->id} was added to favourites"],201);

        }else{
            return response()->json(['errors'=>'this provider is not found '],404);
        }
      
    }

    public function showFavouriteProviders(){
        $clientid = Auth::user()->id;
        $client = Client::find($clientid);
      return  response()->json(['all favourite providers'=> $client->favouriteProviders()->get()],200);
    }

    public function showProviderProfile($providerId){
     $provider= Provider::find($providerId);
     if($provider){

         return response()->json(['provider profile'=>
         Provider::where('id',$providerId)->with('subServices','address','brandTypes','workHour')->get() ],200);
     }else{
         return response()->json(['errors'=>"provider with this id {$providerId} is not found "],404);
     }
    }

    public function showProductCategory($providerId){
     
           $products=Product::where('provider_id',$providerId)->with('category')->get();
       
            return response()->json(['all provider products with their categories'=>$products],200);
    }


    
    
}
