<div class="menu-logo inner-pages">
            <!--------    modal search ---------->
            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">      
                      
                            <form class="search-form">
                                <div class="form-group">
                                    <input type="search" class="form-control wow rotateInDown" id="yourSearch"
                                        aria-describedby="searchHelp" placeholder="كلمة بحثك">
                                        
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
                            <li class="nav-item active">
                            <a class="nav-link" href="{{route('main')}}">{{__('main')}}</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="about_us.html">{{__('who we are')}} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{__('our features')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="categories.html">{{__('categories')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact_us.html">{{__('contact us')}} </a>
                            </li>
                        </ul>
                        <button class="search_btn" data-toggle="modal" data-target="#searchModal"> <i class="fa fa-search"></i> </button>
                    </div>
                </nav>
                <div class="mobile_wrapper_nav d-flex justify-content-between align-items-center">
                    <button class="btn toggle-dark-mode ">
                        <span class="trans"><i class="fa fa-lightbulb-o"></i></span>
                    </button>
                    <div class="login_wrapper d-flex justify-content-between d_mob_none">
                        <!-- <a href="signup.html" class="btn moving_bk sign_up_btn"> {{__('register')}}</a> -->
                        <div class="btn moving_bk sign_up_btn">
                            <a class="dropdown-toggle " href="#" id="droplog" role="button" data-toggle="dropdown"> {{__('register')}} </a>
                            <div class="dropdown-menu" aria-labelledby="droplog">
                                <a class="dropdown-item" href="{{route('provider.register.first.page')}}"> <img src="{{asset('website/image/company.png')}}" alt=""> {{__('provider')}} </a>
                                <a class="dropdown-item" href="{{route('client.register.page')}}"> <img src="{{asset('website/image/user.png')}}" alt=""> {{__('user')}}</a>
                            </div>
                        </div>
                      
                        <div class="log_in_btn dropdown btn moving_bk">
                            <a class="dropdown-toggle" href="#" id="droplog" role="button" data-toggle="dropdown"> {{__('login')}} </a>
                            <div class="dropdown-menu" aria-labelledby="droplog">
                                <a class="dropdown-item" href="{{route('provider.login.page')}}"> <img src="{{asset('website/image/company.png')}}" alt="">  {{__('provider')}}</a>
                                <a class="dropdown-item" href="{{route('client.login.page')}}"> <img src="{{asset('website/image/user.png')}}" alt=""> {{__('user')}}</a>
                            </div>
                        </div>
                    </div>
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