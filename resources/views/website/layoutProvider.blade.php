<div class="card provider-card moving_bk">
    @if(Route::current()->getName() == 'client.favourite.providers.show' )
    <a class="card-thumbnail" href="{{route('subCategories.provider.show'
        ,
        [
            
            'mainCategory_id'=>$provider->pivot->mainService_id ,  'provider_id'=>$provider->id
        
        ]
        )}}">
        <img src="{{$provider->photoUrl()}}" alt="" class="card-img-top">
    </a>
    @else
    <a class="card-thumbnail" href="{{route('subCategories.provider.show'
        ,
        [
            
            'mainCategory_id'=>$mainCategory->id,  'provider_id'=>$provider->id
        
        ]
        )}}">
        <img src="{{$provider->photoUrl()}}" alt="" class="card-img-top">
    </a>

    @endif
    <div class="card-body">
        <h3 class="card-title">

            @if(Route::current()->getName() == 'client.favourite.providers.show' )
            <a href="{{route('subCategories.provider.show'
                ,[ 
                'mainCategory_id'=>$provider->pivot->mainService_id ,
                'provider_id'=>$provider->id 
                
                ])}}"> {{$provider->workshop_name}}</a>
            @else
            <a href="{{route('subCategories.provider.show'
                ,[ 
                 'mainCategory_id'=>$mainCategory->id ,
                'provider_id'=>$provider->id 
                
                ])}}"> {{$provider->workshop_name}}</a>

            @endif
        </h3>
        <div class="card-address">
            @foreach($provider->address as $address)
            <i class="fa fa-map-marker"></i>
            <span>{{$address->address}}</span>
            @endforeach
        </div>
        <div class="card-contact">
            <div class="distance">
                <i class="fa fa-location-arrow"></i>
                <span class="dis-num">150</span>
            </div>
            <div class="phone">
                <i class="fa fa-phone"></i>
                <span>اتصال</span>
            </div>
            <div class="whats">
                <i class="flaticon-whatsapp"></i>
                <span>واتساب</span>
            </div>
        </div>
    </div>
    <div class="rating">
        <i class="fa fa-star"></i>
        <span>{{round($provider->rate,1)}}</span>
    </div>
    <div class="add_fav">
        <button class="fa @if(Route::current()->getName() == 'client.favourite.providers.show')fa-heart @else fa-heart-o @endif add_fav_btn"></button>
    </div>
</div>