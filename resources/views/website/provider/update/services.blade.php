@extends('layouts.website')
@section('provider.services.update')
@include('website.provider.layout.profileTop')
<div class="profile-section">
    <div class="container">
        <div class="row">
        @include('website.provider.layout.profileMenu')
            <div class="col-xs-12 col-sm-9 profile_content">
                <h3 class="sections-title"> الخدمات المقدمة </h3>
                <form action="{{route('provider.services.update.post')}}" method="POST" class="login_form w-100">
                    @csrf
                    <h3 class="main-start-title">حدد نوع الخدمة المقدمة</h3>
                    <p class="main-start-des">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر</p>
                    @include('website.alertSuccess')
                    @include('website.AllErrors')
                    <div class="row">
                    @foreach($services as $service)
                    <div class="col-xs-12 checkbox service_checkbox">
                        <label> 
                            <span class="alert-danger">
                              
                                <input type="checkbox"   value="{{$service->id}}" name="subservice[]"  @if($provider->subServices()->find($service->id)) checked @endif  >
                               
                                <span class="check_yellow"></span>
                             
                            </span>
                          @if(app()->getLocale()=='ar')
                         {{$service->name}}
                        
                         @else
                         {{$service->name_en}}
                         @endif
                        </label>
                    </div>
                    @endforeach
                       

                        <button type="submit" class="btn main_btn moving_bk submit_btn">حفظ التغييرات</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div
@endsection