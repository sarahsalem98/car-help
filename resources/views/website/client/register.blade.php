

@extends('layouts.website')
@section('client.register')

 <div class="inner_pages_top">
        <h3 class="inner-pages-title"> انشاء حساب للمستخدم</h3>
        <ol class="breadcrumb">
            <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li class="active">انشاء حساب للمستخدم</li>
          </ol>
    </div>
     <!--start contact us-->
     <div class="login_section">
        <div class="container">
            <form action="{{route('client.register.post')}}" method="POST" class="login_form">
                @csrf
                <h3 class="main-pages-title">انشاء حساب</h3>
                <p class="main-center-des">سجل بياناتك من اجل انشاء حساب جديد</p>
                @include('website.alertDanger')
                @include('website.allErrors')
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="yourName">الاسم</label>
                        <input type="text" class="form-control" name="name" id="yourName" placeholder="الرجاء ادخال الاسم">
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="phoneNumber">رقم الجوال</label>
                        <input type="tel" class="form-control" name="phone_number_without_country_code" id="phone" placeholder="الرجاء ادخال رقم الجوال">      
                        <input type="hidden"  id="country_code_get" name ="country_code_name"  >
                        <input type="hidden"  id="country_code_set" value="sa">
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="yourName">المدينة</label>
                        <select name="city_id" id="country" class="form-control">
                            <option value="" selected>الرجاء ادخال المدينة</option>
                            @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="password">كلمة المرور</label>
                        <input type="password" name="password" class="form-control mb-3" id="password" placeholder="الرجاء ادخال كلمة المرور">
                        <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                    </div>
                    <button type="submit" class="btn main_btn moving_bk submit_btn"> انشاء حساب</button>
                    <p class="have_account">  لديك حساب بالفعل ؟  <a href="login.html">اضفط هنا</a></p>
                  </div>
            </form>
        </div>
     </div>
     @endsection