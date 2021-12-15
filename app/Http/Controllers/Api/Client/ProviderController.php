<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentForProvider;
use App\Models\Category;
use App\Models\Client;
use App\Models\CommentAndRate;
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

    public function addProviderToFavourites($providerId)
    {
        $clientid = Auth::user()->id;
        $client = Client::find($clientid);
        $provider=Provider::find($providerId);
        if($provider){
            $client->favouriteProviders()->syncWithoutDetaching(Provider::find($providerId));
            return response()->json(["provider" =>$provider],201);

        }else{
            return response()->json(['errors'=>'this provider is not found '],404);
        }
      
    }

    public function showFavouriteProviders(){
        $clientid = Auth::user()->id;
        $client = Client::find($clientid);
      return  response()->json(['providers'=> $client->favouriteProviders()->with('address.city')->get()],200);
    }

    public function showProviderProfile($providerId){
     $provider= Provider::find($providerId);
     if($provider){

         return response()->json(['provider'=>
         Provider::where('id',$providerId)->with('subServices','address.city','brandTypes','workHour','product.category')->get() ],200);
     }else{
         return response()->json(['errors'=>"provider with this id {$providerId} is not found "],404);
     }
    }

    public function showProductCategory($providerId){
     
           $products=Product::where('provider_id',$providerId)->with('category')->get();
       
            return response()->json(['provider'=>$products],200);
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
        return response()->json(['message' => 'comment is added succfully for this provider and provider rate was updated '], 201);
    }


    
    
}
