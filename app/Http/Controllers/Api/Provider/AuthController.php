<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderRegister;
use App\Http\Requests\StoreProviderAddress;
use App\Http\Requests\StoreWorkHoursForProvider;
use App\Models\BrandType;
use App\Models\Provider;
use App\Models\providerAddress;
use App\Models\ProviderWorkHour;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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
        'registeration next step' => $provider->next_step,
        "the created provider " => $provider
      ], 201);
    }
  }

  public function registerServiceTypeForProvider(Request $request)
  {
    $id = Auth::user()->id;
    $provider = Provider::find($id);
    if ($request['subserice']) {
      $provider->subServices()->sync(SubServices::find($request['subserice']));
      $provider->next_step = $this->next_step[1];
      $provider->save();
      return response()->json([
        'message' => 'services have been added successfully',
        'registeration next step' => $provider->next_step
      ], 201);
    } else {
      return response()->json(['errors' => 'subserice field does not have value'], 400);
    }
  }
  public function registerBrandTypesForProvider(Request $request)
  {
    $id = Auth::user()->id;
    $provider = Provider::find($id);
    if ($request['brandType']) {
      $provider->brandTypes()->sync(BrandType::find($request['brandType']));
      $provider->next_step = $this->next_step[2];
      $provider->save();
      return response()->json([
        'message' => 'brand types have been added successfully',
        'registeration next step' => $provider->next_step
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
        "address {{$providerAddress->id}}" => $providerAddress,
        'registeration next step' => $provider->next_step
      ], 201);
    } else {
      return response()->json(['errors' => 'provider is not found'], 400);
    }
  }
  public function registerWorkHoursForProvider(Request $request)
  {
    $times = $request['time'];


    foreach ($times as $time) {
      $data = json_decode($time);
      $workHourProvider = new ProviderWorkHour;
      $workHourProvider->day = $data->day;
      $workHourProvider->from = $data->from ?? null;
      $workHourProvider->to = $data->to ?? null;
      $workHourProvider->closed = $data->closed;
      $workHourProvider->provider_id = Auth::user()->id;
      $workHourProvider->save();
    }
      $id=Auth::user()->id;
      $provider=Provider::find($id);
      $provider->next_step=$this->next_step[4];
      $provider->save();

    return response()->json(['registeration next step'=>$provider->next_step,
    'verification_code'=>0000  , 
    'all work houres added for this provider ' =>
    ProviderWorkHour::where('provider_id', Auth::user()->id)->get()],201);

  }
  public function resendVerificationCode(){
    return response()->json(['verification_code'=>0000],200);
  }

}
