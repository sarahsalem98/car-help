<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Main.index', ['services' => Service::all()]);
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

        // dd($request->file('service_photo_path'));
        $photoName = '';
        $data = $request->validate([
            'name' => 'required|max:255|string',
            'name_en' => 'required|max:255|string',
            'service_photo_path' => 'required',
            'service_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->file('service_photo_path')) {
            $photoName = $request->file('service_photo_path')->store('service_photos');
        }
        $service = new Service;
        $service->fill($data);
        $service->service_photo_path = $photoName;
        $service->save();
        return redirect()->back()->with('message', 'service has been addedd successfully😃');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('Admin.Main.edit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $photoName = $service->service_photo_path;
        $data = $request->validate([
            'name' => 'max:255|string',
            'name_en' => 'max:255|string',
            'service_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->file('service_photo_path')) {
            if (Storage::exists($service->service_photo_path)) {
                Storage::delete($service->service_photo_path);
            }
            $photoName = $request->file('service_photo_path')->store('service_photos');
           
        }
        $service->fill($data);
        $service->service_photo_path = $photoName;
        $service->save();
        return redirect()->back()->with('message', 'service  has been updated succesfully 😃');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->back()->with('message', 'this service has been deleted successfully🙂');
    }
    public function search(Request $request)
    {
        //  dd($request);
        $word = $request->input('searchservice');
        // dd($word);
        $services = Service::where('name', 'LIKE', '%' . $word . '%')->get();
        return view('Admin.Main.search', ['services' => $services, 'word' => $word]);
    }
}
