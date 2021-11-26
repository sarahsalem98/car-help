<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\More;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //  dd(More::all('banners_pics','id'));
    $banners=More::whereNotNull('banners_pics')->paginate(5,['banners_pics','id']);
    if(!$banners->isEmpty()){
        return view('Admin.Banner.index',['banners'=>$banners]);
    }else{

        return view('Admin.Banner.index',['banners'=>More::paginate(5,['banners_pics','id'])]);
    }

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
        // dd($request->banners_pics);
        $data=$request->validate([
            'banners_pics'=>'required',
            'banners_pics.*'=>'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($request->hasfile('banners_pics')) {

            foreach ($request->file('banners_pics') as $image) {
                $name = $image->store('banners_pics');
                // $data[] = $name;
                $more_not_null=More::whereNull('banners_pics')->get();
                if(!$more_not_null->isEmpty()){
                    $more_not_null[0]->banners_pics=$name;
                    $more_not_null[0]->save();
                }else{
                    $more=new More;
                    $more->banners_pics=$name;
                    $more->save();
                }
              
            }
            return redirect()->back()->with('message','banner is added succefully😃');
        }
        // return redirect()->back()->with('error','banner picture is empty');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->validate([
            'banners_pics'=>'required',
            'banners_pics.*'=>'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $more=More::find($id);
        if ($request->hasfile('banners_pics')) {
        Storage::delete($more->banners_pics);
        $name = $request->file('banners_pics')->store('banners_pics');
        $more->banners_pics=$name;
        $more->save();
        return redirect()->back()->with('message','this banner has been updated successfully😃');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $more=More::find($id);
      $more->banners_pics=null;
      $more->save();
      return redirect()->back()->with('message','this banner has been deleted successfully 😃');
    }
}
