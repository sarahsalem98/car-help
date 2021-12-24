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
                    <a href="{{route('client.profile.update')}}" class="profile_link @if(Route::current()->getName() == 'client.profile.update') active_link @endif"> <i class="icon-user"></i> تعديل حسابي</a>
                    <a href="{{route('client.orders')}}" class="profile_link   @if(Route::current()->getName() == 'client.orders') active_link @endif"> <i class="icon-order"></i>طلباتي</a>
                    <a href="{{route('client.address')}}" class="profile_link   @if(Route::current()->getName() == 'client.address') active_link @endif"> <i class="icon-address"></i>عناويني</a>
                    <a href="{{route('cars.index')}}" class="profile_link   @if(Route::current()->getName() == 'cars.index') active_link @endif"> <i class="icon-car"></i>سياراتي</a>
                    <a href="{{route('client.logout')}}" class="profile_link"> <i class="icon-logout"></i>تسجيل الخروج</a>
                </div>
            </div>