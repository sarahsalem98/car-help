<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderUpdate;
use App\Models\BrandType;
use App\Models\Product;
use App\Models\Provider;
use App\Models\ProviderWorkHour;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Provider.index', ['providers' => Provider::paginate(5)]);
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
    public function store(ProviderUpdate $request)
    {
        $rr = $request->validated();
        dd($rr['email']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {

        return view('Admin.Provider.show', ['provider' => $provider, 'brands' => BrandType::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $provider)
    {
       
        $AuthProvider = Provider::findOrFail($provider);
        // dd($AuthProvider->phone_number);
        $photoName = $AuthProvider->workshop_photo_path;
       $fileName = $AuthProvider->business_registeration_file;

        if ($request->phone_number !=$AuthProvider->phone_number) {
            // dd($request);
            $data = $request->validate([
                'enginner_name' => 'string',
                'workshop_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'phone_number' => 'numeric|unique:providers',
                'whatsapp_number' => 'numeric',
                'email' => 'email',
                'business_registeration_file' => 'mimes:pdf,doc,docx'
            ]);
        } else {
            $data = $request->validate([
                'enginner_name' => 'string',
                'workshop_photo_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'whatsapp_number' => 'numeric',
                'email' => 'email',
                'business_registeration_file' => 'mimes:pdf,doc,docx'
            ]);
        }

        if ($request->file('workshop_photo_path')) {
            if (Storage::exists($AuthProvider->workshop_photo_path)) {
                Storage::delete($AuthProvider->workshop_photo_path);
            }
            $photoName = $request->file('workshop_photo_path')->store('workshoph_Photos');
        }
        if ($request->file('business_registeration_file')) {
            // dd($AuthProvider->business_registeration_file);
            if (Storage::exists($AuthProvider->business_registeration_file)) {
                // dd('sa');
                Storage::delete($AuthProvider->business_registeration_file);
            }
            $fileName = $request->file('business_registeration_file')->store('businessrRegisteration_Files');
        }
        // dd($data['business_registeration_file']);
        $AuthProvider->fill($data);
        $AuthProvider->workshop_photo_path = $photoName;
        $AuthProvider->business_registeration_file = $fileName;
        $AuthProvider->save();
        return redirect()->back()->with('message', 'the provider basic information was updated succeesfully😊');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->back()->with('message','provider has been deleted succefully👌');
    }
 
    public function updateBrandTypes(Request $request, $provider)
    {
      
        $ids = array_keys($request->brandtyps);
        $data = $request->validate([
            'brandtyps' => 'required'
        ]);
        // dd($data);
        $found = true;
        foreach ($ids as $id) {

            if (! BrandType::where('id', $id)->first()) {
                $found = false;
            }
        }

        if (!$found) {
            return redirect()->back()->with('error', 'the id of brand is not found');

        }
        $AuthProvider = Provider::find($provider);
        $AuthProvider->brandTypes()->sync(BrandType::find($ids));
       return redirect()->back()->with('message', 'brand types has been updated successfully😊');
    }

public function updateWorkHours(Request $request,$provider){
    $hours=ProviderWorkHour::where('provider_id',$provider)->get();
    foreach($hours as $hour){
      $hour->from=$request->from[$provider][$hour->id];
      $hour->to=$request->to[$provider][$hour->id];
      $hour->closed=$request->closed[$provider][$hour->id];
      $hour->save();
    }
   return redirect()->back()->with('message','work hours has been updated successfully😊');

}
public function providerSuspend(Request $request,$provider){
   
    $AuthProvider = Provider::findOrFail($provider);
    $AuthProvider->suspended=$request->suspended;
    if($request->suspended==1){
        $message='تم ايقاف مقدم الخدمه 👍';
    }elseif($request->suspended==0){
        $message='تم تفعيل مقدم الخدمه 😃';
    }
    $AuthProvider->save();
    return redirect()->back()->with('message', $message);
}


public function showProducts(Request $request,$provider){
$products=Product::where('provider_id',$provider)->paginate(5);
//  dd(json_decode( $products[0]->images)[0]);
$AuthProvider = Provider::findOrFail($provider);
return view('Admin.Product.index',['products'=>$products,'provider'=>$AuthProvider]);
}

public function search(Request $request){
//  dd($request);
    $word = $request->input('searchprovider');
    // dd($word);
    $providers = Provider::where('enginner_name', 'LIKE', '%' . $word . '%')->get();
    return view('Admin.Provider.search', ['providers' => $providers,'word'=>$word]);
}
}
