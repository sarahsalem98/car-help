@extends('layouts.website')
@section('provider.profile.update')
@include('website.provider.layout.profileTop')

<div class="profile-section">
    <div class="container">
        <div class="row">
            @include('website.provider.layout.profileMenu')
            <div class="col-xs-12 col-sm-9 profile_content">
               
                <!-- @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->
                <h3 class="sections-title mb-0">{{__('update personal data')}}</h3>
                <ul class="nav nav-pills products-pills">
                    <li class="nav-item active">
                        <a class="nav-link" href="#info__tab__details" data-toggle="tab">
                        {{__('personal data')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#work__times__details" data-toggle="tab">
                        {{__('work hours')}}
                        </a>
                    </li>
                </ul>

                @include('website.alertSuccess')
                @include('website.AllErrors')

                <div class="tab-content" id="myTabContentproducts">
                    <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="info__tab__details">
                        <form action="{{route('provider.profile.update.post')}}" method="POST" enctype="multipart/form-data" class="car_form">
                            @csrf
                            <div class="workshop_name">
                                <div class="workshop_avatar">
                                    <img src="{{$provider->photoUrl()}}" alt="" class="info-img" id="preview">
                                    <i class="fa fa-camera"></i>
                                </div>
                                <input type="file" id="fileUploader" name="workshop_photo_path">
                                @include('website.more',['field'=>'workshop_photo_path'])

                            </div>
                            <div class="form-group">
                                <label for="yourName"> {{__('work shop name')}}</label>
                                <input type="text" class="form-control" id="yourName" name="workshop_name" value="{{$provider->workshop_name}}">
                                <i class="fa fa-pencil-square-o edit-icon"></i>
                                @include('website.more',['field'=>'workshop_name'])
                            </div>
                            <div class="form-group">
                                <label for="engName"> {{__('engineer name')}}</label>
                                <input type="text" class="form-control" id="engName" name="enginner_name" value="{{$provider->enginner_name}}">
                                <i class="fa fa-pencil-square-o edit-icon"></i>
                                @include('website.more',['field'=>'enginner_name'])
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber"> {{__('phone number')}}</label>
                                <input type="hidden" id="country_code_set" value="{{$provider->country_code_name}}">
                                <input type="hidden" id="country_code_get" name="country_code_name" value="">
                                <input type="tel" class="form-control" name="phone_number_without_country_code" value=" {{$provider->phone_number_without_country_code}}" id="phone" placeholder="الرجاء ادخال رقم الجوال ">
                                @include('website.more',['field'=>'country_code_name'])
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">{{__('whatsapp number')}}</label>
                                <input type="text" class="form-control" id="phone" name="whatsapp_number" value="{{$provider->whatsapp_number}}">
                                @include('website.more',['field'=>'whatsapp_number'])
                            </div>
                            <div class="form-group">
                                <label for="yourEmail"> {{__('email')}}</label>
                                <input type="email" class="form-control" id="yourEmail" name="email" value="{{$provider->email}}">
                                @include('website.more',['field'=>'email'])
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

                                <label for="yourCommercial"> {{__('registeration file')}} <a class="view-pdf" href="{{$provider->registerationUrl()}}" > <i  class="fa fa-download"></i> رؤية</a></label>
                                <input type="text" class="form-control" id="yourCommercial" value="{{$provider->business_registeration_file}}">
                                <input type="file" name="business_registeration_file" class="Commercial_record">
                                <i class="fa fa-upload upload_icon"></i>
                                @include('website.more',['field'=>'business_registeration_file'])
                            </div>

                            <div class="form_btns_wrapper">
                                <button type="submit" class="btn main_btn w-100 moving_bk w-md-40 mb-sm-2"> {{__('save changes')}}</button>
                                <a class="btn btn-default w-100 w-md-40" href="{{route('provider.password.update')}}"> {{__('change password')}} </a>
                            </div>


                        </form>
                    </div>
                    <div class="products_wrapper tab-pane fade" role="tabpanel" id="work__times__details">
                        <form action="{{route('provider.work.hour.update.post')}}" method="POST" class="login_form w-100">
                            @csrf
                            <h3 class="main-pages-title"> {{__('work hours')}}</h3>
                            <p class="main-center-des">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر</p>
                            <h5 class="provider-time-title">{{__('time')}}</h5>
                            <div class="provider_items">
                                @foreach($provider->workHour as $key=>$time)
                                <div class="provider_time_row">
                                    <input type="text" name="time[{{$key}}][day]" value="{{app()->getLocale()=='ar'? $time->day : $time->day_en}}" class="day_input provider_input" placeholder="اليوم">
                                   
                                    <div class="time-form-group">
                                        <input type="time" name="time[{{$key}}][from]" value="{{$time->from}}"   class="time_input hidden_input">
                                        <input type="text"  value="{{$time->from}}" class="time_input provider_input" placeholder="{{__('from')}}">
                                        <i class="fa fa-clock-o"></i>
                                     
                                    </div>
                                    <div class="time-form-group time_input">
                                        <input type="time" name="time[{{$key}}][to]"  value="{{$time->to}}"   class="time_input hidden_input">
                                        <input type="text" value="{{$time->to}}" class="time_input provider_input" placeholder="{{__('to')}}">
                                        <i class="fa fa-clock-o"></i>
                                  
                                    </div>
                                    <label class="close_label mb-0">
                                        <input type="hidden" class="close_checkbox" value="0" name="time[{{$key}}][closed]" >
                                        <input type="checkbox"  class="close_checkbox" value="1"   name="time[{{$key}}][closed]" {{($time->closed=='1') ? 'checked' : '' }} >
                                        {{__('closed')}}
                                    </label>
                                  
                                
                                </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn main_btn moving_bk submit_btn"> {{__('save changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>












@endsection