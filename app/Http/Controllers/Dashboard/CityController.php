<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.City.index',['cities'=>City::paginate(5)]);
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
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'name_en'=>'required|string|max:255'
        ]);
        $city=new City;
        $city->create($data);
        return redirect()->back()->with('message','this  city is added successfully 😀');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'name_en'=>'required|string|max:255'
        ]);
       
        $city->update($data);
        return redirect()->back()->with('message','this  city is updated successfully 😀');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
       $city->delete();
       return redirect()->back()->with('message','city is deleted successfully 😊');
    }
    public function searchCity (Request $request){
        $word = $request->input('searchCity');
          
        //    dd($word);
            $clients = City::where('name', 'LIKE', '%' . $word . '%')
            ->orWhere('name_en', 'LIKE', '%' . $word . '%')->get();
            return view('Admin.City.search', ['cities' => $clients,'word'=>$word]);
    }
}
