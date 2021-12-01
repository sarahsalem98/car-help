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
        return view('Admin.HowToUseAndWhoWeAre.howToUseIndex', ['howToUse' => More::all('how_to_use','how_to_use_en', 'id')->first()]);
    }
    public function howToUseUpdate(Request $request)
    {
        $more = More::find($request->id);
        if($request->how_to_use){
            $data = $request->validate([
                'how_to_use' => 'required|string',
    
            ]);
            $more->how_to_use = $data['how_to_use'];
            $more->save();
            return redirect()->back()->with('message','how to use has been updated successfuly😊');
        }elseif($request->how_to_use_en){
            $data = $request->validate([
                'how_to_use_en' => 'required|string',
    
            ]);
         
            $more->how_to_use_en = $data['how_to_use_en'];
            $more->save();
            return redirect()->back()->with('message','how to use in english has been updated successfuly😊'); 
        }
    
    }
    public function whoWeAreIndex(){
        return view('Admin.HowToUseAndWhoWeAre.whoWeAreIndex', ['whoWeAre' => More::all('who_are_we', 'who_are_we_en','id')->first()]);
    }
    public function whoWeAreUpdate(Request $request){
        $more = More::find($request->id);
        if($request->who_are_we){
            $data = $request->validate([
                'who_are_we' => 'required|string',
    
            ]);
            $more->who_are_we = $data['who_are_we'];
            $more->save();
            return redirect()->back()->with('message','who_are_we e has been updated successfuly😊');
        }elseif($request->who_are_we_en){
            $data = $request->validate([
                'who_are_we_en' => 'required|string',
    
            ]);
            $more->who_are_we_en = $data['who_are_we_en'];
            $more->save();
            return redirect()->back()->with('message','who_are_we in english e has been updated successfuly😊');
        }
    
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
    
    //////

    public function othersIndex(){
        // dd(More::all('email', 'id','location','phone'
        // ,'google','youtube','twitter','facebook')->first());
        return view('Admin.HowToUseAndWhoWeAre.others',['others'=>More::all('email', 'id','location','phone'
        ,'google','youtube','twitter','facebook')->first()]);
    }
    public function othersUpdate(Request $request){
 $more=More::find($request->id);
        if($request->email){
            $data=$request->validate([
                'email'=>'required|email'
            ]);
        $more->email=$data['email'];
        $more->save();
        return redirect()->back()->with('message','email is updated successfully😊');

     }
   
     elseif($request->facebook){
        $data=$request->validate([
            'facebook'=>'required'
        ]);
    $more->facebook=$data['facebook'];
    $more->save();
    return redirect()->back()->with('message','facebook is updated successfully😊');
     
    }
    
    
    
    elseif($request->phone){
        $data=$request->validate([
            'phone'=>'required|integer'
        ]);
    $more->phone=$data['phone'];
    $more->save();
    return redirect()->back()->with('message','phone is updated successfully😊');
     }
     
     
     elseif($request->location){
        $data=$request->validate([
            'location'=>'required'
        ]);
    $more->location=$data['location'];
    $more->save();
    return redirect()->back()->with('message','location is updated successfully😊');
     }
     
     
     elseif($request->google){
        $data=$request->validate([
            'google'=>'required'
        ]);
    $more->google=$data['google'];
    $more->save();
    return redirect()->back()->with('message','google is updated successfully😊');
     }
     
     elseif($request->youtube){
        $data=$request->validate([
            'youtube'=>'required'
        ]);
    $more->youtube=$data['youtube'];
    $more->save();
    return redirect()->back()->with('message','youtube is updated successfully😊');
     }
     
     elseif($request->twitter){
        $data=$request->validate([
            'twitter'=>'required'
        ]);
    $more->twitter=$data['twitter'];
    $more->save();
    return redirect()->back()->with('message','twitter is updated successfully😊');
     }
    }
}
