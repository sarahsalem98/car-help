<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientLogin;
use App\Http\Requests\ClientRegister;
use App\Http\Requests\ClientUpdate;
use App\Models\Client as userClint;
// use Facade\FlareClient\Http\Client;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AuthController extends Controller
{

    // protected function create(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'phone_number' => ['required', 'numeric', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    //     /* Get credentials from .env */
    //     $token = getenv("TWILIO_AUTH_TOKEN");
    //     $twilio_sid = getenv("TWILIO_SID");
    //     $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    //     $twilio = new Client ($twilio_sid, $token);


    //     $twilio->verify->v2->services($twilio_verify_sid)
    //         ->verifications
    //         ->create($data['phone_number'], "sms");
    //         userClint::create([
    //         'name' => $data['name'],
    //         'phone_number' => $data['phone_number'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    //     return redirect()->route('verify')->with(['phone_number' => $data['phone_number']]);
    // }



    public function register(ClientRegister $request)
    {
        $validatedData = $request->validated();
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client('AC060466ed6ae6732d8dfe766b525cf879', '8c5400ed57ece1ab37fc17281d917562');
        $client = new userClint;
        $client->fill($validatedData);
        $client->password = bcrypt($request['password']);
        $client->api_token = Str::random(100);
        $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
            ->verifications
            ->create($validatedData['phone_number'], "sms");
        if ($client->save()) {
            return response()->json([
                'message' => 'client was created succefully and verificaton code has been sent',
                'client' => $client
            ], 201);
        } else {
            return response()->json(['errors' => 'client was not created'], 400);
        }
    }


    public function verify(Request $request)
    {

        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);

        /* Get credentials from .env */
        if (Auth::user()->phone_number == $request->phone_number) {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client('AC060466ed6ae6732d8dfe766b525cf879', '8c5400ed57ece1ab37fc17281d917562');
            $verification = $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
                ->verificationChecks
                ->create($data['verification_code'], array('to' => $data['phone_number']));


            if ($verification->valid) {
                $client = userClint::where('phone_number', $data['phone_number'])->first();
                if ($client->status == 'forget_password') {
                    $client->update(['status' => 'change_password']);
                } else {

                    $client->update(['status' => 'verified']);
                }
                return response()->json([
                    'message' => 'Phone number verified',
                    'client' => $client
                ], 200);
            }
            return response()->json(['errors' => 'Invalid verification code entered!'], 400);
        } else {
            return response()->json(['errors' => 'the number you entered is not correct'], 400);
        }
    }


    public function login(ClientLogin $request)
    {
        $validatedData = $request->validated();
        $client = userClint::where('phone_number', $validatedData['phone_number'])->first();
        if ($client) {
            if (Hash::check($validatedData['password'], $client->password)) {
                return response()->json(['client' => $client], 200);
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
        $client = userClint::where('phone_number', $data['phone_number'])->first();
        if($client){
        $twilio = new Client('AC060466ed6ae6732d8dfe766b525cf879', '441e80692fe25d6c8473068ca9604bb5');


        $twilio->verify->v2->services('VA8b9553f392c59fd6e9c99eb728304651')
            ->verifications
            ->create($data['phone_number'], "sms");
        $client->update(['status' => 'forget_password']);
        return response()->json(['client' => $client], 200);
        }else{
            return response()->json(['error'=>'phone number not found'],404);
        }
    }

    public function resetPassword(Request $request)
    {
        $id = Auth::user()->id;
        $client = userClint::find($id);
        if ($client->status == 'change_password') {
            $data = $request->validate([
                'new_password' => 'required|confirmed',
            ]);
            $client->password = bcrypt($data['new_password']);
            $client->status = 'verified';
            $client->save();
            return response()->json([
                'message' => 'success',
                'client' => $client
            ], 200);
        } else {
            return response()->json(['message' => 'can not change password for this client '], 400);
        }
    }




    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        $id = Auth::user()->id;
        $client = userClint::find($id);
        if (Hash::check($data['old_password'], $client->password)) {
            $client->password = bcrypt($data['new_password']);
            $client->save();
            return response()->json(['message' => 'the new password is set as your current password'], 201);
        } else {
            return response()->json(['errors' => 'the old password you entered is not correct '], 422);
        }
    }





    public function updateProfile(Request $request)
    {
        if ($request->phone_number != Auth::user()->phone_number) {
            $validatedData = $request->validate([
                'name' => 'max:255|alpha',
                'phone_number' => 'unique:clients',
                'city_id' => 'exists:cities,id',
                'profile_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);
        }else{
            $validatedData = $request->validate([
                'name' => 'max:255|alpha',
                'city_id' => 'exists:cities,id',
                'profile_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);
        }

        $id = Auth::user()->id;
        $client = userClint::find($id);
        $photoName = $client->profile_photo_path;
        if ($request->file('profile_photo_path')) {
            if (Storage::exists($client->profile_photo_path)) {
                Storage::delete($client->profile_photo_path);
            }
            $photoName = $request->file('profile_photo_path')->store('profile_picture_client');
        }
        $client->fill($validatedData);
        $client->profile_photo_path = $photoName;
        $client->save();
        return response()->json([
            'message' => 'clinet information was updated',
            'client' => $client
        ], 201);
    }
}
