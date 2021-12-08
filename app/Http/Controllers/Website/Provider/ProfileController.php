<?php

namespace App\Http\Controllers\Website\Provider;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
   
    public function showStatistics()
    {
        $id = Auth::user()->id;
        $newOrdersCount = Order::where('status', 0)->where('provider_id', $id)->orWhere('provider_id', null)->count();
        $nowOrdersCount = Order::where('provider_id', $id)->whereIn('status', [1, 2])->count();
        $finishedOrdersCount = Order::where('status', 3)->where('provider_id', $id)->count();
        $canceledOrdersCount = Order::where('status', 4)->where('provider_id', $id)->count();
        $providerProducts = Product::where('provider_id', $id)->sum('qty');
        return view('website.provider.statistics', [
            'new_orders_count' => $newOrdersCount,
            'now_orders_count' => $nowOrdersCount,
            'finished_orders_count' => $finishedOrdersCount,
            'canceled_orders_count' => $canceledOrdersCount,
            'provider_products' => $providerProducts
        ]);
    }
    public function updateProfilePage(){
        $provider=Auth::user();
        return view('website.provider.update.profile',['provider'=>$provider]);
    }


    public function updateProfile(Request $request){
        $AuthProvider = Auth::user();
        // dd($AuthProvider->phone_number);
        $photoName = $AuthProvider->workshop_photo_path;
       $fileName = $AuthProvider->business_registeration_file;

        if ($request->phone_number !=$AuthProvider->phone_number) {
            // dd($request);
            $data = $request->validate([
                'enginner_name' => 'string',
                'workshop_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'phone_number' => 'numeric|unique:providers',
                'whatsapp_number' => 'numeric',
                'email' => 'email',
                'business_registeration_file' => 'mimes:pdf,doc,docx'
            ]);
        } else {
            $data = $request->validate([
                'enginner_name' => 'string',
                'workshop_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'whatsapp_number' => 'numeric',
                'email' => 'email',
                'business_registeration_file' => 'mimes:pdf,doc,docx'
            ]);
        }

        if ($request->file('workshop_photo_path')) {
            if (Storage::exists($AuthProvider->workshop_photo_path)) {
                Storage::delete($AuthProvider->workshop_photo_path);
            }
            $photoName = $request->file('workshop_photo_path')->store('workshoph_Photos');
        }
        if ($request->file('business_registeration_file')) {
            // dd($AuthProvider->business_registeration_file);
            if (Storage::exists($AuthProvider->business_registeration_file)) {
                // dd('sa');
                Storage::delete($AuthProvider->business_registeration_file);
            }
            $fileName = $request->file('business_registeration_file')->store('businessrRegisteration_Files');
        }
        // dd($data['business_registeration_file']);
        $AuthProvider->fill($data);
        $AuthProvider->workshop_photo_path = $photoName;
        $AuthProvider->business_registeration_file = $fileName;
        $AuthProvider->save();
        return redirect()->back()->with('message', 'the provider basic information was updated succeesfully😊');
    }
}
