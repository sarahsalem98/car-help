<div class="col-xs-12 col-sm-4 profile_aside">
                <div class="profile_card card">
                    <div class="profile-img">
                        <img src="@if(Auth::guard('clientWeb')->user()->profile_photo_path==null)
                            {{asset('website/image/avatar2.png')}} 
                            @else
                            {{Auth::guard('clientWeb')->user()->photoUrl()}}
                            @endif" alt="">
                    </div>
                    <h3 class="profile-title">{{Auth::user()->name}}</h3>
                </div>
                <div class="profile_menu">
                    <a href="profile.html" class="profile_link active_link"> <i class="icon-user"></i> تعديل حسابي</a>
                    <a href="my_orders.html" class="profile_link"> <i class="icon-order"></i>طلباتي</a>
                    <a href="my_addresses.html" class="profile_link"> <i class="icon-address"></i>عناويني</a>
                    <a href="my_cars.html" class="profile_link"> <i class="icon-car"></i>سياراتي</a>
                    <a href="{{route('client.logout')}}" class="profile_link"> <i class="icon-logout"></i>تسجيل الخروج</a>
                </div>
            </div>