<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCar;
use App\Models\Car;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['client cars'=>Car::where('client_id',Auth::user()->id)->get()],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCar $request)
    {
        try{
      $validatedData=$request->validated();
           $car=new Car;
           $car->fill($validatedData);
           $car->client_id=Auth::user()->id;
           if($car->save()){
               return response()->json(['message'=>'car has been added successfully ',
                                        'added car '=>$car   
           ],201);
           }  else{
               return response()->json(['errors'=>'car was not added'],500);
           }  
        }catch(Exception $e){return $e->getMessage();}
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
      
        return response()->json(['the required car '=>
        Car::where('id',$car->id)
        ->where('client_id',Auth::user()->id)
        ->get()],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCar $request, Car $car)
    {
        if($car){
            $validatedData=$request->validated();    
            $car->fill($validatedData);
            if($car->save()){
                return response()->json(['message'=>"car{$car->id} was updated successfuly "
                                    ,   'the updated car'=>$car],200);
            }else{
                return response()->json(['errors'=>"car {$car->id} was not updated"],400);
            }
        }else{
            return response()->json(['errors'=>"this car{$car->id} is not found"],204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
       if($car){
           if($car->delete()){
               return response()->json(['message'=>"car {$car->id} was delete succesfully"],200);
           }else{
               return response()->json(['errors'=>"car {$car->id} was not deleted"],400);
           }
       }else{
              return response()->json(['errors'=>"this car{$car->id} is not found"],204);
       }

    }
}
