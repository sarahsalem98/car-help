<?php

namespace App\Http\Controllers\Website\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart(){
        return view('website.client.cart');
    }
}
