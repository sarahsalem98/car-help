<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderLogin;
use App\Http\Requests\ProviderRegister;
use App\Http\Requests\ProviderUpdate;
use App\Http\Requests\StoreProviderAddress;
use App\Http\Requests\StoreWorkHoursForProvider;
use App\Models\BrandType;
use App\Models\City;
use App\Models\Provider;
use App\Models\providerAddress;
use App\Models\ProviderWorkHour;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Twilio\Rest\Client;



class AuthController extends Controller
{
  public  $next_step = ['service_type', 'brand_type', 'address', 'work_houres', 'finished'];
 


  public function register(ProviderRegister $request)
  {
    $validatedData = $request->validated();
    $provider = new Provider;
    $provider->fill($validatedData);
    $provider->password = bcrypt($request['password']);
    $provider->api_token = Str::random(100);
    $provider->next_step = $this->next_step[0];
    if ($request->file('workshop_photo_path')) {
      $photoName = $request->file('workshop_photo_path')->store('workshoph_Photos');
      $provider->workshop_photo_path = $photoName;
    }
    if ($request->file('business_registeration_file')) {
      $fileName = $request->file('business_registeration_file')->store('businessrRegisteration_Files');
      $provider->business_registeration_file = $fileName;
    }
    if ($provider->save()) {
      return response()->json([
        'message' => 'new provider was added succesully',
        'next_step' => $provider->next_step,
        'provider' => $provider
      ], 201);
    }
  }

  public function registerServiceTypeForProvider(Request $request)
  {
    $data=$request->validate([
   'subservice'=>'required|exists:sub_services,id'
    ]);
    $id = Auth::user()->id;
    $provider = Provider::find($id);
    
    if ($data['subservice']) {
      $provider->subServices()->sync(SubServices::find($data['subservice']));
      $provider->next_step = $this->next_step[1];
      $provider->save();
      return response()->json([
        'message' => 'services have been added successfully',
        'next_step' => $provider->next_step
      ], 201);
    } else {
      return response()->json(['errors' => 'subserice field does not have value'], 400);
    }
  }
  public function registerBrandTypesForProvider(Request $request)
  {
    $data = $request->validate([
      'brandType' => 'required|exists:brand_types,id'
  ]);
    $id = Auth::user()->id;
    $provider = Provider::find($id);
    if ($data['brandType']) {
      $provider->brandTypes()->sync(BrandType::find($data['brandType']));
      $provider->next_step = $this->next_step[2];
      $provider->save();
      return response()->json([
        'message' => 'brand types have been added successfully',
        'next_step' => $provider->next_step
      ], 201);
    } else {
      return response()->json(['errors' => 'brandType field does not have value'], 400);
    }
  }
  public function registerAddressforProvider(StoreProviderAddress $request)
  {

    $id = Auth::user()->id;
    $provider = Provider::find($id);
    if ($provider) {
      $validatedData = $request->validated();
      $providerAddress = new providerAddress;
      $providerAddress->fill($validatedData);
      $providerAddress->provider_id = $id;
      $providerAddress->save();
      $provider->next_step = $this->next_step[3];
      $provider->save();
      return response()->json([
        'message' => 'address has been added successfully',
        'next_step' => $provider->next_step
      ], 201);
    } else {
      return response()->json(['errors' => 'provider is not found'], 400);
    }
  }

  public function registerWorkHoursForProvider(Request $request)
  {
    $times = $request['time'];
    $id = Auth::user()->id;
    $provider = Provider::find($id);
    $token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_sid = getenv("TWILIO_SID");
    $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    $twilio = new Client('AC060466ed6ae6732d8dfe766b525cf879', '8c5400ed57ece1ab37fc17281d917562');

    foreach ($times as $time) {
      $data = json_decode($time);
      $workHourProvider = new ProviderWorkHour;
      $workHourProvider->day = $data->day;
      $workHourProvider->from = $data->from ?? null;
      $workHourProvider->to = $data->to ?? null;
      $workHourProvider->closed = $data->closed;
      $workHourProvider->provider_id = $id;
      $workHourProvider->save();
    }
    $provider->next_step = $this->next_step[4];
    $provider->save();
    //twillio
     $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
      ->verifications
      ->create($provider->phone_number, "sms");

    return response()->json([
      'message' => 'work hours are added successfully',
      'next_step' => $provider->next_step,
    ], 201);
  }




  public function verify(Request $request)
  {
    $data = $request->validate([
      'verification_code' => ['required', 'numeric'],
      'phone_number' => ['required', 'string'],
    ]);


    /* Get credentials from .env */
    if (Auth::user()->phone_number == $data['phone_number']) {
      $token = getenv("TWILIO_AUTH_TOKEN");
      $twilio_sid = getenv("TWILIO_SID");
      $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
      $twilio = new Client('AC060466ed6ae6732d8dfe766b525cf879', '8c5400ed57ece1ab37fc17281d917562');
      $verification = $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
        ->verificationChecks
        ->create($data['verification_code'], array('to' => $data['phone_number']));


        if ($verification->valid) {
          $id=Auth::user()->id;
        $provider = Provider::find($id);
        $provider->status='verified';
        $provider->save();
        return response()->json([
          'message' => 'Phone number verified',
          'provider' => $provider
        ], 200);
      }
      return response()->json(['errors' => 'Invalid verification code entered!'], 400);
    } else {
      return response()->json(['errors' => 'the number you entered is not correct'], 400);
    }
  }


