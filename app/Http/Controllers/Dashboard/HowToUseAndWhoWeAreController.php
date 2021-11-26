<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\More;
use Illuminate\Http\Request;

class HowToUseAndWhoWeAreController extends Controller
{
    public function howToUseIndex()
    {
        //    dd(More::all('how_to_use','id')->first());
        return view('Admin.HowToUseAndWhoWeAre.howToUseIndex', ['howToUse' => More::all('how_to_use', 'id')->first()]);
    }
    public function howToUseUpdate(Request $request)
    {
        $data = $request->validate([
            'how_to_use' => 'required|string',

        ]);
        $more = More::find($request->id);
        $more->how_to_use = $data['how_to_use'];
        $more->save();
        return redirect()->back()->with('message','how to use has been updated successfuly😊');
    }
    public function whoWeAreIndex(){
        return view('Admin.HowToUseAndWhoWeAre.whoWeAreIndex', ['whoWeAre' => More::all('who_are_we', 'id')->first()]);
    }
    public function whoWeAreUpdate(Request $request){
        $data = $request->validate([
            'who_are_we' => 'required|string',

        ]);
        $more = More::find($request->id);
        $more->who_are_we = $data['who_are_we'];
        $more->save();
        return redirect()->back()->with('message','who_are_we e has been updated successfuly😊');
    }
    public function commessionIndex(){
        return view('Admin.HowToUseAndWhoWeAre.commessionIndex'
       , ['commission' => More::all('commission', 'id')->first()]
    );
  
    }
    public function commessionUpdate(Request $request){
        $data = $request->validate([
            'commission' => 'required|integer',

        ]);
        $more = More::find($request->id);
        $more->commission = $data['commission'];
        $more->save();
        return redirect()->back()->with('message','commission e has been updated successfuly😊');  
    }
}
