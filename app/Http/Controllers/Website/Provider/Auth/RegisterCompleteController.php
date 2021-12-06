<?php

namespace App\Http\Controllers\Website\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Models\BrandType;
use App\Models\City;
use App\Models\Provider;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterCompleteController extends Controller
{
    public  $next_step = ['service_type', 'brand_type', 'address', 'work_houres', 'finished'];

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
            return response()->json(['errors' => 'subserice field does not have value'], 400);
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

        $provider = Provider::find($id);
        if ($data['brandType']) {
            $provider->brandTypes()->sync(BrandType::find($data['brandType']));
            $provider->next_step = $this->next_step[2];
            //   $provider->save();
            return redirect()->route('provider.register.work_hours',['provider_id'=>$id]);
        } else {
            return response()->json(['errors' => 'brandType field does not have value'], 400);
        }
    }


    public function registerWorkHoursPage($provider_id){
        return view('website.providerRegister.workHours',['provider_id'=>$provider_id]);
    }

    public function registerWorkHours(Request $request){

          $times = $request['time'];
          $id=$request->provider_id;
          $provider=Provider::find($id);
          dd($request);
        foreach($times['day'] as $k => $v) {

            $provider->workHour()->create([
                'day' => $times['day'][$k],
                'from' => $times['from'][$k] ??null ,
                'to' =>  $times['to'][$k] ??null,
                'closed' =>  $times['closed'][$k]??0
             ]);
        }
        return 'gg';
    // $id = Auth::user()->id;
    // $provider = Provider::find($id);
    // $token = getenv("TWILIO_AUTH_TOKEN");
    // $twilio_sid = getenv("TWILIO_SID");
    // $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    // $twilio = new Client($twilio_sid, $token);


    // foreach ($times as $time) {
    //   $data = json_decode($time);
    //   $workHourProvider = new ProviderWorkHour;
    //   $workHourProvider->day = $data->day;
    //   $workHourProvider->from = $data->from ?? null;
    //   $workHourProvider->to = $data->to ?? null;
    //   $workHourProvider->closed = $data->closed;
    //   $workHourProvider->provider_id = $id;
    //   $workHourProvider->save();
    // }
  
    // $provider->next_step = $this->next_step[4];
    // $provider->save();

    // //twillio

    // $otp = $twilio->verify->v2->services($twilio_verify_sid)
    //   ->verifications
    //   ->create($provider->phone_number, "sms");

    // return response()->json([
    //   'registeration next step' => $provider->next_step,
    //   'all work houres added for this provider ' =>
    //   ProviderWorkHour::where('provider_id', $id)->get()
    // ], 201);
    }





    public function registerAddressPage($provider_id)
    {
        $cities = City::all();
        return view('website.providerRegister.address', ['cities' => $cities, 'provider_id' => $provider_id]);
    }
    public function registerAddress()
    {
    }
}
