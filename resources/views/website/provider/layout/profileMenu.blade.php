<div class="col-xs-12 col-sm-3 profile_aside">
                <div class="profile_card card">
                    <div class="profile-img">
                        <img src="{{Auth::user()->photoUrl()}}" alt="">
                    </div>
                    <h3 class="profile-title">{{Auth::user()->workshop_name}} </h3>
                </div>
                <div class="profile_menu">
                    <a href="{{route('provider.statistics')}}" class="profile_link  @if(Route::current()->getName() == 'provider.statistics') active_link @endif"> <i class="icon-speedometer-1"></i>الاحصائيات</a>
                    <a href="{{route('provider.profile.update')}}" class="profile_link @if(Route::current()->getName() == 'provider.profile.update') active_link @endif "> <i class="icon-user"></i> تعديل حسابي</a>
                    <a href="provider_profile.html" class="profile_link "> <i class="icon-address"></i> تعديل عنوانى</a>
                    <a href="provider_services.html" class="profile_link"> <i class="icon-services"></i>خدماتي</a>
                    <a href="my_orders_provider.html" class="profile_link"> <i class="icon-order"></i>طلباتي</a>
                    <a href="provider_products.html" class="profile_link"> <i class="icon-products"></i>منتجاتي</a>
                    <a href="provider_services_type.html" class="profile_link"> <i class="icon-services"></i>الخدمات المقدمة</a>
                    <a href="provider_brand_type.html" class="profile_link"> <i class="icon-services"></i>الماركات المقدمة</a>
                    <a href="my_wallet.html" class="profile_link"> <i class="icon-wallet"></i>المحفظة</a>
                    <a href="{{route('provider.logout')}}" class="profile_link"> <i class="icon-logout"></i>تسجيل الخروج</a>
                </div>
            </div>