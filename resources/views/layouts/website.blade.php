<!doctype html>
<html lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> car help</title>
    <link rel="shortcut icon" href="{{asset('website/image/logo.png')}}" type="image/png" sizes="16x16">
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgZES0EP9ET5sdaCdVLI2HvP-2ee9JwWo&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC"></script>
    <link href="{{asset('website/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('website/css/hover.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/slick.css')}}" rel="stylesheet">
    <link href="{{asset('website/fonts/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/intlTelInput.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/new.css')}}" rel="stylesheet">

    <link href="{{asset('website/css/bootstrap-3.min.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/d10920a460.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    @if(app()->getLocale()=='ar')
    <link href="{{asset('website/css/bootstrap-3-rtl.min.css')}}" rel="stylesheet">
    @endif
    <link href="{{asset('website/css/main.css')}}" rel="stylesheet">
    @if(app()->getLocale()=='ar')
    <link href="{{asset('website/css/style-ar.css')}}" rel="stylesheet">
    @elseif(app()->getLocale()=='en')
    <link href="{{asset('website/css/style-en.css')}}" rel="stylesheet">
    @endif
    <style>
        #map {
            height: 350px;
            width: 100%;
        }
        #map2 {
            height: 500px;
            width: 100%;
        }
    </style>

    <script src="https://use.fontawesome.com/d10920a460.js"></script>
</head>

