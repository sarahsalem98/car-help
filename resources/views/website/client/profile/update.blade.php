
@extends('layouts.website')
@section('client.profile.update')
@include('website.client.layout.profileTop')

<div class="profile-section">
    <div class="container">
        <div class="row">
    @include('website.client.layout.profileMenu')
 
            <div class="col-xs-12 col-sm-8 profile_content">
                <h3 class="sections-title mb-0">تعديل البيانات الشخصية</h3>
                @include('website.alertSuccess')
                <form action="{{route('client.profile.update.post')}}" method="POST" enctype="multipart/form-data" class="car_form">
                @csrf
                    <div class="workshop_name">
                        <div class="workshop_avatar" >
                            <img src="@if(Auth::guard('clientWeb')->user()->profile_photo_path==null)
                            {{asset('website/image/avatar2.png')}} 
                            @else
                            {{Auth::guard('clientWeb')->user()->photoUrl()}}
                            @endif" alt="" class="info-img" id="preview">
                            <i class="fa fa-camera"></i>
                        </div>
                        <input type="file" id="fileUploader"  name="profile_photo_path">
                    </div>
                    <div class="form-group">
                        <label for="yourName">الاسم</label>
                        <input type="text" class="form-control" id="yourName" value="{{$client->name}}" name="name" placeholder="الرجاء ادخال الاسم">
                        <i class="fa fa-pencil-square-o edit-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">رقم الجوال</label>
                        <input type="hidden"  id="country_code_set"  value="{{$client->country_code_name}}">
                        <input type="hidden"  id="country_code_get" name="country_code_name" value="">
                        <input type="tel" class="form-control" value="{{$client->phone_number_without_country_code}}" name="phone_number_without_country_code" id="phone" placeholder="الرجاء ادخال  رقم الجوال" > 
                    </div>

                    <div class="form-group">
                    <label for="yourName">المدينة</label>
                        <select name="city_id" id="country" class="form-control">
                            <option value="{{$client->city->id}}" selected>{{$client->city->name}}</option>
                            @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_btns_wrapper">
                        <button type="submit" class="btn main_btn w-100 moving_bk w-md-40 mb-sm-2" href="cart.html">حفظ التغييرات</button>
                        <a class="btn btn-default w-100 w-md-40" href="{{route('client.password.update')}}">تغيير كلمة السر</a>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
@endsection