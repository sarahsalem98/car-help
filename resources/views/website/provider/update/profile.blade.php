@extends('layouts.website')
@section('provider.profile.update')
@include('website.provider.layout.profileTop')

<div class="profile-section">
    <div class="container">
        <div class="row">
            @include('website.provider.layout.profileMenu')
            <div class="col-xs-12 col-sm-9 profile_content">
                <h3 class="sections-title mb-0">تعديل البيانات الشخصية</h3>

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('provider.profile.update.post')}}" method="POST" enctype="multipart/form-data" class="car_form">
                    @csrf
                    <div class="workshop_name">
                        <div class="workshop_avatar">
                            <img src="{{$provider->photoUrl()}}" alt="" class="info-img">
                            <i class="fa fa-camera"></i>
                        </div>
                        <input type="file">

                    </div>
                    <div class="form-group">
                        <label for="yourName">اسم الورشة</label>
                        <input type="text" class="form-control" id="yourName" name="workshop_name" value="{{$provider->workshop_name}}">
                        <i class="fa fa-pencil-square-o edit-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="engName">اسم المهندس المسئول ثلاثي</label>
                        <input type="text" class="form-control" id="engName" name="enginner_name" value="{{$provider->enginner_name}}">
                        <i class="fa fa-pencil-square-o edit-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">رقم الجوال</label>
                        <input type="hidden"  id="country_code_set"  value="{{$provider->country_code_name}}">
                        <input type="hidden"  id="country_code_get" name="country_code_name" value="">
                        <input type="tel" class="form-control" value="{{$provider->phone_number_without_country_code}}"  id="phone" placeholder="الرجاء ادخال رقم الجوال ">
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">رقم الوتساب</label>
                        <input type="text" class="form-control" id="phone" name="whatsapp_number" value="{{$provider->whatsapp_number}}">
                    </div>
                    <div class="form-group">
                        <label for="yourEmail">البريد الالكتروني</label>
                        <input type="email" class="form-control" id="yourEmail" name="email" value="{{$provider->email}}">
                    </div>
                    <!-- <div class="form-group">
                        <label for="yourName">المدينة</label>
                        <select name="country" id="country" class="form-control">
                            <option value="0" selected>الرجاء ادخال المدينة</option>
                            <option value="1">القاهرة</option>
                            <option value="2">المنصورة</option>
                            <option value="3">اسكندرية</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="yourCountry">المدينة</label>
                        <input type="password" class="form-control" id="yourCountry"  value="{{$provider->workshop_name}}">
                        <i class="fa fa-map-marker edit-icon color-red"></i>
                    </div> -->
                    <div class="form-group ">

                        <label for="yourCommercial"> السجل التجاري <a href="{{$provider->registerationUrl()}}" class="fa fa-download">رؤية</a></label>
                        <input type="text" class="form-control" id="yourCommercial" value="{{$provider->business_registeration_file}}">
                        <input type="file" name="business_registeration_file" class="Commercial_record">
                        <i class="fa fa-upload upload_icon"></i>

                    </div>

                    <div class="form_btns_wrapper">
                        <button type="submit" class="btn main_btn w-100 moving_bk w-md-40 mb-sm-2">حفظ التغييرات</button>
                        <a class="btn btn-default w-100 w-md-40" href="{{route('provider.password.update')}}">تغيير كلمة السر</a>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

@endsection