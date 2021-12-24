<?php

namespace App\Http\Controllers\Website\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProduct($mainCategory_id,$provider_id,$product_id){
       
            $product=Product::find($product_id);
            $mainCategory=Service::find($mainCategory_id);
            $provider=Provider::find($provider_id);
            return view('website.subCategories.showProduct',['product'=>$product,'mainCategory'=>$mainCategory,'provider'=>$provider]);
    }
}
