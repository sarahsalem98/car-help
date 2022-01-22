<?php

namespace App\Http\Controllers\Website\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProviderAddress;
use App\Models\BrandType;
use App\Models\City;
use App\Models\Provider;
use App\Models\providerAddress;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class RegisterCompleteController extends Controller
{
    public  $next_step = ['service_type', 'brand_type', 'address', 'work_houres', 'finished'];

    public function verifyPage($provider_id)
    {
        // dd($client_id);
        $provider = Provider::find($provider_id);
        return view('website.provider.verify', ['provider' => $provider]);
    }

    public function verify(Request $request)
    {

        $data = $request->validate([
            'verify_code.*' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);
        // dd($data['phone_number']);
        $verification_code_array = $data['verify_code'];
        $verification_code = implode('', $verification_code_array);

        //    dd( $data['phone_number'] );
        // dd( implode('',$verification_code_array) );
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client('AC060466ed6ae6732d8dfe766b525cf879', 'fdf097faab779578b8cabd892ec0dac8');
        $verification = $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
            ->verificationChecks
            ->create($verification_code, array('to' => $data['phone_number']));

        if ($verification->valid) {
            $provider = Provider::where('phone_number', $data['phone_number'])->first();
            // dd($client);
            $provider->status= 'verified';
            $provider->save();
            Auth::guard('providerWeb')->login($provider);
            return redirect()->route('main');
        }
        return response()->json(['errors' => 'Invalid verification code entered!'], 400);
    }







    public function registerServiceTypesPage($provider_id)
    {

        $services = SubServices::all();
        return view('website.providerRegister.serviceType', ['services' => $services, 'provider_id' => $provider_id]);
    }



    public function registerServiceTypeForProvider(Request $request)
    {
        $data = $request->validate([
            'subservice' => 'required|exists:sub_services,id'
        ]);
        // dd($data['subservice']);
        $id = $request->provider_id;

        $provider = Provider::find($id);
        if ($data['subservice']) {
            $provider->subServices()->sync(SubServices::find($data['subservice']));
            $provider->next_step = $this->next_step[1];
            // $provider->save();
            return redirect()->route('provider.register.brand.type', ['provider_id' => $id]);
        } else {
            return response()->json(['errors' => 'subservice field does not have value'], 400);
        }
    }



    public function registerBrandTypesPage($provider_id)
    {
        $brandTypes = BrandType::all();
        return view('website.providerRegister.brandType', ['brandTypes' => $brandTypes, 'provider_id' => $provider_id]);
    }


    public function registerBrandTypes(Request $request)
    {

        $data = $request->validate([
            'brandType' => 'required|exists:brand_types,id'
        ]);
        $id = $request->provider_id;
        $cities = City::all();
        $provider = Provider::find($id);
        if ($data['brandType']) {
            $provider->brandTypes()->sync(BrandType::find($data['brandType']));
            $provider->next_step = $this->next_step[2];
            //   $provider->save();
            return redirect()->route('provider.register.address', ['provider_id' => $id, 'cities' => $cities]);
        } else {
            return response()->json(['errors' => 'brandType field does not have value'], 400);
        }
    }


    public function registerAddressPage($provider_id)
    {
        $cities = City::all();
        return view('website.providerRegister.address', ['cities' => $cities, 'provider_id' => $provider_id]);
    }
    public function registerAddress(Request $request)
    {
        $data = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'max:255|required',
            // 'provider_id'=>'exists:providers,id'
        ]);
        $id = $request->provider_id;
        $provider = Provider::find($id);
        $providerAddress = new providerAddress;
        $providerAddress->fill($data);
        $providerAddress->provider_id = $id;
        $providerAddress->save();
        $provider->next_step = $this->next_step[3];
        $provider->save();
        return redirect()->route('provider.register.work_hours', ['provider_id' => $provider->id]);
    }


    public function registerWorkHoursPage($provider_id)
    {
        return view('website.providerRegister.workHours', ['provider_id' => $provider_id]);
    }

    public function registerWorkHours(Request $request)
    {

        $arabicDayes = array_reverse(['الجمعة', 'الخميس', 'الاربعاء', 'الثلاثاء', 'الاثتنين', 'الاحد', 'السبت']);
        $englishDays = ['saterday', 'sunday', 'monday', 'tuesday', 'wensday', 'thursday', 'friday'];

        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        
        $data = $request->validate([
            'time.*.day' => 'string',
            'time.*.from' => 'nullable|before:time.*.to',
            'time.*.to' => 'nullable|after:time.*.from',
            'time.*.closed' => 'required'
        ]);
        
        $times = $request['time'];
        $cities = City::all();
        $id = $request->provider_id;
        $provider = Provider::find($id);
        foreach ($times as $key => $time) {
            $provider->workHour()->create([
                'day' => $arabicDayes[$key],
                'day_en' => $englishDays[$key],
                'from' => $time['from'] ?? null,
                'to' =>  $time['to'] ?? null,
                'closed' =>  $time['closed']
            ]);
        }
        $provider->next_step = $this->next_step[4];
        $provider->save();
        $twilio = new Client ('AC060466ed6ae6732d8dfe766b525cf879','fdf097faab779578b8cabd892ec0dac8');
        $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
        ->verifications
        ->create($provider->phone_number, "sms");
        return redirect()->route('provider.verify', ['provider_id' => $provider->id]);
    }


}
