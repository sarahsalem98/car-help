<!doctype html>
<html lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> car help</title>
    <link href="{{asset('websit/image/logo.png')}}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{asset('website/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('website/css/hover.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/slick.css')}}" rel="stylesheet">
    <link href="{{asset('website/fonts/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/intlTelInput.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/bootstrap-3.min.css')}}" rel="stylesheet">
    @if(app()->getLocale()=='ar')
    <link href="{{asset('website/css/bootstrap-3-rtl.min.css')}}" rel="stylesheet">
    @endif
    <link href="{{asset('website/css/main.css')}}" rel="stylesheet">
    @if(app()->getLocale()=='ar')
    <link href="{{asset('website/css/style-ar.css')}}" rel="stylesheet">
    @elseif(app()->getLocale()=='en')
    <link href="{{asset('website/css/style-en.css')}}" rel="stylesheet">

    @endif

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
            <form action="" class="search-form mb-3" autocomplete="off">
                <div class="input-group">
                    <button type="submit" class="search_btn"> <i class="fa fa-search"></i> </button>
                    <input type="search" class="form-control" id="searchInput" placeholder="كلمة بحثك ...">
                </div>
            </form>

            <a href="#" class="btn shop_btn">الدخول أو التسجيل من هنا</a>
        </div>
        <div id="burgerBtn"></div>
        <ul class="mobile-store-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fa fa-home"></i>
                    <span>الرئيسية</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link all_category has_sub_menu" href="#">
                    <i class="fa fa-list"></i>
                    <span>أقسامنا</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">
                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>قسم</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">قسم 1</a></li>
                            <li><a href="#">قسم 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>قسم</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">قسم 1</a></li>
                            <li><a href="#">قسم 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>قسم</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">قسم 1</a></li>
                            <li><a href="#">قسم 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>العروض</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">العروض</a></li>
                            <li><a href="#">العروض</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>البديل الرخيص</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">بديل</a></li>
                            <li><a href="#">بديل</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link all_category has_sub_menu" href="#">
                    <i class="fa fa-list"></i>
                    <span>منتجاتنا</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">
                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>منتج</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">قسم 1</a></li>
                            <li><a href="#">قسم 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>منتج</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">قسم 1</a></li>
                            <li><a href="#">قسم 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>منتج</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">قسم 1</a></li>
                            <li><a href="#">قسم 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>العروض</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">العروض</a></li>
                            <li><a href="#">العروض</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has_sub_menu">
                            <span>البديل الرخيص</span>
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <ul class="sub_menu">
                            <li class="back_li">
                                <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                            </li>
                            <li><a href="#">بديل</a></li>
                            <li><a href="#">بديل</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link my_account has_sub_menu" href="">
                    <i class="fa fa-user"></i>
                    <span>حسابي</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">
                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                    </li>
                    <li><a href="#">تسجيل الدخول</a></li>
                    <li><a href="#">تسجيل جديد</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link my_currency has_sub_menu" href="">
                    <i class="fa fa-dollar"></i>
                    <span>العملة</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">
                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                    </li>
                    <li><a href="#">ريال سعودي</a></li>
                    <li><a href="#">جنيه مصري</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link my_language has_sub_menu" href="">
                    <i class="fa fa-language"></i>
                    <span>اللغة</span>
                    <i class="fa fa-angle-left"></i>
                </a>
                <ul class="sub_menu">

                    <li class="back_li">
                        <a href="#" class="back_btn"><i class="fa fa-chevron-right"></i> الي الخلف </a>
                    </li>
                    <li><a href="index-en.html">En</a></li>
                    <li><a href="index">عربي</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-heart"></i>
                    <span>المفضلة</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-question"></i>
                    <span>اتصل بنا</span>
                </a>
            </li>
        </ul>
    </div>

    <!--start header-->
    <header>
        @include('website.main.header')
    </header>
    <!--end header-->

    @yield('website.main')
    @yield('provider.first.register.page')
    @yield('provider.register.servicetype')

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
                            <a href="#" class="menu-link">{{__('main')}}</a>
                        </li>
                        <li class="menu-item ">
                            <a href="#" class="menu-link">{{__('who we are')}} </a>
                        </li>
                        <li class="menu-item ">
                            <a href="#" class="menu-link">{{__('our features')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">{{__('contact us')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-3">
                    <h5 class="mb-4 footer-title">{{__('quick links')}}<i class="fa fa-level-down"></i></h5>
                    <ul class="menu">
                        <li class="menu-item">
                            <a href="#" class="menu-link">{{__('categories')}}</a>
                        </li>
                        <li class="menu-item ">
                            <a href="#" class="menu-link">{{__('download app')}}</a>
                        </li>
                        <li class="menu-item ">
                            <a href="#" class="menu-link">{{__('terms and conditions')}}</a>
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
            <p>حسابي</p>
        </a>
        <a href="#" class="tab-shape">
            <i class="fa fa-heart"></i>
            <p>المفضلة</p>
            <p></p>
        </a>
        <a href="#" class="tab-shape">
            <i class="fa fa-home"></i>
            <p>الرئيسية</p>
            <p></p>
        </a>
        <a href="#" class="tab-shape">
            <i class="fa fa-shopping-bag"></i>
            <p>سلتي</p>
        </a>
        <a class="btn toggle-dark-mode">
            <span class="trans"><i class="fa fa-lightbulb-o"></i></span>
        </a>
    </div>
    
    <script src="{{asset('website/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('website/js/slick.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.3/lottie.min.js" integrity="sha512-35O/v2b9y+gtxy3HK+G3Ah60g1hGfrxv67nL6CJ/T56easDKE2TAukzxW+/WOLqyGE7cBg0FR2KhiTJYs+FKrw==" crossorigin="anonymous"></script>
    <script src="{{asset('website/js/intlTelInput.min.js')}}"></script>
    <script src="{{asset('website/js/bootstrap-3.min.js')}}"></script>
    <script src="{{asset('website/js/main.js')}}"></script>
    <script src="{{asset('website/js/wow.min.js')}}"></script>
    <script>
        new WOW().init();
    </script>
    <script>
        var input = document.querySelector('#phone');
        var iti = window.intlTelInput(input, {
            utilsScript: 'js/utils.js'
        });
    </script>
    @stack('script')
 

</body>

</html>