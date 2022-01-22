<?php

namespace App\Http\Controllers\Website\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProviderAddress;
use App\Models\BrandType;
use App\Models\City;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\Models\providerAddress;
use App\Models\ProviderWorkHour;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function updateProfilePage()
    {
        $provider = Auth::user();
        return view('website.provider.update.profile', ['provider' => $provider]);
    }


    public function updateProfile(Request $request)
    {

    //  ($request);
        // dd(str_replace(" ", "", $request->phone_number_without_country_code));
        $AuthProvider = Provider::find(Auth::user()->id);
        //  dd($AuthProvider);
        $photoName = $AuthProvider->workshop_photo_path;
        $fileName = $AuthProvider->business_registeration_file;

        if ($request->phone_number != $AuthProvider->phone_number) {
            // dd($request);
            $data = $request->validate([
                'enginner_name' => 'string',
                'workshop_name' => 'string',
                'workshop_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'phone_number' => 'numeric|unique:providers',
                'phone_number_without_country_code'=>'numeric',
                'country_code_name'=>'string|max:4',
                'whatsapp_number' => 'numeric',
                'email' => 'email',
                'business_registeration_file' => 'mimes:pdf,doc,docx'
            ]);
        } else {
            $data = $request->validate([
                'enginner_name' => 'string',
                'workshop_name' => 'string',
                'workshop_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'whatsapp_number' => 'numeric',
                'country_code_name'=>'string|max:4',
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

        $AuthProvider->fill($data);
        $AuthProvider->workshop_photo_path = $photoName;
        $AuthProvider->business_registeration_file = $fileName;
        // $AuthProvider->phone_number_without_country_code=str_replace(" ", "", $data['phone_number_without_country_code']);
        $AuthProvider->save();
        // dd('df');
        return redirect()->back()->with('message', trans('success.provider_updated'));
    }

    public function updateWorkHours(Request $request)
    {
        $arabicDayes = array_reverse(['الجمعة','الخميس','الاربعاء','الثلاثاء', 'الاثتنين', 'الاحد', 'السبت']);
        $englishDays=['saterday','sunday','monday','tuesday','wensday','thursday','friday'];

        $data = $request->validate([
            'time.*.day' => 'string',
            'time.*.from' => 'nullable|before:time.*.to',
            'time.*.to' => 'nullable|after:time.*.from',
            'time.*.closed' => 'required'
        ]);

        $times = $data['time'];
        // dd($times);
        $id = Auth::user()->id;
        $provider = Provider::find($id);
        ProviderWorkHour::where('provider_id',$id)->delete();
        foreach ($times as $key=>$time) {
            $provider->workHour()->create([
                'day' => strval($arabicDayes[$key]),
                'day_en'=>strval( $englishDays[$key]),
                'from' => $time['from'] ,
                'to' =>  $time['to'] ,
                'closed' =>  $time['closed']
            ]);
        }
        return redirect()->back()->with('message',trans('success.work_hour_updated'));
    }

    public function updatePasswordPage()
    {
        return view('website.provider.update.password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $id = Auth::user()->id;
        //   dd($id);
        $provider = Provider::find($id);
        if (Hash::check($data['old_password'], $provider->password)) {
            $provider->password = bcrypt($data['new_password']);
            $provider->save();
            return redirect()->back()->with('message', trans('success.password_updated'));
        } else {
            return redirect()->back()->with('error', trans('auth.password_not_correct'));
        }
    }

    public function updateServicesPage()
    {

        $services = SubServices::all();
        $provider = Provider::find(Auth::user()->id);
        // Auth::user()->subServices(1);
        $provider_services = $provider->subServices()->get();

        return view('website.provider.update.services', ['provider' => $provider, 'services' => $services, 'provider_services' => $provider_services]);
    }
    public function updateServices(Request $request)
    {
        //   dd($request);
        $data = $request->validate([
            'subservice' => 'required|exists:sub_services,id'
        ]);
        // dd($data['subservice']);
        $id = Auth::user()->id;
        $provider = Provider::find($id);
        $provider->subServices()->sync(SubServices::find($data['subservice']));
        return redirect()->back()->with('message', trans('success.service_update_success'));
    }
    public function updateBrandsPage()
    {

        $brandTypes = BrandType::all();
        $provider = Provider::find(Auth::user()->id);
        $provider_brands = $provider->brandTypes()->get();

        return view('website.provider.update.brands', ['provider' => $provider, 'brandTypes' => $brandTypes, 'provider_brands' => $provider_brands]);
    }
    public function updateBrands(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'brandType' => 'required|exists:brand_types,id'
        ]);
        $id = Auth::user()->id;
        $provider = Provider::find($id);
        $provider->brandTypes()->sync(BrandType::find($data['brandType']));
        return redirect()->back()->with('message', trans('success.brand_update_success'));
    }
    public function notifications(){
        $id=Auth::user()->id;
        $notifications=Notification::where('user_id',$id)->where('is_client',0)->get();
        return view('website.provider.notifications',['notifications'=>$notifications]);
    }

    public function updateAddress(){
        $cities=City::all();
        $id=Auth::user()->id;
        $address=providerAddress::where('provider_id',$id)->first();
        return view('website.provider.update.address',['cities'=>$cities,'address'=>$address]);
    }
    public function updatePostAddress(StoreProviderAddress $request,providerAddress $address_id){
        //  dd($request);
        $data=$request->validated();
        $address_id->fill($data);
        $address_id->save();
        return redirect()->back()->with('message','address is updated successfully');
    }
}