  public function login(ProviderLogin $request)
  {
    $validatedData = $request->validated();
    $provider = Provider::where('phone_number', $validatedData['phone_number'])->first();
    if ($provider) {
      if (Hash::check($validatedData['password'], $provider->password)) {
        return response()->json(['provider' => $provider], 200);
      } else {
        return response()->json(['errors' => 'password mismach'], 401);
      }
    } else {
      return response()->json(['errors' => 'client does not exist'], 204);
    }
  }


  public function forgetPassword(Request $request)
  {
    $data = $request->validate([
      'phone_number' => ['required', 'string'],
    ]);
    $token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_sid = getenv("TWILIO_SID");
    $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    // $twilio = new Client($twilio_sid, $token);
    $twilio = new Client('AC060466ed6ae6732d8dfe766b525cf879', '8c5400ed57ece1ab37fc17281d917562');
    if (Auth::user()->phone_number == $data['phone_number']) {
      $provider = Provider::where('phone_number', $data['phone_number'])->first();
      $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
        ->verifications
        ->create($data['phone_number'], "sms");
      $provider->update(['status' => 'forget_password']);
      return response()->json(['provider' => $provider], 200);
    } else {
      return response()->json(['errors' => 'the number you entered is not correct'], 400);
    }
  }

  public function changePassword(Request $request)
  {
    $id = Auth::user()->id;
    $provider = Provider::find($id);
    if ($provider->status = 'verified') {
      $data = $request->validate([
        'new_password' => 'required|confirmed',
      ]);
      $provider->password = bcrypt($data['new_password']);

      $provider->save();
      return response()->json([
        'message' => 'success',
        'provider' => $provider
      ], 200);
    } else {
      return response()->json(['message' => 'can not change password for this client '], 400);
    }
  }




  public function resetPassword(Request $request)
  {
    $data = $request->validate([
      'old_password' => 'required',
      'new_password' => 'required|confirmed',
    ]);


    $id = Auth::user()->id;
    $provider = Provider::find($id);
    if (Hash::check($data['old_password'], $provider->password)) {
      $provider->password = bcrypt($data['new_password']);
      $provider->save();
      return response()->json(['message' => 'the new password is set as your current password'], 201);
    } else {
      return response()->json(['errors' => 'the old password you entered is not correct '], 422);
    }
  }




  public function updateProvider(ProviderUpdate $request)
  {
    $validatedData = $request->validated();
    $id = Auth::user()->id;
    $name = Auth::user()->enginner_name;
    $provider = Provider::find($id);
    $fileName= $provider->workshop_photo_path;
    $photoName= $provider->business_registeration_file;
   
    if ($request->file('workshop_photo_path')) {
      if(Storage::exists($provider->workshop_photo_path )){
        Storage::delete($provider->workshop_photo_path );
      } 
      $photoName = $request->file('workshop_photo_path')->store('workshoph_Photos');

    }
    if ($request->file('business_registeration_file')) {
      if(Storage::exists($provider->business_registeration_file )){
        Storage::delete($provider->business_registeration_file );
      } 
      $fileName = $request->file('business_registeration_file')->store('businessrRegisteration_Files');
    
    }
   
    $provider->fill($validatedData);
    $provider->workshop_photo_path = $photoName;
    $provider->business_registeration_file = $fileName;
    $provider->save();
    return response()->json(['provider'=>$provider],200);
  }



  public function changeProviderSubServices(Request $request){
    
    $data=$request->validate([
      'subservice'=>'required|exists:sub_services,id'
       ]);
       $id = Auth::user()->id;
       $name = Auth::user()->enginner_name;
          $name = Auth::user()->enginner_name;  $provider = Provider::find($id);
      $provider->subServices()->sync(SubServices::find($data['subservice']));
       return response()->json(["provider"=>Provider::where('id',$id)->with('subServices')->get()],200);
      

  }

  public function changeProviderWorkHours(Request $request){
    $times = $request['times'];
    $id = Auth::user()->id;
    $name = Auth::user()->enginner_name;
   ProviderWorkHour::where('provider_id',$id)->delete();
  
    foreach ($times as $time) {
      $data = json_decode($time);
      $workHourProvider=new ProviderWorkHour;
      $workHourProvider->day = $data->day;
      $workHourProvider->from = $data->from ?? null;
      $workHourProvider->to = $data->to ?? null;
      $workHourProvider->closed = $data->closed;
      $workHourProvider->provider_id = $id;
      $workHourProvider->save();
    }
    return response()->json(["provider"=>Provider::where('id',$id)->with('workHour')->get()],200);
  }

  public function changeProviderbrandTypes(Request $request){
    $data=$request->validate([
      'brandType'=>'required|exists:brand_types,id'
    ]);
    $id = Auth::user()->id;
    $provider = Provider::find($id);
    $name = Auth::user()->enginner_name;
    $provider->brandTypes()->sync(BrandType::find($data['brandType']));
    return response()->json(["provider"=>Provider::where('id',$id)->with('brandTypes')->get()],200);
  
  }

  public function changeProviderAddress(Request $request){
   $request->validate([
    'city_id'=>'exists:cities,id',
    'lat'=>'numeric|required_with:city_id',
    'long'=>'numeric|required_with:city_id',
    'address'=>'max:255'
   ]);
   $id = Auth::user()->id;
   $providerAddress = providerAddress::where('provider_id',$id)->first();
   $name = Auth::user()->enginner_name;
   $providerAddress->update($request->all());
   return response()->json(["provider"=>Provider::where('id',$id)->with('address.city')->get()],200);


  }
}
