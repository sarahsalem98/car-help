<?php

namespace App\Http\Controllers\Website\Client;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function showFavouriteProviders(){
        $client=Auth::user();
        // dd($client->favouriteProviders()->get());
        return view('website.client.favouriteProviders',['providers'=>$client->favouriteProviders]);
    }
}
