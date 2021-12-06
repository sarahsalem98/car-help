
@extends('layouts.website')
@section('provider.register.address')
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
            <form action="{{route('provider.register.address.post')}}" method="POST" class="login_form">
                <h3 class="main-pages-title">انشاء حساب</h3>
                <p class="main-center-des">سجل بياناتك من اجل انشاء حساب جديد</p>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="yourName">المدينة</label>
                        <select name="country" id="country" class="form-control">
                            <option value="" selected>الرجاء ادخال المدينة</option>
                            @foreach($cities as $city)
                            @if(app()->getLocale()=='ar')
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @else
                            <option value="{{$city->id}}">{{$city->name_en}}</option>
                            @endif
                         
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="country">المدينة</label>
                        <input type="text" class="form-control mb-3" id="country" placeholder="الرجاء ادخال المدينة">
                        <i class="fa fa-map-marker map_icon"></i>
                    </div>
                    <a  class="btn main_btn moving_bk submit_btn" href="signup_verify_code.html">تأكيد</a>
                  </div>
            </form>
        </div>
     </div>

@endsection