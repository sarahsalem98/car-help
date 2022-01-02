<?php

namespace App\Http\Controllers\Website\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $id=Auth::user()->id; 
        $provider=Provider::find($id);
        $productCategories=Category::all();
        $providerProducts=$provider->product()->get();
        return view('website.provider.product.index',['providerProducts'=>$providerProducts,'productCategories'=>$productCategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('website.provider.product.store',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
     
        $validatedData = $request->validated();
        $product = new Product;
        $product->fill($validatedData);
        $product->provider_id = Auth::user()->id;

        if ($request->hasfile('images')) {

            foreach ($request->file('images') as $image) {
                $name = $image->store('product_images');
                $data[] = $name;
            }
        }


        $product->images = json_encode($data);
 

        $product->save();

        return redirect()->route('yield.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $yield )
    {
        return view('website.provider.product.show',['product'=>$yield]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $yield)
    { 
        $categories=Category::all();
        return view('website.provider.product.update',['product'=>$yield,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $yield)
    {
        $yield->delete();
        return redirect()->back()->with('message','this product os deleteted');
    }
}
