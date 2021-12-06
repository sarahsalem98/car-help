@extends('layouts.website')
@section('provider.login.page')
<div class="inner_pages_top">
        <h3 class="inner-pages-title">تسجيل الدخول</h3>
        <ol class="breadcrumb">
            <li><a href="index.html"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li class="active">تسجيل الدخول</li>
          </ol>
    </div>
     <!--start contact us-->
     <div class="login_section">
        <div class="container">
            <form action="" class="login_form">
                <h3 class="main-pages-title"> مرحبا بعودتك مرة أخري</h3>
                <p class="main-center-des">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="phoneNumber">رقم الجوال</label>
                          <input type="tel" class="form-control" id="phone"> 
                         
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="yourPassword">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" placeholder="الرجاء ادخال كلمة المرور">
                        <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                    </div>
                    <div class="col-xs-12">
                        <a href="forgetpass.html" class="forget_pass">هل نسيت كلمة المرور ؟</a>
                    </div>
                    <a  class="btn main_btn moving_bk submit_btn" href="statistics.html">تسجيل الدخول</a>
                    <p class="have_account"> ليس لديك حساب جديد؟  <a href="signup_provider.html">انشاء حساب</a></p>
                  </div>
            </form>
        </div>
     </div>
@endsection