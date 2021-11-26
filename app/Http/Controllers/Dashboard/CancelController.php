<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CancellationReasons;
use Illuminate\Http\Request;

class CancelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $request->session()->put('key', 'value');
        // dd($request->session()->all());
        return view('Admin.CancelationReasons.index',['cancellationReasons'=>CancellationReasons::paginate(5)]);
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
        $cancel=new CancellationReasons;
        $cancel->create($data);
        return redirect()->back()->with('message','cancellation reason has been added successfully 😀');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CancellationReasons  $cancellationReasons
     * @return \Illuminate\Http\Response
     */
    public function show(CancellationReasons $cancellationReason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CancellationReasons  $cancellationReasons
     * @return \Illuminate\Http\Response
     */
    public function edit(CancellationReasons $cancellationReason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CancellationReasons  $cancellationReasons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CancellationReasons $cancellationReason)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'name_en'=>'required|string|max:255'
        ]);
      
        $cancellationReason->update($data);
        return redirect()->back()->with('message','cancellation reason has been updated successfully 😀');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CancellationReasons  $cancellationReasons
     * @return \Illuminate\Http\Response
     */
    public function destroy(CancellationReasons $cancellationReason)
    {
        $cancellationReason->delete();
        return redirect()->back()->with('message','this reason is deleted succefully 🙂');
    }
}