<body @if(Route::current()->getName() == 'main')class="common-home"@endif>
    <!--loader-->
    <div class="loader-container" id="loader-container">
        <div class="wrap">
            <div id="car-loading"></div>
        </div>
    </div>
    <!--sidebar-->

    <div class="mob-overlay"></div>
    <div class="sidebar-wrapper">
        <div class="m-head">
            <!-- <form action="" class="search-form mb-3" autocomplete="off">
                <div class="input-group">
                    <button type="submit" class="search_btn"> <i class="fa fa-search"></i> </button>
                    <input type="search" class="form-control" id="searchInput" placeholder="???????? ???????? ...">
                </div>
            </form> -->

            <!-- <a href="#" class="btn shop_btn">???????????? ???? ?????????????? ???? ??????</a> -->
        </div>
        <div id="burgerBtn"></div>
        <ul class="mobile-store-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('main')}}">
                    <i class="fa fa-home"></i>
                    <span>????????????????</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link all_category has_sub_menu" href="#">
                    <i class="fa fa-list"></i>
                    <span>??????????????</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">
                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>??????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">?????? 1</a></li>
                            <li><a href="#">?????? 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>??????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">?????? 1</a></li>
                            <li><a href="#">?????? 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>??????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">?????? 1</a></li>
                            <li><a href="#">?????? 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>????????????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">????????????</a></li>
                            <li><a href="#">????????????</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>???????????? ????????????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">????????</a></li>
                            <li><a href="#">????????</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link all_category has_sub_menu" href="#">
                    <i class="fa fa-list"></i>
                    <span>????????????????</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">
                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>????????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">?????? 1</a></li>
                            <li><a href="#">?????? 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>????????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">?????? 1</a></li>
                            <li><a href="#">?????? 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>????????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">?????? 1</a></li>
                            <li><a href="#">?????? 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>????????????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">????????????</a></li>
                            <li><a href="#">????????????</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>???????????? ????????????</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                            </li>
                            <li><a href="#">????????</a></li>
                            <li><a href="#">????????</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link my_account has_sub_menu" href="">
                    <i class="fa fa-user"></i>
                    <span>??????????</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">
                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                    </li>
                    <li><a href="#">?????????? ????????????</a></li>
                    <li><a href="#">?????????? ????????</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link my_currency has_sub_menu" href="">
                    <i class="fa fa-dollar"></i>
                    <span>????????????</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">
                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                    </li>
                    <li><a href="#">???????? ??????????</a></li>
                    <li><a href="#">???????? ????????</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link my_language has_sub_menu" href="">
                    <i class="fa fa-language"></i>
                    <span>??????????</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">

                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> ?????? ?????????? </a>
                    </li>
                    <li><a href="index-en.html">En</a></li>
                    <li><a href="index">????????</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-heart"></i>
                    <span>??????????????</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-question"></i>
                    <span>???????? ??????</span>
                </a>
            </li>
        </ul>
    </div>

    <!--start header-->
    <header>
        @include('website.header')
    </header>
    <!--end header-->

    @yield('website.main')
    @yield('provider.first.register.page')
    @yield('provider.register.servicetype')
    @yield('provider.register.brand_type')
    @yield('provider.register.address')
    @yield('provider.register.work.hours')
    @yield('provider.login.page')
    @yield('who.we.are')
    @yield('categories')
    @yield('contact.us')
    @yield('provider.statistics')
    @yield('provider.profile.update')
    @yield('provider.password.update')
    @yield('provider.services.update')
    @yield('provider.brands.update')
    @yield('provider.order.public.private')
    @yield('provider.order.product')
    @yield('provider.order.public.private.show')
    @yield('provider.order.public.private.now.show')
    @yield('provider.order.public.private.complete.show')
    @yield('provider.order.public.private.cancel.show')
    @yield('provider.order.product.new.show')
    @yield('provider.order.product.is.accepted')
    @yield('provider.order.product.is.prepared')
    @yield('provider.order.product.complete')
    @yield('provider.order.product.cancel')
    @yield('provider.product.index')
    @yield('provider.product.show')
    @yield('provider.product.update')
    @yield('provider.product.store')
    @yield('client.register')
    @yield('client.verify')
    @yield('provider.verify')
    @yield('client.login')
    @yield('client.profile.update')
    @yield('client.profile.password')
    @yield('client.profile.orders.index')
    @yield('client.profile.address.index')
    @yield('client.profile.cars.index')
    @yield('client.profile.cars.create')
    @yield('client.profile.cars.edit')
    @yield('subCategories.index')
    @yield('subCategories.show.provider')
    @yield('subCategories.show.product')
    @yield('client.favourite.providers')
    @yield('client.public.order')
    @yield('client.cart')
    @yield('client.profile.orders.product.new')
    @yield('client.profile.orders.product.now')
    @yield('client.profile.orders.product.complete')
    @yield('client.profile.orders.product.cancel')
    @yield('client.profile.orders.public.private.new')
    @yield('client.profile.orders.public.private.now')
    @yield('client.profile.orders.public.private.complete')
    @yield('client.profile.orders.public.private.cancel')
    @yield('client.notifications')
    @yield('provider.notifications')
    @yield('provider.address.update')
    @yield('client.profile.address.edit')
    @yield('client.profile.address.add')
    <!--start top section-->

    <!--Start footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <a class="footer-brand" href="index.html">
                        <img src="{{asset('website/image/logo.png')}}" alt="">
                    </a>
                    <p class="footer-des">
                        {{__('footer text')}}
                    </p>
                    <ul class="social-list">
                        <li class="social-item d-inline">
                            <a href="#" class="social-link">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="social-item d-inline">
                            <a href="#" class="social-link">
                                <i class="fa fab fa-youtube-play"></i>
                            </a>
                        </li>

                        <li class="social-item d-inline">
                            <a href="#" class="social-link">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="social-item d-inline">
                            <a href="#" class="social-link">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-3">
                    <h5 class="mb-4 footer-title"> {{__('quick links')}}<i class="fa fa-level-down"></i></h5>
                    <ul class="menu">
                        <li class="menu-item">
                            <a href="{{route('main')}}" class="menu-link">{{__('main')}}</a>
                        </li>
                        <li class="menu-item ">
                            <a href="{{route('about.us')}}" class="menu-link">{{__('who we are')}} </a>
                        </li>
                        <!-- <li class="menu-item ">
                            <a href="#" class="menu-link">{{__('our features')}}</a>
                        </li> -->
                        <li class="menu-item">
                            <a href="{{route('contact.us')}}" class="menu-link">{{__('contact us')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-3">
                    <h5 class="mb-4 footer-title">{{__('quick links')}}<i class="fa fa-level-down"></i></h5>
                    <ul class="menu">
                        <li class="menu-item">
                            <a href="{{route('categories')}}" class="menu-link">{{__('categories')}}</a>
                        </li>
                        <li class="menu-item ">
                            <a href="{{route('main')}}/#download-app" class="menu-link">{{__('download app')}}</a>
                        </li>
                        <li class="menu-item ">
                            <a href="{{route('main')}}" class="menu-link">{{__('terms and conditions')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-2">
                    <h5 class="mb-4 footer-title">{{__('quick links')}}<i class="fa fa-level-down"></i></h5>
                    <ul class="menu">
                        <li class="menu-item">
                            <a href="#" class="menu-link"> {{__('location')}} </a>
                        </li>
                        <li class="menu-item ">
                            <a href="#" class="menu-link"> +966 123 456 789</a>
                        </li>
                        <li class="menu-item ">
                            <a href="#" class="menu-link">name@info.sa</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                        <p class="mb-0">{{__('all rights reserved to')}} &copy; <a href="#" class="car-service-logo">Car Service</a> </p>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <a href="https://kian.com.sa/"><img src="{{asset('website/image/kian.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--copyrights-->


    <!-- to top button-->
    <a href="#" class="go-top" data-toggle="tooltip" title="" data-placement="left" data-original-title="go to top">
        <i class="fa fa-chevron-up"></i>
    </a>


    <!--bottom nav-->
    <div class="bottom-nav">
        <a href="#" class="tab-shape">
            <i class="fa fa-user"></i>
            <p>??????????</p>
        </a>
        <a href="#" class="tab-shape">
            <i class="fa fa-heart"></i>
            <p>??????????????</p>
            <p></p>
        </a>
        <a href="#" class="tab-shape">
            <i class="fa fa-home"></i>
            <p>????????????????</p>
            <p></p>
        </a>
        <a href="#" class="tab-shape">
            <i class="fa fa-shopping-bag"></i>
            <p>????????</p>
        </a>
        <a class="btn toggle-dark-mode">
            <span class="trans"><i class="fa fa-lightbulb-o"></i></span>
        </a>
    </div>

    <script src="{{asset('website/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('website/js/slick.js')}}"></script>
    <script src="{{asset('website/js/dropzone.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.3/lottie.min.js" integrity="sha512-35O/v2b9y+gtxy3HK+G3Ah60g1hGfrxv67nL6CJ/T56easDKE2TAukzxW+/WOLqyGE7cBg0FR2KhiTJYs+FKrw==" crossorigin="anonymous"></script>
    <script src="{{asset('website/js/intlTelInput.min.js')}}"></script>
    <script src="{{asset('website/js/jquery.nice-select.js')}}"></script>
    <script src="{{asset('website/js/bootstrap-3.min.js')}}"></script>
    <script src="{{asset('website/js/main.js')}}"></script>
    <script src="{{asset('website/js/wow.min.js')}}"></script>
    <script src="{{asset('website/js/backendProvider.js')}}"></script>
    <script src="{{asset('website/js/backendClient.js')}}"></script>



    <script>
        new WOW().init();
    </script>
    <script>
        var phone_number = window.intlTelInput(document.querySelector("#phone"), {
            separateDialCode: true,
            preferredCountries: ["eg", "sa"],
            hiddenInput: "phone_number",
            initialCountry: document.getElementById('country_code_set').value,
            utilsScript: 'https://intl-tel-input.com/node_modules/intl-tel-input/build/js/utils.js',
            //   utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
            // utilsScript:  "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
            // formatOnDisplay: true,
            // autoHideDialCode: true,
        });
        // var iti = intlTelInput(document.querySelector("#phone"));
        $('.login_form').on('submit', function() {
            var data = phone_number.getSelectedCountryData()['iso2'];
            document.getElementById('country_code_get').value = data;
        });
        $('.car_form').on('submit', function() {
            var data = phone_number.getSelectedCountryData()['iso2'];
            document.getElementById('country_code_get').value = data;
        });
    </script>


    @stack('script')
    @stack('map')
    @stack('modal')


</body>

</html>