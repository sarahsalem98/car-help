<?php

namespace App\Http\Controllers\Website\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderRegister;
use App\Models\Provider;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest:providerWeb');
    }
    
   public  $next_step = ['service_type', 'brand_type', 'address', 'work_houres', 'finished'];
 

    public function registerFirstPage(){
        // dd(Session::get('locale'));
        return view('website.providerRegister.first');
    }
    public function registerServiceType(){
        $services=SubServices::all();
        return view('website.providerRegister.serviceType',['services'=>$services]);
    }
        public function register()
        {
            // dd($request);
        //   $validatedData = $request->validated();
        //   $provider = new Provider;
        //   $provider->fill($validatedData);
        //   $provider->password = bcrypt($request['password']);
        //   $provider->api_token = Str::random(100);
        //   $provider->next_step = $this->next_step[0];
        //   if ($request->file('workshop_photo_path')) {
        //     $photoName = $request->file('workshop_photo_path')->store('workshoph_Photos');
        //     $provider->workshop_photo_path = $photoName;
        //   }
        //   if ($request->file('business_registeration_file')) {
        //     $fileName = $request->file('business_registeration_file')->store('businessrRegisteration_Files');
        //     $provider->business_registeration_file = $fileName;
        //   }
        //   if ($provider->save()) {
            return redirect()->route('provider.register.service.type');
        //   }
        }

}
