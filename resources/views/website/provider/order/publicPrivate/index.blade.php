@extends('layouts.website')
@section('provider.order.public.private')

@include('website.provider.layout.profileTop')
<!--start profile-->
<div class="profile-section">
    <div class="container">
        <div class="row">
            @include('website.provider.layout.profileMenu')
            <div class="col-xs-12 col-sm-8 profile_content">
                <h3 class="sections-title b-0 mb-15">{{__('my services')}}</h3>
                <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="products_wrapper">
                    <ul class="nav nav-pills products-pills">
                        <li class="nav-item active">
                            <a class="nav-link" href="#product_one" data-toggle="tab">
                            {{__('new orders')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#product_two" data-toggle="tab">
                            {{__('current orders')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#product_three" data-toggle="tab">
                            {{__('completed orders')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#product_four" data-toggle="tab">
                            {{__('cancelled orders')}}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContentproducts">
                        <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="product_one">
                            @foreach($public_private_orders as $public_private_order)
                            @if($public_private_order->status==0)
                            <div class="media">

                                <a href="{{route('provider.service.show',['service_id'=>$public_private_order->id])}}" class="product-img">
                                    @if($public_private_order->firstImageUrl()==null)
                                    <img src="{{asset('website/image/box.png')}}">
                                    @else
                                    <img src="{{$public_private_order->firstImageUrl()}}">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <a href="{{route('provider.service.show',['service_id'=>$public_private_order->id])}}">
                                        <h5 class="product-title"> {{$public_private_order->client->name}}</h5>
                                    </a>
                                    <p class="order-number"> {{__('order number')}} : {{$public_private_order->id}}</p>
                                    <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($public_private_order->created_at)}} {{__('minutes')}}</span>
                                </div>
                            </div>

                            @endif
                            @endforeach

                        </div>
                        <div class="products_wrapper tab-pane fade" role="tabpanel" id="product_two">
                            @foreach($public_private_orders as $public_private_order)
                            @if($public_private_order->status==1 )
                            <div class="media">
                                <a href="{{route('provider.service.now.show',['service_id'=>$public_private_order->id])}}" class="product-img">
                                @if($public_private_order->firstImageUrl()==null)
                                    <img src="{{asset('website/image/box.png')}}">
                                    @else
                                    <img src="{{$public_private_order->firstImageUrl()}}">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <a href="{{route('provider.service.now.show',['service_id'=>$public_private_order->id])}}">
                                        <h5 class="product-title">{{$public_private_order->client->name}}</h5>
                                    </a>
                                    <p class="order-number"> {{__('order number')}} :{{$public_private_order->id}} </p>
                                    <span class="order-time"><i class="fa fa-clock-o"></i> {{now()->diffInMinutes($public_private_order->created_at)}} {{__('minutes')}}</span>
                                </div>
                            </div>
                            @endif
                            @endforeach


                        </div>

                        <div class="products_wrapper tab-pane fade" role="tabpanel" id="product_three">
                            @foreach($public_private_orders as $public_private_order)
                            @if($public_private_order->status==4 || $public_private_order->status==3)
                            <div class="media">
                                <a href="{{route('provider.service.complete.show',['service_id'=>$public_private_order->id])}}" class="product-img">
                                @if($public_private_order->firstImageUrl()==null)
                                    <img src="{{asset('website/image/box.png')}}">
                                    @else
                                    <img src="{{$public_private_order->firstImageUrl()}}">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <a href="{{route('provider.service.complete.show',['service_id'=>$public_private_order->id])}}">
                                        <h5 class="product-title"> {{$public_private_order->client->name}} </h5>
                                    </a>
                                    <p class="order-number"> {{__('order number')}} :{{$public_private_order->id}} </p>
                                    <span class="order-time"><i class="fa fa-clock-o"></i> {{now()->diffInMinutes($public_private_order->created_at)}} {{__('minutes')}}</span>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="products_wrapper tab-pane fade" role="tabpanel" id="product_four">
                            @foreach($public_private_orders as $public_private_order)
                            @if($public_private_order->status==5)
                            <div class="media">
                                <a href="{{route('provider.service.cancel.show',['service_id'=>$public_private_order->id])}}" class="product-img">
                                @if($public_private_order->firstImageUrl()==null)
                                    <img src="{{asset('website/image/box.png')}}">
                                    @else
                                    <img src="{{$public_private_order->firstImageUrl()}}">
                                    @endif
                                    
                                </a>
                                <div class="media-body">
                                    <a href="{{route('provider.service.cancel.show',['service_id'=>$public_private_order->id])}}">
                                        <h5 class="product-title"> {{$public_private_order->client->name}} </h5>
                                    </a>
                                    <p class="order-number"> {{__('order number')}} :{{$public_private_order->id}} </p>
                                    <span class="order-time"><i class="fa fa-clock-o"></i> {{now()->diffInMinutes($public_private_order->created_at)}} {{__('minutes')}}</span>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection