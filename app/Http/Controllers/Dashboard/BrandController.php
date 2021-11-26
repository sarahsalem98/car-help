<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BrandType;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('Admin.Brand.index',['brandTypes'=>BrandType::paginate(5)]);
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
       $brand=new BrandType;
       $brand->create($data);
       return redirect()->back()->with('message','the new brand type has been added successfully😃');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandType  $brandType
     * @return \Illuminate\Http\Response
     */
    public function show(BrandType $brandType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandType  $brandType
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandType $brandType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrandType  $brandType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrandType $brandType)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'name_en'=>'required|string|max:255'
        ]);
        $brandType->update($data);
        return redirect()->back()->with('message','this brand has been updated successfully😆');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandType  $brandType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandType $brandType)
    {
        $brandType->delete();
        return redirect()->back()->with('message','this brand type is deleted succefully 😀');
    }
}
