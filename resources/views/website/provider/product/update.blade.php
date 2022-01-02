

@extends('layouts.website')
@section('provider.product.update')


<div class="inner_pages_top">
        <h3 class="inner-pages-title">اضافة منتج جديد</h3>
        <ol class="breadcrumb">
            <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li><a href="{{route('yield.index')}}"> منتجاتي</a></li>
            <li class="active">اضافة منتج جديد</li>
          </ol>
    </div>
     <!--start contact us-->
     <div class="login_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-10">
                    <form action="{{route('yield.update',['yield'=>$product->id])}}" enctype="multipart/form-data" method="POST" class="address_form" >
                    @csrf
                    @method('PUT')
                        <h5 class="sections-title mb-14">اضافة منتج جديد</h5>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="proName">نوع القسم</label>
                                <select name="category_id" class="form-control">
                                    <option value=" ">الرجاء ادخال نوع القسم</option>
                                    @foreach($categories as $category)
                                    <option  value="{{$category->id}}" {{ $category->id==$product->category_id ? "selected" : "" }} >{{$category->name}}</option>
                                      @endforeach
                                </select>
                                @include('website.more',['field'=>'category_id'])
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="proName">اسم المنتج</label>
                                <input type="text" name="name" class="form-control" id="proName" value="{{$product->name ?  $product->name :old('name')}}" placeholder="الرجاء ادخال اسم المنتج">
                                @include('website.more',['field'=>'name'])
                            </div>
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="proprice">سعر المنتج</label>
                                <input type="text" name="price" class="form-control" value="{{$product->price ?  $product->price :old('price')}}"   placeholder="الرجاء ادخال سعر المنتج">
                                @include('website.more',['field'=>'price'])
                            </div>
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="proprice"> سعر المنتج بعد الخصم</label>
                                <input type="text" name="price_after_discount" class="form-control" value="{{$product->price_after_discount ?  $product->price_after_discount :old('price_after_discount')}}"  id="proprice" placeholder="الرجاء ادخال سعر المنتج">
                                @include('website.more',['field'=>'price_after_discount'])
                            </div>
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="count">الكمية</label>
                                <input type="text" name="qty" class="form-control" value="{{$product->qty ?  $product->qty :old('qty')}}"  id="count" placeholder="الرجاء ادخال الكمية">
                                @include('website.more',['field'=>'qty'])
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="productdetails">تفاصيل المنتج</label>
                                <textarea name="details" class="form-control"   placeholder="الرجاء ادخال تفاصيل المنتج">
                                {{$product->details ?  $product->details :old('details')}}
                                </textarea>
                                @include('website.more',['field'=>'details'])
                            </div>
                            <div class="form-group col-xs-12">
                                <!-- <div class="dropzone__wrapper">
                                    <div class="upload__thumb">
                                        <img src="image/cloud-computing.png" alt="" class="upload__img">
                                        <span class="upload__des">ارفاق صور</span>
                                    </div>
                                    <div class="dropzone">
                                    
                                    </div>
                                </div>    
                                                      -->
                                                      <input type="file" multiple name="images[]" value="{{$product->images ?  json_decode($product->images)[0] :old('images')}}"  >
                                                    <!-- <img src="{{Storage::url(json_decode($product->images)[0])}}" alt="">
                                                    <img src="{{Storage::url(json_decode($product->images)[1])}}" alt="">
                                                    <img src="{{Storage::url(json_decode($product->images)[2])}}" alt=""> -->
                                                      @include('website.more',['field'=>'images'])
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn main_btn moving_bk submit_btn" >تأكيد التعديل</button>
                            </div>
                          </div>
                    </form>
                </div>
            </div>
        </div>
     </div>

@endsection