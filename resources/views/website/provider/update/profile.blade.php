@extends('layouts.website')
@section('provider.profile.update')
@include('website.provider.layout.profileTop')

<div class="profile-section">
    <div class="container">
        <div class="row">
        @include('website.provider.layout.profileMenu')
            <div class="col-xs-12 col-sm-9 profile_content">
                <h3 class="sections-title mb-0">تعديل البيانات الشخصية</h3>
                <form action="{{route('provider.profile.update.post')}}" method="POST" class="car_form">
                    <div class="workshop_name">
                        <div class="workshop_avatar">
                            <img src="{{$provider->photoUrl()}}" alt="" class="info-img">
                            <i class="fa fa-camera"></i>
                        </div>
                        <input type="file">
                 
                    </div>
                    <div class="form-group">
                        <label for="yourName">اسم الورشة</label>
                        <input type="text" class="form-control" id="yourName" value="{{$provider->workshop_name}}" >
                        <i class="fa fa-pencil-square-o edit-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="engName">اسم المهندس المسئول ثلاثي</label>
                        <input type="text" class="form-control" id="engName"  value="{{$provider->enginner_name}}">
                        <i class="fa fa-pencil-square-o edit-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">رقم الجوال</label>
                        <input type="tel" class="form-control" id="phone"  name="phone_number"  value="{{$provider->phone_number}}">
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">رقم الوتساب</label>
                        <input type="tel" class="form-control" id="phone"  name="whatsapp_number"  value="{{$provider->whatsapp_number}}">
                    </div>
                    <div class="form-group">
                        <label for="yourEmail">البريد الالكتروني</label>
                        <input type="email" class="form-control" id="yourEmail" value="{{$provider->email}}">
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
                  
                        <label for="yourCommercial">  السجل التجاري <a href="{{$provider->registerationUrl()}}" class="fa fa-download">رؤية</a></label>
                        <input type="email" class="form-control" id="yourCommercial"  value="{{$provider->business_registeration_file}}">
                        <input type="file" class="Commercial_record">
                        <i class="fa fa-upload upload_icon"></i>
                       
                    </div>

                    <div class="form_btns_wrapper">
                        <button class="btn main_btn w-100 moving_bk w-md-40 mb-sm-2">حفظ التغييرات</button>
                        <a class="btn btn-default w-100 w-md-40" href="provider_profile_change_pass.html">تغيير كلمة السر</a>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
@endsection