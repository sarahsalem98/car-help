@extends('layouts.website')
@section('client.login')


 <div class="inner_pages_top">
        <h3 class="inner-pages-title">تسجيل الدخول للمستخدم</h3>
        <ol class="breadcrumb">
            <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li class="active">تسجيل الدخول للمستخدم</li>
          </ol>
    </div>
     <!--start contact us-->
     <div class="login_section">
        <div class="container">
            <form  action="{{route('client.login.post')}}" method="POST" class="login_form">
                @csrf
                <h3 class="main-pages-title"> مرحبا بعودتك مرة أخري</h3>
                <p class="main-center-des">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p>
                @include('website.alertDanger')
                <!-- @include('website.allErrors') -->
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="phoneNumber">رقم الجوال</label>
                        <input type="hidden"  id="country_code_set" value="sa">
                          <input type="tel" class="form-control"  id="phone"placeholder="الرجاء ادخال  رقم الجوال" > 
                          @include('website.more',['field'=>'phone_number'])
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="yourPassword">كلمة المرور</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="الرجاء ادخال كلمة المرور">
                        @include('website.more',['field'=>'password'])
                        <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                    </div>
                    <div class="col-xs-12">
                        <a href="forgetpass.html" class="forget_pass">هل نسيت كلمة المرور ؟</a>
                    </div>
                    <button type="submit" class="btn main_btn moving_bk submit_btn">تسجيل الدخول</button>
                    <p class="have_account"> ليس لديك حساب جديد؟  <a href="signup.html">انشاء حساب</a></p>
                  </div>
            </form>
        </div>
     </div>
     @endsection