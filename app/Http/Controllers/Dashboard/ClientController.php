<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\ClientUpdate;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Client.index', ['clients' => Client::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $cities=City::all();
        return view('Admin.Client.edit', ['client' => $client,'cities'=>$cities]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request, Client $client)
    {
         dd($request);
       $photoName=$client->profile_photo_path;
        if(! $request->phone_number==$client->phone_number){
          $data=$request->validate([
                'name'=>'max:255|alpha|required',
                'phone_number'=>'unique:clients|required',
                'city_id'=>'exists:cities,id|required',
                'profile_photo_path.*'=>'image|mimes:jpeg,png,jpg,gif,svg',
            ]);
        }else{
            $data= $request->validate([
                'name'=>'max:255|alpha|required',
                'phone_number'=>'required',
                'city_id'=>'exists:cities,id|required',
                'profile_photo_path.*'=>'image|mimes:jpeg,png,jpg,gif,svg',
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
        $client->save();
        return redirect()->back()->with('message','this client ias been updated successfully 😁');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
       
        $client->delete();
        return redirect()->back()->with('message','client has been deleted succefully👌');
    }
    public function clientsuspend(Request $request,$client){
        $AuthClient = Client::findOrFail($client);
        $AuthClient->suspended=$request->suspended;
        if($request->suspended==1){
            $message='تم ايقاف مقدم الخدمه 👍';
        }elseif($request->suspended==0){
            $message='تم تفعيل مقدم الخدمه 😃';
        }
        $AuthClient->save();
        return redirect()->back()->with('message', $message);
    }

    public function search(Request $request){
        //  dd($request);
            $word = $request->input('searchclient');
        //    dd($word);
            $clients = Client::where('name', 'LIKE', '%' . $word . '%')->get();
            return view('Admin.Client.search', ['clients' => $clients,'word'=>$word]);
        }
}
