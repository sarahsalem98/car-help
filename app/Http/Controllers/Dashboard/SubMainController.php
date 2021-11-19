<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.SubMain.index',['subervices'=>SubServices::all(),'services'=>Service::all()]);
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
        $photoName = '';
        $data = $request->validate([
            'name' => 'required|max:255|string',
            'name_en' => 'required|max:255|string',
            'service_id'=>'exists:services,id|required',
            'sub_service_photo_path' => 'required',
            'sub_service_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->file('sub_service_photo_path')) {
            $photoName = $request->file('sub_service_photo_path')->store('subservice_photos');
        }
        $subservice = new SubServices;
        $subservice->fill($data);
        $subservice->sub_service_photo_path = $photoName;
        $subservice->save();
        return redirect()->back()->with('message', 'subservice has been addedd successfully😃');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function show(SubServices $subservice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function edit(SubServices $subservice)
    {
       
        return view('Admin.SubMain.edit',['subservice'=>$subservice,'services'=>Service::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubServices $subservice)
    {
        // dd($request);
        

        $photoName = $subservice->sub_service_photo_path;
        $data = $request->validate([
            'name' => 'max:255|string',
            'name_en' => 'max:255|string',
            'service_id'=>'exists:services,id',
            'sub_service_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->file('sub_service_photo_path')) {
            if (Storage::exists($subservice->sub_service_photo_path)) {
                Storage::delete($subservice->sub_service_photo_path);
            }
            $photoName = $request->file('sub_service_photo_path')->store('subservice_photos');
           
        }
        $subservice->fill($data);
        $subservice->sub_service_photo_path = $photoName;
        $subservice->save();
        return redirect()->back()->with('message', 'subservice  has been updated succesfully 😃');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubServices $subservice)
    {
       $subservice->delete();
       return redirect()->back()->with('message','you have deleted this subservice successfully🙂');
    }
}
