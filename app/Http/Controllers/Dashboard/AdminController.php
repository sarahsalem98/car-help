<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('Admin.Admin.index',['admins'=>User::all(),'AuthAdmin'=>Auth::user()]);
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
       
        $authAdmin=Auth::user();
        $this->authorize('store-admin',$authAdmin);
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|confirmed',
        ]);
       
          
         $user=new User;
         $user->fill($data);
         $user->password=bcrypt($data['password']);
         $user->save();
         return redirect()->back()->with('message','admin has been added successfully 😃');
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('Admin.Admin.edit',['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        // dd($request);
        $authAdmin=Auth::user();
        $this->authorize('update-admin',$authAdmin);
        if(!$admin->email==$request->email){
            
            $data=$request->validate([
                'name'=>'string|max:255',
                'email'=>'string|email|max:255|unique:users',
                'password'=>'string',
            ]);
        }else{
            $data=$request->validate([
                'name'=>'string|max:255',
                'email'=>'string|email|max:255',
                'password'=>'string',
            ]);
        }
         
         $admin->fill($data);
         $admin->password=bcrypt($data['password']);
         $admin->save();
         return redirect()->back()->with('message','admin has been updated successfully 😃');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $authAdmin=Auth::user();
        $this->authorize('delete-admin',$authAdmin);
        
        $admin->delete();
        return redirect()->back()->with('message','admin has been deleted succefully👌');
    }
}
