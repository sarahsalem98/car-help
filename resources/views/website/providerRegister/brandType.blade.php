
@extends('layouts.website')
@section('provider.register.brand_type')

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
            <form method="POST" action="{{route('provider.register.brand.type.post')}}" class="login_form">
                @csrf
                <h3 class="main-pages-title">حدد الماركات المقدمة</h3>
                <p class="main-center-des">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر</p>
                @include('website.allErrors')
                <div class="row">
                    <input type="hidden" name="provider_id" value="{{$provider_id}}">
                    @foreach($brandTypes as $brandType)
                    <div class="col-xs-12 checkbox service_checkbox">
                        <label> 
                          <input type="checkbox" value="{{$brandType->id}}" name="brandType[]">
                          <span class="check_yellow"></span>
                          <img src="{{$brandType->photoUrl()}}" alt="" class="provider_brand_img">
                         {{$brandType->name}}
                        </label>
                    </div>
                    @endforeach
                  
                    
                    <button  class="btn main_btn moving_bk submit_btn">التالي</button>
                  </div>
            </form>
        </div>
     </div>
@endsection