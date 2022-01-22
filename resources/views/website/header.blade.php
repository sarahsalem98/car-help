<div class="menu-logo inner-pages">
    <!--------    modal search ---------->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <form class="search-form">
                        <div class="form-group">
                            <input type="search" class="form-control wow rotateInDown" id="yourSearch" aria-describedby="searchHelp" placeholder="كلمة بحثك">

                            <button type="submit" class="search_btn"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--navbar-->

    <div class="navbar-wrapper container d-flex justify-content-between align-items-center">

        <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button" id="sidebar_toggler">
                <i class="fa fas fa-bars bars-toggler-icon"></i>
            </button>
            <a class="navbar-brand" href="{{route('main')}}"><img src="{{asset('website/image/logo.png')}}" alt=""></a>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item @if(Route::current()->getName() == 'main') active @endif">
                        <a class="nav-link" href="{{route('main')}}">{{__('main')}}</a>
                    </li>
                    <li class="nav-item @if(Route::current()->getName() == 'about.us') active @endif">
                        <a class="nav-link" href="{{route('about.us')}}">{{__('who we are')}} </a>
                    </li>
                    <!-- <li class="nav-item">
                                <a class="nav-link" href="#">{{__('our features')}}</a>
                            </li> -->
                    <li class="nav-item @if(Route::current()->getName() == 'categories') active @endif">
                        <a class="nav-link" href="{{route('categories')}}">{{__('categories')}}</a>
                    </li>
                    <li class="nav-item @if(Route::current()->getName() == 'contact.us') active @endif">
                        <a class="nav-link" href="{{route('contact.us')}}"> {{__('contact us')}} </a>
                    </li>
                </ul>
                <!-- <button class="search_btn" data-toggle="modal" data-target="#searchModal"> <i class="fa fa-search"></i> </button> -->
            </div>
        </nav>
        <div class="mobile_wrapper_nav d-flex justify-content-between align-items-center">
            @if(Auth::guard('clientWeb')->check())
            <a href="{{route('public.order')}}" class="btn general_order_btn moving_bk d_mob_none"> <i class="fa fa-plus"></i> طلب عام</a>
            @endif
            <button class="btn toggle-dark-mode ">
                <span class="trans"><i class="fa fa-lightbulb-o"></i></span>
            </button>
            @if(Auth::guard('clientWeb')->check())
            <div class="after_login_wrapper d-flex align-items-center">
            
                <a href="{{route('client.favourite.providers.show')}}" class="social-link rel_icon d_mob_none">
                    <i class="fa @if(Route::current()->getName() == 'client.favourite.providers.show')fa-heart @else fa-heart-o @endif"></i>
                </a>
              
                <a href="{{route('client.cart.show')}}" class="social-link rel_icon">
                    <span class="noti_num"> {{Auth::guard('clientWeb')->user()->cartCount()}}</span>
                    <img src="{{asset('website/image/shopping-cart.png')}}" alt="">
                </a>
                <a href="{{route('client.notifications')}}" class="social-link rel_icon d_mob_none">
                    <span class="noti_num">{{Auth::guard('clientWeb')->user()->notificationClientCount()}}</span>
                    <i class="fa fa-bell-o"></i>
                </a>
                <span class="divider_span d_mob_none"></span>
                <a href="{{route('client.profile.update')}}" class="profile_icon d_mob_none">
                    <img src="@if(Auth::guard('clientWeb')->user()->profile_photo_path==null)
                            {{asset('website/image/avatar2.png')}} 
                            @else
                            {{Auth::guard('clientWeb')->user()->photoUrl()}}
                            @endif" alt="">
                </a>
            </div>
            @endif

            @if(Auth::guard('providerWeb')->check())
            <div class="after_login_wrapper d-flex align-items-center">
                <a href="{{route('provider.notifications')}}" class="social-link rel_icon d_mob_none">
                    <span class="noti_num">{{Auth::guard('providerWeb')->user()->notificationProviderCount()}}</span>
                    <i class="fa fa-bell-o"></i>
                </a>
                <span class="divider_span d_mob_none"></span>

                <a href="{{route('provider.statistics')}}" class="profile_icon d_mob_none">
                    <img src="{{Auth::guard('providerWeb')->user()->photoUrl()}}" alt="">
                </a>
            </div>
            @endif
            @if(!(Auth::guard('providerWeb')->check()||Auth::guard('clientWeb')->check()))

            <div class="login_wrapper d-flex justify-content-between d_mob_none">
                <!-- <a href="signup.html" class="btn moving_bk sign_up_btn"> {{__('register')}}</a> -->
                <div class="btn moving_bk sign_up_btn">
                    <a class="dropdown-toggle " href="#" id="droplog" role="button" data-toggle="dropdown"> {{__('register')}} </a>
                    <div class="dropdown-menu" aria-labelledby="droplog">
                        <a class="dropdown-item" href="{{route('provider.register.first.page')}}"> <img src="{{asset('website/image/company.png')}}" alt=""> {{__('provider')}} </a>
                        <a class="dropdown-item" href="{{route('client.register')}}"> <img src="{{asset('website/image/user.png')}}" alt=""> {{__('user')}}</a>
                    </div>
                </div>

                <div class="log_in_btn dropdown btn moving_bk">
                    <a class="dropdown-toggle" href="#" id="droplog" role="button" data-toggle="dropdown"> {{__('login')}} </a>
                    <div class="dropdown-menu" aria-labelledby="droplog">
                        <a class="dropdown-item" href="{{route('provider.login.page')}}"> <img src="{{asset('website/image/company.png')}}" alt=""> {{__('provider')}}</a>
                        <a class="dropdown-item" href="{{route('client.login')}}"> <img src="{{asset('website/image/user.png')}}" alt=""> {{__('user')}}</a>
                    </div>
                </div>
            </div>

            @endif

            <div class="lang-item dropdown d-inline-block">
                @if(app()->getLocale()=='ar')

                <a class="lang-link dropdown-toggle" href="" id="dropOne" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('website/image/saudi-arabia.png')}}" alt=""> {{__('arabic')}}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropOne">
                    <a class="dropdown-item" href="{{route('change.lang',['locale'=>'en'])}}"><img src="{{asset('website/image/eng.png')}}" alt=""> English</a>
                </div>

                @else
                <a class="lang-link dropdown-toggle" href="" id="dropOne" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('website/image/eng.png')}}" alt=""> English
                </a>

                <div class="dropdown-menu" aria-labelledby="dropOne">
                    <a class="dropdown-item" href="{{route('change.lang',['locale'=>'ar'])}}"><img src="{{asset('website/image/saudi-arabia.png')}}" alt=""> {{__('arabic')}}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>