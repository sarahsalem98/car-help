@extends('layouts.website')
@section('provider.register.servicetype')

<div class="login_section">
        <div class="container">
            <form action="" class="login_form">
                <h3 class="main-pages-title">حدد نوع الخدمة المقدمة</h3>
                <p class="main-center-des">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر</p>
                <div class="row">
                    @foreach($services as $service)
                    <div class="col-xs-12 checkbox service_checkbox">
                        <label> 
                          <input type="checkbox" value="" name="service">
                          <span class="check_yellow"></span>
                         {{$service->name}}
                        </label>
                    </div>
                    @endforeach
                   
                    <a href="signup_provider_brand.html" class="btn main_btn moving_bk submit_btn">التالي</a>
                  </div>
            </form>
        </div>
     </div>
     @endsection