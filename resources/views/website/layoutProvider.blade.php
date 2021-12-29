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
        @if(Route::current()->getName() == 'client.favourite.providers.show' )
          @if(Auth::user()->hasFavouriteProviders($provider->id))

        <form action="{{route('client.favourite.providers.show.post',
            ['mainService_id'=>$provider->pivot->mainService_id
            ,'providerId'=>$provider->id
            ,'add'=> 0
            ])}}" method="POST">
            @csrf

            <button type="submit" class="fa @if(Auth::user()->hasFavouriteProviders($provider->id)) fa-heart @else fa-heart-o @endif  add_fav_btn"></button>
        </form>
          @else
          <form action="{{route('client.favourite.providers.show.post',
            ['mainService_id'=>$provider->pivot->mainService_id
            ,'providerId'=>$provider->id
            ,'add'=> 1
            ])}}" method="POST">
            @csrf

            <button type="submit" class="fa @if(Auth::user()->hasFavouriteProviders($provider->id)) fa-heart @else fa-heart-o @endif  add_fav_btn"></button>
        </form>
          @endif 

        @else
        @if(Auth::user()->hasFavouriteProviders($provider->id))

        <form action="{{route('client.favourite.providers.show.post',
            ['mainService_id'=>$mainCategory->id
            ,'providerId'=>$provider->id
            ,'add'=>0
            ])}}" method="POST">
           @csrf
            <button type=submit class="fa @if(Auth::user()->hasFavouriteProviders($provider->id)) fa-heart @else fa-heart-o @endif  add_fav_btn"></button>
        </form>
        @else

        <form action="{{route('client.favourite.providers.show.post',
            ['mainService_id'=>$mainCategory->id
            ,'providerId'=>$provider->id
            ,'add'=>1
            ])}}" method="POST">
         @csrf
            <button type=submit class="fa @if(Auth::user()->hasFavouriteProviders($provider->id)) fa-heart @else fa-heart-o @endif  add_fav_btn"></button>
        </form>

        @endif
        @endif


    </div>
</div>