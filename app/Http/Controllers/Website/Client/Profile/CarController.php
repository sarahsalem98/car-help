<?php

namespace App\Http\Controllers\Website\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCar;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::find(Auth::user()->id);
        $cars = $client->car()->get();
        return view('website.client.profile.car.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carModels = CarModel::all();
        return view('website.client.profile.car.create', ['carModels' => $carModels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCar $request)
    {

        $validatedData = $request->validated();
        $car = new Car();
        $car->fill($validatedData);
        $car->client_id = Auth::user()->id;
        $car->save();
        return redirect()->route('cars.index')->with('message', 'car is stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carModels = CarModel::all();
        $car = Car::find($id);
        return view('website.client.profile.car.edit', ['car' => $car, 'carModels' => $carModels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCar $request, $id)
    {
        $car = Car::find($id);

        $validatedData = $request->validated();
        $car->fill($validatedData);
        $car->save();
        return redirect()->back()->with('message','car updated succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
      
      
           $car->delete();
           return redirect()->back()->with('message','car is deleted successuffly');
           
    }
}
