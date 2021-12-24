<div class="main-section numbers-section">
    <div class="container">
        <h3 class="main-center-title">{{__('categories')}}</h3>
        <p class="main-center-des">{{__('categories details')}} </p>
        <div class="row">
            @foreach($mainServices as $mainService)
            <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="card numbers-card wow zoomInRight" data-wow-duration="1s" data-wow-offset="200">
                    <a class="card-thumbnail" href="{{route('subCategories.index',['mainCategoryId'=>$mainService->id])}}">
                        <img src="{{$mainService->photoUrl()}}" alt="...">
                    </a>
                    <a class="card-body moving_bk" href="{{route('subCategories.index',['mainCategoryId'=>$mainService->id])}}">
                        @if(app()->getLocale()=='ar')
                        <h5 class="card-title">{{$mainService->name}}</h5>
                        @elseif(app()->getLocale()=='en')
                        <h5 class="card-title">{{$mainService->name_en}}</h5>
                        @endif
                    </a>
                </div>
            </div>
            @endforeach
         

        </div>
    </div>
</div>
