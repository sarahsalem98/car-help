@extends('layouts.website')
@section('provider.register.servicetype')

<div class="login_section">
        <div class="container">
            <form method="POST" action="{{route('provider.register.service.type.post')}}" class="login_form">
                @csrf
                <h3 class="main-pages-title">حدد نوع الخدمة المقدمة</h3>
                <p class="main-center-des">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر</p>
                @include('website.allErrors')
                <div class="row">
                    <input type="hidden" name="provider_id" value="{{$provider_id}}">
                    @foreach($services as $service)
                    <div class="col-xs-12 checkbox service_checkbox">
                        <label> 
                          <input type="checkbox" value="{{$service->id}}" name="subservice[]">
                          <span class="check_yellow"></span>
                          @if(app()->getLocale()=='ar')
                         {{$service->name}}
                         @else
                         {{$service->name_en}}
                         @endif
                        </label>
                    </div>
                    @endforeach
                   
                    <button type="submit"  class="btn main_btn moving_bk submit_btn">التالي</button>
                  </div>
            </form>
        </div>
     </div>
     @endsection