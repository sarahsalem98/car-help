<?php

namespace App\Http\Controllers\Website\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientLogin;
use App\Http\Requests\ClientRegister;
use App\Models\City;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Client as userClint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:clientWeb');
    }


    public function verifyPage($client_id)
    {
        // dd($client_id);
        $client = userClint::find($client_id);
        return view('website.client.verify', ['client' => $client]);
    }
    public function verify(Request $request)
    {
    
        $data = $request->validate([
            'verify_code.*' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);
        // dd($data['phone_number']);
        $verification_code_array=$data['verify_code'];
        $verification_code=implode('',$verification_code_array);
        
//    dd( $data['phone_number'] );
// dd( implode('',$verification_code_array) );
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client('AC060466ed6ae6732d8dfe766b525cf879', 'fdf097faab779578b8cabd892ec0dac8');
        $verification = $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
            ->verificationChecks
            ->create($verification_code, array('to' =>$data['phone_number']));

        if ($verification->valid) {
            $client = userClint::where('phone_number', $data['phone_number'])->first();
            // dd($client);
            $client->status = 'verified';
            $client->save();
            Auth::guard('clientWeb')->login($client);
            return redirect()->route('main');
        }
        return response()->json(['errors' => 'Invalid verification code entered!'], 400);
    }

    public function registerPage()
    {
        $cities = City::all();
        return view('website.client.register', ['cities' => $cities]);
    }

    public function register(ClientRegister $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        // dd($validatedData);
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client ('AC060466ed6ae6732d8dfe766b525cf879','fdf097faab779578b8cabd892ec0dac8');

        $client = new userClint;
        $client->fill($validatedData);
        $client->password = bcrypt($request['password']);
        $client->api_token = Str::random(100);
        $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
        ->verifications
        ->create($validatedData['phone_number'], "sms");
           $client->save();
        return redirect()->route('client.verify', ['client_id' =>$client->id]);
    }
}
