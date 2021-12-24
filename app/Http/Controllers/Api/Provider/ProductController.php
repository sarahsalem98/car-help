<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->id;
        $name=Provider::find($id)->enginner_name;

        return response()->json(["products"=>
                                Product::where('provider_id',$id)->with('category')->get() 
    ],200);
//  return   DB::table('products')
//  ->join('categories', 'products.category_id', '=', 'categories.id')
//  ->select('products.*','categories.name as sara')
//     ->get();

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

        return response()->json([
            'message' => 'product was added succefully',
            'the added product' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {  

        
        $id=Auth::user()->id;
        return response()->json(['product'=>
        Product::where('id',$product->id)
        ->where('provider_id',$id)
        ->get()],200);  
    
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, Product $product)
    {
        if($product){
            $validatedData=$request->validated();    
            $product->fill($validatedData);
            if ($request->hasFile('images')) {
                $images=json_decode($product->images);
                foreach ($images as $image) {
                    Storage::delete($image);
                 
                }
                foreach ($request->file('images') as $image) {
                    $name = $image->store('product_images');
                    $data[] = $name;
                }
             
            }
            $product->images = json_encode($data);
            $product->save();
            if($product->save()){
                return response()->json(['message'=>"product{$product->id} was updated successfuly "
                                    ,   'the updated car'=>$product],200);
            }else{
                return response()->json(['errors'=>"product {$product->id} was not updated"],400);
            }
        }else{
            return response()->json(['errors'=>"this product{$product->id} is not found"],204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product){
             $images=json_decode($product->images);
            
                foreach ($images as $image) {
                    Storage::delete($image);
                 
                }
            if($product->delete()){
                return response()->json(['message'=>"product {$product->id} was delete succesfully"],200);
            }else{
                return response()->json(['errors'=>"product {$product->id} was not deleted"],400);
            }
        }else{
               return response()->json(['errors'=>"this product{$product->id} is not found"],204);
        }
 
    }
}
