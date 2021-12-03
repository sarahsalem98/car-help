@extends('layouts.website')
@section('provider.first.register.page')

<div class="inner_pages_top">
    <h3 class="inner-pages-title"> {{__('register')}}</h3>
    <ol class="breadcrumb">
        <li><a href="index.html"> <i class="flaticon-home"></i> {{__('main')}}</a></li>
        <li class="active"> {{__('register')}}</li>
    </ol>
</div>


@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<!--start contact us-->
<div class="login_section">
    <div class="container">
        <form action="{{route('provider.register.first.page.post')}}" method="POST" enctype="multipart/form-data" class="login_form">
            @csrf
            <h3 class="main-pages-title"> {{__('register')}}</h3>
            <p class="main-center-des">{{__('register for a new account')}}</p>
            <div class="row">
                <div class="workshop_name col-xs-12">
                    <img src="{{asset('website/image/avatar.png')}}" alt="" class="workshop_avatar" id="preview">
                    <input type="file" id="fileUploader" name="workshop_photo_path">
                    <h5> {{__('work shop photo')}}</h5>
                    @include('website.more',['field'=>'workshop_photo_path'])
                </div>
                <div class="form-group col-xs-12">
                    <label for="yourName"> {{__('work shop name')}}</label>
                    <input type="text" class="form-control" name="workshop_name" id="yourName" value="{{old('workshop_name')}}" placeholder="الرجاء ادخال اسم الورشة">
                  @include('website.more',['field'=>'workshop_name'])
                </div>
                <div class="form-group col-xs-12">
                    <label for="engName">{{__('engineer name')}}</label>
                    <input type="text" class="form-control" id="engName" name="enginner_name" value="{{old('enginner_name')}}" placeholder="الرجاء ادخال اسم المهندس المسئول ثلاثي ">
                    @include('website.more',['field'=>'enginner_name'])
                </div>
                <div class="form-group col-xs-12">
                    <label for="phoneNumber"> {{__('phone number')}}</label>
                    <input type="tel" class="form-control" name="phone_number" value="{{old('phone_number')}}" id="phone" placeholder="الرجاء ادخال رقم الجوال">
                    @include('website.more',['field'=>'phone_number'])
                </div>
                <div class="form-group col-xs-12">
                    <label for="phoneNumber"> {{__('whatsapp number')}}</label>
                    <input type="tel" class="form-control" name="whatsapp_number" id="phone" value="{{old('whatsapp_number')}}" placeholder="الرجاء ادخال رقم الجوال">
                    @include('website.more',['field'=>'whatsapp_number'])
                </div>
                <div class="form-group col-xs-12">
                    <label for="yourEmail"> {{__('email')}}</label>
                    <input type="email" class="form-control" name="email" id="yourEmail" value="{{old('email')}}" placeholder="الرجاء ادخال البريد الالكتروني">
                    @include('website.more',['field'=>'email'])
                </div>
                <div class="form-group col-xs-12">
                    <label for="yourCommercial"> {{__('registeration file')}}</label>
                    <input class="form-control" id="showFileName" value="" placeholder="الرجاء ارفاق السجل التجاري">
                    <input type="file" name="business_registeration_file" id="yourCommercial" class="Commercial_record">
                    @include('website.more',['field'=>'business_registeration_file'])
                    <i class="fa fa-upload upload_icon"></i>
                </div>
                <div class="form-group col-xs-12">
                    <label for="password"> {{__('password')}}</label>
                    <input type="password" class="form-control mb-3" name="password" id="password" placeholder="الرجاء ادخال كلمة المرور">
                    <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                    @include('website.more',['field'=>'password'])
                </div>
                <div class="col-xs-12 checkbox">
                    <label>
                        <input type="hidden" name="agreed" value="0">
                        <input type="checkbox" name="agreed" value="1">
                        <span class="check_yellow"></span>
                        {{__('with register you approve on ')}} <a href="index.html">{{__('terms and conditions')}} </a>
                       
                    </label>
                    @include('website.more',['field'=>'agreed'])
                </div>

                <button type="submit" class="btn main_btn moving_bk submit_btn"> {{__('register')}}</button>
                <p class="have_account"> {{__('had account already?')}} ؟ <a href="login.html"> {{__('click her')}}</a></p>
            </div>
        </form>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function(e) {
        $('#fileUploader').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
<script>
    $('#yourCommercial').on('change', function() {
        var fileName = $(this).val();
        var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
        document.getElementById('showFileName').value = cleanFileName;
    })
    window.onload = function() {
        document.getElementById('showFileName').value = "";
    }
</script>



@endpush

@endsection