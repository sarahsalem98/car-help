<?php

namespace App\Http\Controllers\Website\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function showProduct($mainCategory_id,$provider_id,$product_id){
           $id=Auth::user()->id;
           $client=Client::find($id);
            $product=Product::find($product_id);
            $mainCategory=Service::find($mainCategory_id);
            $provider=Provider::find($provider_id);
            $providerProducts=$provider->product()->get();
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
            return view('website.subCategories.showProduct',['productOfProviderInCart'=>$productOfProviderInCart ??null,'cart'=>$cart,'product'=>$product,'mainCategory'=>$mainCategory,'provider'=>$provider]);
    }
}
