<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">

    <title>car help</title>

    <!--Morris Chart CSS -->
    <!-- <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}"> -->
    <link href="{{asset('plugins/custombox/css/custombox.css')}}" rel="stylesheet">

    <link href="{{asset('plugins/footable/css/footable.core.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />

    <link href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{asset('plugins/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />


    <link href="{{asset('css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/components.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css" />

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="{{asset('js/modernizr.min.js')}}"></script>

    <livewire:scripts />
    <livewire:styles />
</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="index.html" class="logo"><img src="{{asset('images/logo.png')}}" class="icon-magnet icon-c-logo" /><span>car<i class="md md-album"></i>help</span></a>
                    <!-- Image Logo here -->
                    <!-- <a href="index.html" class="logo">
                    <i class="icon-c-logo"> <img src="{{asset('images/logo.png')}}" height="42"/></i>
                    <span><img src="{{asset('images/logo.png')}}" height="20"/></span>
                    </a> -->
                </div>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">
                        <div class="pull-left">
                            <button class="button-menu-mobile open-left waves-effect waves-light">
                                <i class="md md-menu"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>






                        <ul class="nav navbar-nav navbar-right pull-right">



                            <li class="hidden-xs">
                                <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                            </li>

                            <li class="dropdown top-menu-item-xs">
                                <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">الصفحه الشخصيه للادمن</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('profile.show') }}"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                    <li class="divider"></li>
                                    <!-- <li><a href="{{ route('logout') }}"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li> -->

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <li>
                                            <x-jet-dropdown-link class="ti-power-off m-r-10  text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-jet-dropdown-link>
                                        </li>
                                    </form>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->

        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>

                        <li class="text-muted menu-title">Navigation</li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i> <span> المستخدميين </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('provider.index') }}"> مقدمى الخدمه</a></li>
                                <li><a href="{{route('client.index')}}">العملاء</a></li>
                                <li><a href="{{route('admin.index')}}">الادمنز</a></li>

                            </ul>
                        </li>

                        <li class="has_sub">

                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-light-bulb"></i> <span> الخدمات </span> <span class="menu-arrow"></span> </a>
                            <ul class="list-unstyled">
                                <li><a href="{{route('service.index')}}">الخدمات الرئيسية</a></li>
                                <li><a href="{{route('subservice.index')}}"> الخدمات الفرعية</a></li>


                            </ul>
                        </li>

                        <li class="has_sub">

                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-shopping-cart"></i> <span> الطلبات </span> <span class="menu-arrow"></span> </a>
                            <ul class="list-unstyled">
                                <li><a href="{{route('public.order.index')}}">طلبات عامه </a></li>
                                <li><a href="{{route('private.order.index')}}"> طلبات خاصه </a></li>
                                <li><a href="{{route('product.order.index')}}"> طلبات المنتجات </a></li>


                            </ul>
                        </li>
                        <!-- 
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-light-bulb"></i><span class="label label-primary pull-right">9</span><span> Components </span> </a>
                            <ul class="list-unstyled">
                                <li><a href="components-grid.html">Grid</a></li>
                                <li><a href="components-widgets.html">Widgets</a></li>
                                <li><a href="components-nestable-list.html">Nesteble</a></li>
                                <li><a href="components-range-sliders.html">Range sliders</a></li>
                                <li><a href="components-masonry.html">Masonry</a></li>
                                <li><a href="components-animation.html">Animation</a></li>
                                <li><a href="components-sweet-alert.html">Sweet Alerts</a></li>
                                <li><a href="components-treeview.html">Treeview</a></li>
                                <li><a href="components-tour.html">Tour</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-spray"></i> <span> Icons </span> <span class="menu-arrow"></span> </a>
                            <ul class="list-unstyled">
                                <li><a href="icons-glyphicons.html">Glyphicons</a></li>
                                <li><a href="icons-materialdesign.html">Material Design</a></li>
                                <li><a href="icons-ionicons.html">Ion Icons</a></li>
                                <li><a href="icons-fontawesome.html">Font awesome</a></li>
                                <li><a href="icons-themifyicon.html">Themify Icons</a></li>
                                <li><a href="icons-simple-line.html">Simple line Icons</a></li>
                                <li><a href="icons-weather.html">Weather Icons</a></li>
                                <li><a href="icons-typicons.html">Typicons</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> Forms </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="form-elements.html">General Elements</a></li>
                                <li><a href="form-advanced.html">Advanced Form</a></li>
                                <li><a href="form-validation.html">Form Validation</a></li>
                                <li><a href="form-pickers.html">Form Pickers</a></li>
                                <li><a href="form-wizard.html">Form Wizard</a></li>
                                <li><a href="form-mask.html">Form Masks</a></li>
                                <li><a href="form-summernote.html">Summernote</a></li>
                                <li><a href="form-wysiwig.html">Wysiwig Editors</a></li>
                                <li><a href="form-code-editor.html">Code Editor</a></li>
                                <li><a href="form-uploads.html">Multiple File Upload</a></li>
                                <li><a href="form-xeditable.html">X-editable</a></li>
                                <li><a href="form-image-crop.html">Image Crop</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-menu-alt"></i><span>Tables </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="tables-basic.html">Basic Tables</a></li>
                                <li><a href="tables-datatable.html">Data Table</a></li>
                                <li><a href="tables-editable.html">Editable Table</a></li>
                                <li><a href="tables-responsive.html">Responsive Table</a></li>
                                <li><a href="tables-foo-tables.html">FooTable</a></li>
                                <li><a href="tables-bootstrap.html">Bootstrap Tables</a></li>
                                <li><a href="tables-tablesaw.html">Tablesaw Tables</a></li>
                                <li><a href="tables-jsgrid.html">JsGrid Tables</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-bar-chart"></i><span class="label label-pink pull-right">11</span><span> Charts </span></a>
                            <ul class="list-unstyled">
                                <li><a href="chart-flot.html">Flot Chart</a></li>
                                <li><a href="chart-morris.html">Morris Chart</a></li>
                                <li><a href="chart-chartjs.html">Chartjs</a></li>
                                <li><a href="chart-peity.html">Peity Charts</a></li>
                                <li><a href="chart-chartist.html">Chartist Charts</a></li>
                                <li><a href="chart-c3.html">C3 Charts</a></li>
                                <li><a href="chart-nvd3.html"> Nvd3 Charts</a></li>
                                <li><a href="chart-sparkline.html">Sparkline charts</a></li>
                                <li><a href="chart-radial.html">Radial charts</a></li>
                                <li><a href="chart-other.html">Other Chart</a></li>
                                <li><a href="chart-ricksaw.html">Ricksaw Chart</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-location-pin"></i><span> Maps </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="map-google.html"> Google Map</a></li>
                                <li><a href="map-vector.html"> Vector Map</a></li>
                            </ul>
                        </li> -->

                        <li class="text-muted menu-title">More</li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-files"></i><span> المزيد </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{route('brandType.index')}}">البراندات </a></li>
                                <li><a href="{{route('cancellationReason.index')}}">اسباب الرفض</a></li>
                                <li><a href="{{route('carModel.index')}}"> موديلات السيارات</a></li>
                                <li><a href="{{route('city.index')}}">المدن</a></li>
                                <li><a href="{{route('banner.index')}}">البنرات</a></li>
                                <li><a href="{{route('copoun.index')}}"> الكوبونات </a></li>
                                <li><a href="{{route('commession.index')}}">العمولات </a></li>
                                <li><a href="{{route('howToUse.index')}}">سياسه الاستخدام </a></li>
                                <li><a href="{{route('whoWeAre.index')}}">من نحن </a></li>
                                <li><a href="{{route('others.index')}}"> السوشيال ميديا وجهات الاتصال </a></li>
                            </ul>
                        </li>

                        <!-- <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-gift"></i><span> Extras </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="extra-profile.html">Profile</a></li>
                                <li><a href="extra-timeline.html">Timeline</a></li>
                                <li><a href="extra-sitemap.html">Site map</a></li>
                                <li><a href="extra-invoice.html">Invoice</a></li>
                                <li><a href="extra-email-template.html">Email template</a></li>
                                <li><a href="extra-maintenance.html">Maintenance</a></li>
                                <li><a href="extra-coming-soon.html">Coming-soon</a></li>
                                <li><a href="extra-faq.html">FAQ</a></li>
                                <li><a href="extra-search-result.html">Search result</a></li>
                                <li><a href="extra-gallery.html">Gallery</a></li>
                                <li><a href="extra-pricing.html">Pricing</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-crown"></i><span class="label label-success pull-right">3</span><span> Apps </span></a>
                            <ul class="list-unstyled">
                                <li><a href="apps-calendar.html"> Calendar</a></li>
                                <li><a href="apps-contact.html"> Contact</a></li>
                                <li><a href="apps-taskboard.html"> Taskboard</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-email"></i><span> Email </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="email-inbox.html"> Inbox</a></li>
                                <li><a href="email-read.html"> Read Mail</a></li>
                                <li><a href="email-compose.html"> Compose Mail</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-widget"></i><span> Layouts </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="layout-leftbar_2.html"> Leftbar with User</a></li>
                                <li><a href="layout-menu-collapsed.html"> Menu Collapsed</a></li>
                                <li><a href="layout-menu-small.html"> Small Menu</a></li>
                                <li><a href="layout-header_2.html"> Header style</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-share"></i><span>Multi Level </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><span>Menu Level 1.1</span> <span class="menu-arrow"></span></a>
                                    <ul style="">
                                        <li><a href="javascript:void(0);"><span>Menu Level 2.1</span></a></li>
                                        <li><a href="javascript:void(0);"><span>Menu Level 2.2</span></a></li>
                                        <li><a href="javascript:void(0);"><span>Menu Level 2.3</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><span>Menu Level 1.2</span></a>
                                </li>
                            </ul>
                        </li> -->

                        <!-- <li class="text-muted menu-title">Extra</li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i><span> Crm </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="crm-dashboard.html"> Dashboard </a></li>
                                <li><a href="crm-contact.html"> Contacts </a></li>
                                <li><a href="crm-opportunities.html"> Opportunities </a></li>
                                <li><a href="crm-leads.html"> Leads </a></li>
                                <li><a href="crm-customers.html"> Customers </a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-shopping-cart"></i><span class="label label-warning pull-right">6</span><span> eCommerce </span></a>
                            <ul class="list-unstyled">
                                <li><a href="ecommerce-dashboard.html"> Dashboard</a></li>
                                <li><a href="ecommerce-products.html"> Products</a></li>
                                <li><a href="ecommerce-product-detail.html"> Product Detail</a></li>
                                <li><a href="ecommerce-product-edit.html"> Product Edit</a></li>
                                <li><a href="ecommerce-orders.html"> Orders</a></li>
                                <li><a href="ecommerce-sellers.html"> Sellers</a></li>
                            </ul>
                        </li> -->

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">


                @yield('index')
                @yield('show')
                @yield('city.search')
                @yield('copoun.search')
                @yield('product.index')
                @yield('search')
                @yield('cancel.search')
                @yield('carModel.search')
                @yield('brand.search')
                @yield('client.index')
                @yield('client.search')
                @yield ('client.edit')
                @yield('Admin.index')
                @yield('Admin.edit')
                @yield('main.index')
                @yield('submain.index')
                @yield('submain.edit')
                @yield('submain.search')
                @yield('main.search')
                @yield('admin.search')
                @yield('main.edit')
                @yield('public.order')
                @yield('private.order')
                @yield('product.order')
                @yield('brand.index')
                @yield('cancel.index')
                @yield('carModel.index')
                @yield('city.index')
                @yield('banner.index')
                @yield('copoun.index')
                @yield('howtoUse.index')
                @yield('whoWeAre.index')
                @yield('commession.index')
                @yield('home.index')
                @yield('others.index')
                <!-- end row -->


                <!-- container -->

            </div>
            <!-- content -->



            <footer class="footer text-right">
                © 2016. All rights reserved.
            </footer>

        </div>




        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        <div class="side-bar right-bar nicescroll">
            <h4 class="text-center">Chat</h4>
            <div class="contact-list nicescroll">
                <ul class="list-group contacts-list">
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-1.jpg')}}" alt="">
                            </div>
                            <span class="name">Chadengle</span>
                            <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-2.jpg')}}" alt="">
                            </div>
                            <span class="name">Tomaslau</span>
                            <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-3.jpg')}}" alt="">
                            </div>
                            <span class="name">Stillnotdavid</span>
                            <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-4.jpg')}}" alt="">
                            </div>
                            <span class="name">Kurafire</span>
                            <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-5.jpg')}}" alt="">
                            </div>
                            <span class="name">Shahedk</span>
                            <i class="fa fa-circle away"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-6.jpg')}}" alt="">
                            </div>
                            <span class="name">Adhamdannaway</span>
                            <i class="fa fa-circle away"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-7.jpg')}}" alt="">
                            </div>
                            <span class="name">Ok</span>
                            <i class="fa fa-circle away"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-8.jpg')}}" alt="">
                            </div>
                            <span class="name">Arashasghari</span>
                            <i class="fa fa-circle offline"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-9.jpg')}}" alt="">
                            </div>
                            <span class="name">Joshaustin</span>
                            <i class="fa fa-circle offline"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{asset('images/users/avatar-10.jpg')}}" alt="">
                            </div>
                            <span class="name">Sortino</span>
                            <i class="fa fa-circle offline"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->





    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->


    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-rtl.min.js')}}"></script>
    <script src="{{asset('js/detect.js')}}"></script>
    <script src="{{asset('js/fastclick.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>


    <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/waves.js')}}"></script>
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script src="{{asset('js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>

    <script src="{{asset('js/jquery.core.js')}}"></script>
    <script src="{{asset('js/jquery.app.js')}}"></script>

    <script src="{{asset('plugins/peity/jquery.peity.min.js')}}"></script>

    <!-- jQuery  -->
    <script src="{{asset('plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
    <script src="{{asset('plugins/counterup/jquery.counterup.min.js')}}"></script>



    <!-- <script src="{{asset('plugins/morris/morris.min.js')}}"></script> -->
    <script src="{{asset('plugins/raphael/raphael-min.js')}}"></script>

    <script src="{{asset('plugins/jquery-knob/jquery.knob.js')}}"></script>

    <script src="{{asset('pages/jquery.dashboard.js')}}"></script>

    <script src="{{asset('plugins/timepicker/bootstrap-timepicker.js')}}"></script>
    <script src="{{asset('plugins/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>

    <script src="{{asset('plugins/custombox/js/custombox.min.js')}}"></script>
    <script src="{{asset('plugins/custombox/js/legacy.min.js')}}"></script>

    <script src="{{asset('plugins/nestable/jquery.nestable.js')}}"></script>
    <script src="{{asset('pages/nestable.js')}}"></script>

    <script src="{{asset('plugins/magnific-popup/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/tiny-editable/mindmup-editabletable.js')}}"></script>
    <script src="{{asset('plugins/tiny-editable/numeric-input-example.js')}}"></script>



    <!-- <script src="https://amsul.ca/pickadate.js/vendor/pickadate/lib/picker.js"></script>
<script src="https://amsul.ca/pickadate.js/vendor/pickadate/lib/picker.time.js"></script>
<script src="https://amsul.ca/pickadate.js/vendor/pickadate/lib/picker.date.js"></script> -->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.counter').counterUp({
                delay: 100,
                time: 1200
            });

            $(".knob").knob();

        });



        var checkList = document.getElementById('list1');
        checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
            if (checkList.classList.contains('visible'))
                checkList.classList.remove('visible');
            else
                checkList.classList.add('visible');
        }



        // Manually toggle to the minutes view
        $('#check-minutes').click(function(e) {
            e.stopPropagation();
            input.pickatime('show').pickatime('toggleView', 'minutes');
        });

        $('.clockpicker').clockpicker();
    </script>






</body>

</html>