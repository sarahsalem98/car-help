<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientAddress;
use App\Models\ClientsAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return response()->json(['all client addresss'=>ClientsAddress::where('client_id',Auth::user()->id)->get()],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientAddress $request)
    {
       $validatedData=$request->validated();
       $clientsAddress=new ClientsAddress;
       $clientsAddress->fill($validatedData);
       $clientsAddress->client_id=Auth::user()->id;
       if($clientsAddress->save()){
           return response()->json(['message'=>'address was stored successfully',
                                     'address'=>$clientsAddress ],201);
       }else{
           return response()->json(['errors'=>'address was not added'],500);
       }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientsAddress  $clientsAddress
     * @return \Illuminate\Http\Response
     */
    public function show(ClientsAddress $address)
    {
        return response()->json(['the required address '=>
        ClientsAddress::where('id',$address->id)
        ->where('client_id',Auth::user()->id)
        ->get()],200);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientsAddress  $clientsAddress
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClientAddress $request, ClientsAddress $address)
    {
        if($address){
            $validatedData=$request->validated();    
            $address->fill($validatedData);
            if($address->save()){
                return response()->json(['message'=>"address{$address->id} was updated successfuly "
                                    ,   'the updated address'=>$address],200);
            }else{
                return response()->json(['errors'=>"address {$address->id} was not updated"],400);
            }
        }else{
            return response()->json(['errors'=>"this address{$address->id} is not found"],204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientsAddress  $clientsAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientsAddress $address)
    {
        if($address){
            if($address->delete()){
                return response()->json(['message'=>"address {$address->id} was delete succesfully"],200);
            }else{
                return response()->json(['errors'=>"address {$address->id} was not deleted"],400);
            }
        }else{
               return response()->json(['errors'=>"this address{$address->id} is not found"],204);
        }
    }
}
