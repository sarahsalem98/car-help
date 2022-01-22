<div class="col-xs-12 col-sm-3 profile_aside">
                <div class="profile_card card">
                    <div class="profile-img">
                        <img src="{{Auth::user()->photoUrl()}}" alt="">
                    </div>
                    <h3 class="profile-title">{{Auth::user()->workshop_name}} </h3>
                </div>
                <div class="profile_menu">
                    <a href="{{route('provider.statistics')}}" class="profile_link  @if(Route::current()->getName() == 'provider.statistics') active_link @endif"> <i class="icon-speedometer-1"></i>{{__('statistics')}}</a>
                    <a href="{{route('provider.profile.update')}}" class="profile_link @if(Route::current()->getName() == 'provider.profile.update'||Route::current()->getName() == 'provider.password.update')) active_link @endif "> <i class="icon-user"></i>{{__('edit my account')}}</a>
                    <a href="{{route('provider.address.update')}}" class="profile_link @if(Route::current()->getName() == 'provider.address.update') active_link @endif "> <i class="icon-address"></i>  {{__('edit my address')}}</a>
                    <a href="{{route('provider.services')}}" class="profile_link   @if(Route::current()->getName() == 'provider.services') active_link @endif"> <i class="icon-services"></i>{{__('my services')}}</a>
                    <a href="{{route('provider.orders')}}" class="profile_link @if(Route::current()->getName() == 'provider.orders') active_link @endif"> <i class="icon-order"></i>{{__('my orders')}}</a>
                    <a href="{{route('yield.index')}}" class="profile_link @if(Route::current()->getName() == 'yield.index') active_link @endif"> <i class="icon-products"></i>{{__('my products')}}</a>
                    <a href="{{route('provider.services.update')}}" class="profile_link @if(Route::current()->getName() == 'provider.services.update') active_link @endif"> <i class="icon-services"></i> {{__('offered services')}}</a>
                    <a href="{{route('provider.brands.update')}}" class="profile_link @if(Route::current()->getName() == 'provider.brands.update') active_link @endif"> <i class="icon-services"></i>{{__('offered brands')}}</a>
                    <a href="my_wallet.html" class="profile_link"> <i class="icon-wallet"></i>{{__('wallet')}}</a>
                    <a href="{{route('provider.logout')}}" class="profile_link"> <i class="icon-logout"></i> {{__('logout')}}</a>
                </div>
            </div>