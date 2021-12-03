<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class MoreController extends Controller
{
    public function getMainPage()
    {
        $mainservices = Service::all();
        return view('website.main.mainpage', ['mainServices' => $mainservices]);
    }
    public function setLocale($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
