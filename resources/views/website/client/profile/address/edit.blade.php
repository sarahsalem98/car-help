

@extends('layouts.website')
@section('client.profile.address.edit')
<div class="inner_pages_top">
        <h3 class="inner-pages-title">تعديل العنوان</h3>
        <ol class="breadcrumb">
            <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li><a href="{{route('client.address')}}"> العناوين</a></li>
            <li class="active">تعديل العنوان</li>
          </ol>
    </div>
     <!--start contact us-->
     <div class="login_section">
        <div class="container edit_address_wapper">
            <h5 class="sections-title mb-14">تعديل العنوان</h5>
            @include('website.alertSuccess')
            <div class="row">
                <div class="col-xs-12 col-lg-10">
                    <form action="{{route('client.address.update',['address_id'=>$address->id])}}" class="address_form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="yourName">الاسم</label>
                                <input type="text" class="form-control" name="name" value="{{$address->name}}" id="yourName"  placeholder="الرجاء ادخال الاسم">
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="country">عنوان التسليم</label>
                                <input type="text" class="form-control mb-3" value="{{$address->address}}" name="address" id="address" placeholder="الرجاء ادخال المدينة">
                                <i class="fa fa-map-marker map_icon"></i>
                            </div>
                            <div class="form-group col-xs-12 "id="map"></div>
                            <input type="hidden" name="lat" value="{{$address->lat}}" placeholder="lat" id="lat">
                            <input type="hidden" name="long" value="{{$address->long}}" placeholder="long" id="long">
                            <div class="form-group col-xs-12">
                                <label for="phoneNumber">رقم الجوال</label>
                                <input type="text" name="phone_number" value="{{$address->phone_number}}" class="form-control" id="phone">      
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="yourName">ملاحظات</label>
                                <textarea class="form-control" name="notes" placeholder="الرجاء ادخال ملاحظات">{{$address->notes}}</textarea>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn main_btn moving_bk submit_btn" >حفظ التغييرات</button>
                            </div>
                          </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
     @endsection
