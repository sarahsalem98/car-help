<?php

namespace App\Http\Controllers\Website\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function updateProfilePage(){
        $client=Auth::user();
        $cities=City::all();
        return view('website.client.profile.update',['client'=>$client,'cities'=>$cities]);
    }
    public function updateProfile(Request $request){
        
        $id=Auth::user()->id;
        $client=Client::find($id);
        $photoName=$client->profile_photo_path;
        if(! $request->phone_number==$client->phone_number){
          $data=$request->validate([
                'name'=>'max:255|alpha|required',
                'phone_number'=>'unique:clients|required',
                'city_id'=>'exists:cities,id|required',
                'profile_photo_path.*'=>'image|mimes:jpeg,png,jpg,gif,svg',
                'country_code_name'=>'required',
                'phone_number_without_country_code'=>'required'
            ]);
        }else{
            $data= $request->validate([
                'name'=>'max:255|alpha|required',
                'phone_number'=>'required',
                'city_id'=>'exists:cities,id|required',
                'profile_photo_path.*'=>'image|mimes:jpeg,png,jpg,gif,svg',
                'country_code_name'=>'required',
                'phone_number_without_country_code'=>'required'
            ]);
        }

       
        if ($request->file('profile_photo_path')) {
            if(Storage::exists($client->profile_photo_path )){
                Storage::delete($client->profile_photo_path);
              } 
            $photoName = $request->file('profile_photo_path')->store('profile_picture_client');
        }
        $client->fill($data);
        $client->profile_photo_path = $photoName;
        $client->phone_number_without_country_code=str_replace(' ', '', $request->phone_number_without_country_code);
        $client->save();
        return redirect()->back()->with('message','this client ias been updated successfully 😁');
    }
    public function updatePasswordPage(){
        return view('website.client.profile.password');
    }
    public function updatePassword(Request $request){
        $data = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $id = Auth::user()->id;
        //   dd($id);
        $client = Client::find($id);
        if (Hash::check($data['old_password'], $client->password)) {
            $client->password = bcrypt($data['new_password']);
            $client->save();
            return redirect()->back()->with('message', trans('auth.password_change'));
        } else {
            return redirect()->back()->with('message', trans('auth.password'));
        }
    }

    public function notifications(){
        // dd('sdg');
        $id=Auth::user()->id;
        $notifications=Notification::where('user_id',$id)->where('is_client',1)->get();
        return view('website.client.notifications',['notifications'=>$notifications]);
    }
}
