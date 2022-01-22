<?php

namespace App\Http\Controllers\Website\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function showFavouriteProviders()
    {
        $client = Auth::user();
        // dd($client->favouriteProviders()->get());
        return view('website.client.favouriteProviders', ['providers' => $client->favouriteProviders]);
    }

    public function addProviderToFavourites($mainService_id, $providerId, $add)
    {
        $clientid = Auth::user()->id;
        $client = Client::find($clientid);
        $provider = Provider::find($providerId);

        if ($add == 1) {

            $client->favouriteProviders()->syncWithoutDetaching([$providerId => ['mainService_id' => $mainService_id]]);
            return redirect()->back();
        } else {
            $client->favouriteProviders()->detach($providerId);
            return redirect()->back();
        }

    }
    
}
