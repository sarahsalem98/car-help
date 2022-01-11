@extends('layouts.website')
@section('provider.brands.update')
@include('website.provider.layout.profileTop')

<!--start profile-->
<div class="profile-section">
    <div class="container">
        <div class="row">
            @include('website.provider.layout.profileMenu')
            <div class="col-xs-12 col-sm-9 profile_content">
                <h3 class="sections-title">  {{__('offered brands')}} </h3>
                <form action="{{route('provider.brands.update.post')}}" method="POST" class="login_form w-100">
                    @csrf
                    <h3 class="main-start-title">{{__('select')}}  {{__('offered brands')}}</h3>
                    <p class="main-start-des">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر</p>
                     @include('website.alertSuccess')
                     @include('website.AllErrors')
                    <div class="row">
                    @foreach($brandTypes as $brandType)
                    <div class="col-xs-12 checkbox service_checkbox">
                        <label>
                        <span class="alert-danger"> 
                        
                          <input type="checkbox" value="{{$brandType->id}}" name="brandType[]" @if($provider->brandTypes()->find($brandType->id)) checked @endif>
                          <span class="check_yellow"></span>
                     
                          </span>
                          <img src="{{$brandType->photoUrl()}}" alt="" class="provider_brand_img">
                          @if(app()->getLocale()=='ar')
                         {{$brandType->name}}
                        
                         @else
                         {{$brandType->name_en}}
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
</div>
@endsection