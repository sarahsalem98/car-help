@extends('layouts.website')
@section('website.main')

<div class="header-section">
    <div class="container">
        <div class="one_item_carousel">
            <!-- <div class="item">
                    <div class="top-section">
                        <h5>اطلب خدمتك معنا بكل سهولة</h5>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص
                            من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو
                            العديد من النصوص الأخرى هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة </p>
                        <a class="btn moving_bk main_btn" href="#">قراءة المزيد</a>
                        <div class="header-bullet" data-section=".info-section">
                        </div>
                    </div>
                </div> -->
            <div class="item">
                <div class="top-section">
                    <h5>{{__('ask service easily')}}</h5>
                    <p>{{__('ask service easily details')}} </p>
                    <a class="btn moving_bk main_btn" href="#"> {{__('read more')}}</a>
                    <div class="header-bullet" data-section=".info-section">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--start info section-->
<div class="main-section info-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="info-sec-img wow fadeInDown" data-wow-duration="1s" data-wow-offset="300">
                    <img src="{{asset('website/image/car-man.png')}}" alt="" class="img-responsive">
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="important-info wow fadeInUp" data-wow-duration="1s" data-wow-offset="300">
                    <div class="info_wrapper_title">
                        <h3 class="main-title">{{__('know more about services')}}</h3>
                        <!-- <h3 class="main-title">الخدمات التي نقوم بتقديمها</h3> -->
                    </div>
                    <p class="main-des">  {{__('know more about services details')}}   </p>
                    <a href="#" class="btn main_btn moving_bk mt-2">  {{__('read more')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--start services-->
@include('website.main.features')



<!--start categories-->
@include('website.main.mainservices')

<!--banner section-->
<div class="banner-section" id="download-app">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="banner-content wow fadeInUp" data-wow-duration="1s" data-wow-offset="200">
                    <h5>{{__('download application now')}}</h5>
                    <p>{{__('download application now details')}}</p>
                    <div class="download_btns">
                        <a href="#" class="btn app_store moving_bk">
                            <img src="{{asset('website/image/apple.png')}}" alt="">
                            <div>
                                <span class="download">{{__('download')}}</span>
                                <div>App Store</div>
                            </div>
                        </a>
                        <a href="#" class="btn google_play moving_bk">
                            <img src="{{asset('image/google-play.png')}}" alt="">
                            <div>
                                <span class="download">{{__('download')}}</span>
                                <div>Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-offset-1 col-md-5">
                <div class="banner-img-banner wow fadeInDown" data-wow-duration="1s" data-wow-offset="200">
                    <img src="{{asset('website/image/ban.png')}}" alt="" class="img-responsive">
                </div>
            </div>

        </div>
    </div>
</div>

<!--start contact us-->
@include('website.main.contactwithus')

<!--start partners-->
<div class="main-section partners-section">
    <div class="container">
        <div class="five_items_carousel">
            <div class="partners-product">
                <img src="{{asset('website/image/logo-rentive-blck2.png')}}" alt="">
            </div>
            <div class="partners-product">
                <img src="{{asset('website/image/logo-rentive-blck2.png')}}" alt="">
            </div>
            <div class="partners-product">
                <img src="{{asset('website/image/logo-rentive-blck2.png')}}" alt="">
            </div>
            <div class="partners-product">
                <img src="{{asset('website/image/logo-rentive-blck2.png')}}" alt="">
            </div>
            <div class="partners-product">
                <img src="{{asset('website/image/logo-rentive-blck2.png')}}" alt="">
            </div>
            <div class="partners-product">
                <img src="{{asset('website/image/logo-rentive-blck2.png')}}" alt="">
            </div>
        </div>
    </div>
</div>
@endsection