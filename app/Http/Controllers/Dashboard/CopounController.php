<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\More;
use Illuminate\Http\Request;

class CopounController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $copouns=More::whereNotNull('coupons')->paginate(5,['coupons','id']);
        if(!$copouns->isEmpty()){

            return view('Admin.Copoun.index',['copouns'=>$copouns]);
        }else{
            return view('Admin.Copoun.index',['copouns'=>More::paginate(5,['coupons','id'])]);
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
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'value'=>'required|integer'
        ]);
        $json_data=json_encode($data);
         $more_not_null=More::whereNull('coupons')->get();
        //  dd($more_not_null);
          if(!$more_not_null->isEmpty()){
            $more_not_null[0]->coupons=$json_data;
            $more_not_null[0]->save();
          }else{
              $more=new More;
              $more->coupons=$json_data;
              $more->save();
          }
  
         return redirect()->back()->with('message','copoun is added successfully😃');
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
    public function edit($copoun)
    {
    //    dd(More::where('id',$copoun)->get('coupons'));
         return view('Admin.Copoun.edit',['copoun'=>More::find($copoun)->pluck('coupons')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $copoun)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'value'=>'required|integer'
        ]);
        $json_data=json_encode($data);
         $more=More::find($copoun);
         $more->coupons=$json_data;
         $more->save();
  
         return redirect()->back()->with('message','copoun is updated successfully😃');
         
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
      $more->coupons=null;
      $more->save();
      return redirect()->back()->with('message','copoun is deleted successfully🙂');

    }
}
