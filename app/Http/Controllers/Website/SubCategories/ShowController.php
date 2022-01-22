<?php

namespace App\Http\Controllers\Website\SubCategories;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Client;
use App\Models\Provider;
use App\Models\providerAddress;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{
    public function indexProvider($mainCategoryId)
    {
        $service = Service::find($mainCategoryId);
        $subServices = $service->subservice()->get();
        $providers = $service->subservice()
            ->whereHas('provider')
            ->with('provider.address')
            ->get()->pluck('provider')->flatten();

         $addresses=providerAddress::all();
        //  dd($addresses);   
         $addressesCount=providerAddress::count();
        //   dd($subServices);
        return view(
            'website.subCategories.indexProvider',
            [
                'providers' => $providers,
                'mainCategory' => $service,
                'subCategories' => $subServices,
                'addresses'=>$addresses,
                'addressesCount'=>$addressesCount

            ]
        );
    }
    public function showProvider($mainCategory_id, $provider_id)
    {
        $id = Auth::user()->id;
        $client = Client::find($id);
        $provider = Provider::findOrFail($provider_id);
        $mainCategory = Service::find($mainCategory_id);
        $productCategories = Category::all();
        $providerProducts = $provider->product()->get();
        $clientCars = Car::where('client_id', $id)->get();
        $countCategory = Category::count();
        $carModels = CarModel::all();
        foreach ($providerProducts as $providerProduct) {

            if ($client->cart()->where('product_id', $providerProduct->id)->exists()) {
                $productOfProviderInCart = "1";
            }
        }

        if (empty($client->cart()->first())) {
            $cart = "0";
        } else {
            $cart = "1";
        }

        //  dd($countCategory);
        return view(
            'website.subCategories.showProvider',
            [
                'provider' => $provider, 'productCategories' => $productCategories, 'mainCategory' => $mainCategory, 'providerProducts' => $providerProducts,
                'countCategory' => $countCategory, 'clientCars' => $clientCars,
                'carModels' => $carModels,
                'productOfProviderInCart' => $productOfProviderInCart ?? null,
                "cart" => $cart
            ]
        );
    }
}
