<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BrandType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
           'name_en'=>'required|string|max:255',
           'picture'=>'required',
           'picture.*'=>'image|mimes:jpeg,png,jpg,gif,svg'
       ]);
       if ($request->hasfile('picture')) {
        $name = $request->file('picture')->store('brand_pictures');
       }
       $brand=new BrandType;
       $brand->fill($data);
       $brand->picture=$name;
       $brand->save();
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
        $name=$brandType->picture;
        $data=$request->validate([
            'name'=>'string|max:255',
            'name_en'=>'string|max:255',
            'picture.*'=>'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($request->hasfile('picture')) {
            if (Storage::exists($brandType->picture)) {
                Storage::delete($brandType->picture);
            }
            $name = $request->file('picture')->store('brand_pictures');
        }
        $brandType->fill($data);
        $brandType->picture=$name;
        $brandType->save();
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
    public function searchBrand(Request $request){
        $word = $request->input('searchBrand');
          
        //    dd($word);
            $clients = BrandType::where('name', 'LIKE', '%' . $word . '%')
            ->orWhere('name_en', 'LIKE', '%' . $word . '%')->get();
            return view('Admin.Brand.search', ['brandTypes' => $clients,'word'=>$word]);
    }
}
