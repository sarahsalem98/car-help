<?php

namespace App\Http\Controllers\Website\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientAddress;
use App\Models\Client;
use App\Models\ClientsAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addressIndex(){
        $id=Auth::user()->id;
     $addresses=ClientsAddress::where('client_id',$id)->get();
        return view('website.client.profile.address.index',['addresses'=>$addresses]);
    }
    public function edit($address_id){
        $address=ClientsAddress::find($address_id);
        return view('website.client.profile.address.edit',['address'=>$address]);
    }
    public function update(StoreClientAddress $request ,$address_id){
         $address=ClientsAddress::find($address_id);
         $data=$request->validated();
         $address->fill($data);
         $address->save();
         return redirect()->back()->with('message','address is updated');
    }
    public function showAdd(){
      return view('website.client.profile.address.add');
    }
    public function add(StoreClientAddress $request){
        $data=$request->validated();
        $address=new ClientsAddress;
        $address->fill($data);
        $address->client_id=Auth::user()->id;
        $address->save();
        return redirect()->route('client.address')->with('message','address added successfully');

    }
    public function delete(ClientsAddress $address_id){
      $address_id->delete();
      return redirect()->route('client.address')->with('message','address deleted successfully');

    }
    
}
