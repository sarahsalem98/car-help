@extends('layouts.website')
@section('verify')

  <div class="inner_pages_top">
        <h3 class="inner-pages-title">انشاء حساب</h3>
        <ol class="breadcrumb">
            <li><a href="index.html"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li class="active">انشاء حساب</li>
          </ol>
    </div>
     <!--start contact us-->
     <div class="login_section">
        <div class="container">
            <form action="{{route('client.verify.post')}}" method="POST" class="login_form">
                @csrf
                <h3 class="main-pages-title"> كود التحقق من رقمك</h3>
                <p class="main-center-des">برجاء ادخال الكود المرسل اليك عبر رقم الجوال</p>
                <div class="row code_inputs">
                    <input type="tel" name="phone_number" value="{{$client->phone_number}}">
                   <div class="col-xs-3">
                        <input type="text" name="verify_code[]" class="form-control" maxlength="1">
                   </div>
                   <div class="col-xs-3">
                        <input type="text"name="verify_code[]" class="form-control" maxlength="1">
                    </div>
                    <div class="col-xs-3">
                        <input type="text"name="verify_code[]" class="form-control" maxlength="1">
                    </div>
                    <div class="col-xs-3">
                        <input type="text"name="verify_code[]" class="form-control" maxlength="1">
                    </div>
                </div>
                <p class="resend_code">أعد إرسال الكود مرة أخرى</p>
                <button type="submit" class="btn main_btn moving_bk submit_btn" data-toggle="modal" data-target="#ordersentModal">تأكيد</button>
            </form>
        </div>
     </div>
     @endsection