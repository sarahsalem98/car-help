@extends('layouts.website')
@section('provider.password.update')
@include('website.provider.layout.profileTop')
<!--start profile-->
<div class="profile-section">
    <div class="container">
        <div class="row">
        @include('website.provider.layout.profileMenu')

            <div class="col-xs-12 col-sm-9 profile_content">
         @include('website.alertSuccess')
         @include('website.alertDanger')
                <form action="{{route('provider.password.update.post')}}" method="POST" class="car_form">
                    @csrf
                    <h3 class="sections-title"> {{__('change password')}} </h3>
                    <div class="form-group">
                        <label for="password1"> {{__('old password')}}</label>
                        <input type="password" class="form-control mb-3" name="old_password" id="password1" placeholder="{{__('please enter password')}} ">
                        <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                        @include('website.more',['field'=>'old_password'])
                    </div>
                    <div class="form-group">
                        <label for="password2">  {{__('new password')}}</label>
                        <input type="password" class="form-control mb-3" name="new_password" id="password2" placeholder="{{__('please enter password')}}">
                        <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                        @include('website.more',['field'=>'new_password'])
                    </div>
                    <div class="form-group">
                        <label for="password3"> {{__('new password confirmation')}}</label>
                        <input type="password" class="form-control mb-3" name="new_password_confirmation" id="password3" placeholder="{{__('please enter password')}}">
                        <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                        @include('website.more',['field'=>'new_password_confirmation'])
                    </div>
                    <div class="form_btns_wrapper">
                        <button type="submit" class="btn main_btn w-100 moving_bk w-md-40 mb-sm-2"> {{__('save changes')}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection