@extends('layouts.website')
@section('provider.statistics')
@include('website.provider.layout.profileTop')
<!--start profile-->
<div class="profile-section">
    <div class="container">
        <div class="row">
          @include('website.provider.layout.profileMenu')
            <div class="col-xs-12 col-sm-8 profile_content">
                <h3 class="sections-title b-0 mb-15">الاحصائيات</h3>
                <div class="stat_wrapper">
                    <div class="stat_media">
                        <div class="stat_img blue_bk">
                            <img src="{{asset('website/image/b-stat.png')}}" alt="">
                        </div>
                        <div class="stat_info">
                            <h5 class="stat_title">{{$new_orders_count}}</h5>
                            <p class="stat_name">{{__('new orders')}}</p>
                        </div>
                    </div>
                    <div class="stat_media">
                        <div class="stat_img orange_bk">
                            <img src="{{asset('website/image/o-stat.png')}}" alt="">
                        </div>
                        <div class="stat_info">
                            <h5 class="stat_title">{{$now_orders_count}}</h5>
                            <p class="stat_name"> {{__('current orders')}}</p>
                        </div>
                    </div>
                    <div class="stat_media">
                        <div class="stat_img green_bk">
                            <img src="{{asset('website/image/g-stat.png')}}" alt="">
                        </div>
                        <div class="stat_info">
                            <h5 class="stat_title">{{$finished_orders_count}}</h5>
                            <p class="stat_name"> {{__('completed orders')}}</p>
                        </div>
                    </div>
                    <div class="stat_media">
                        <div class="stat_img red_bk">
                            <img src="{{asset('website/image/r-stat.png')}}" alt="">
                        </div>
                        <div class="stat_info">
                            <h5 class="stat_title">{{$canceled_orders_count}}</h5>
                            <p class="stat_name"> {{__('cancelled orders')}}</p>
                        </div>
                    </div>
                    <div class="stat_media">
                        <div class="stat_img green_bk">
                            <img src="{{asset('website/image/c-stat.png')}}" alt="">
                        </div>
                        <div class="stat_info">
                            <h5 class="stat_title">{{$provider_products}}</h5>
                            <p class="stat_name">{{__('products quentity')}} </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection