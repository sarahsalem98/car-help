<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\More;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function getMainPage()
    {
        $mainservices = Service::all();
        // if (Auth::guard('providerWeb')->check()) {
        //  dd(Auth::guard('providerWeb')->user());
        //     return view('website.main.mainpage', ['mainServices' => $mainservices,'provider'=>Auth::user()->id]);
  
        // }
        //else{

            return view('website.main.mainpage', ['mainServices' => $mainservices]);
      
    }
    public function setLocale($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
    public function getWhoWeArePage(){
       $who_are_we= More::all('who_are_we', 'who_are_we_en','id')->first();
    //    dd($who_are_we);
        return view('website.main.header.whoWeAre',['who_are_we'=>$who_are_we]);
    }
    public function getCategoryPage(){
        $mainservices = Service::all();
        return view('website.main.header.categories',['mainServices' => $mainservices]);
    }
    public function getContactUsPage(){
        return view('website.main.header.contactus');
    }
    public function storeContactUs(Request $request){
        // dd($request);
        $data=$request->validate([
            'phone_number'=>'required',
            'email'=>'required',
            'message'=>'required'
        ]);
        $contact_us=new ContactUs;
        $contact_us->fill($data);
        $contact_us->save();
        return redirect()->back()->with('message','your message was sent succeessfully');

    }
    
}
