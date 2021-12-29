@extends('layouts.website')
@section('provider.order.product')

@include('website.provider.layout.profileTop')
<!--start profile-->
<div class="profile-section">
    <div class="container">
        <div class="row">
            @include('website.provider.layout.profileMenu')
            <div class="col-xs-12 col-sm-8 profile_content">
                <h3 class="sections-title b-0 mb-15">خدماتي</h3>
                <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="products_wrapper">
                    <ul class="nav nav-pills products-pills">
                        <li class="nav-item active">
                            <a class="nav-link" href="#product_one" data-toggle="tab">
                                طلبات جديدة
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#product_two" data-toggle="tab">
                                طلبات قيد التنفيذ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#product_three" data-toggle="tab">
                                طلبات مكتملة
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#product_four" data-toggle="tab">
                                طلبات ملغاة
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContentproducts">
                        <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="product_one">
                            @foreach($orders as $order)
                            @if($order->status==0)
                            <div class="media">

                                <a href="order_details.html" class="product-img">
                                    @if($order->firstImageUrl()==null)
                                    <img src="{{asset('website/image/box.png')}}">
                                    @else
                                    <img src="{{$order->firstImageUrl()}}">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <a href="order_details.html">
                                        <h5 class="product-title"> {{$order->client->name}}</h5>
                                    </a>
                                    <p class="order-number">رقم الطلب : {{$order->id}}</p>
                                    <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($order->created_at)}} دقائق</span>
                                </div>
                            </div>

                            @endif
                            @endforeach

                        </div>
                        <div class="products_wrapper tab-pane fade" role="tabpanel" id="product_two">
                            @foreach($orders as $order)
                            @if($order->status==1)
                            <div class="media">
                                <a href="order_details.html" class="product-img">
                                @if($order->firstImageUrl()==null)
                                    <img src="{{asset('website/image/box.png')}}">
                                    @else
                                    <img src="{{$order->firstImageUrl()}}">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <a href="order_details_processed.html">
                                        <h5 class="product-title">{{$order->client->name}}</h5>
                                    </a>
                                    <p class="order-number">رقم الطلب :{{$order->id}} </p>
                                    <span class="order-time"><i class="fa fa-clock-o"></i> {{now()->diffInMinutes($order->created_at)}} دقائق</span>
                                </div>
                            </div>
                            @endif
                            @endforeach


                        </div>

                        <div class="products_wrapper tab-pane fade" role="tabpanel" id="product_three">
                            @foreach($orders as $order)
                            @if($order->status==4)
                            <div class="media">
                                <a href="order_details_completed.html" class="product-img">
                                @if($order->firstImageUrl()==null)
                                    <img src="{{asset('website/image/box.png')}}">
                                    @else
                                    <img src="{{$order->firstImageUrl()}}">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <a href="order_details_completed.html">
                                        <h5 class="product-title"> {{$order->client->name}} </h5>
                                    </a>
                                    <p class="order-number">رقم الطلب :{{$order->id}} </p>
                                    <span class="order-time"><i class="fa fa-clock-o"></i> {{now()->diffInMinutes($order->created_at)}} دقائق</span>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="products_wrapper tab-pane fade" role="tabpanel" id="product_four">
                            @foreach($orders as $order)
                            @if($order->status==5)
                            <div class="media">
                                <a href="order_details_completed.html" class="product-img">
                                @if($order->firstImageUrl()==null)
                                    <img src="{{asset('website/image/box.png')}}">
                                    @else
                                    <img src="{{$order->firstImageUrl()}}">
                                    @endif
                                    
                                </a>
                                <div class="media-body">
                                    <a href="order_details_completed.html">
                                        <h5 class="product-title"> {{$order->client->name}} </h5>
                                    </a>
                                    <p class="order-number">رقم الطلب :{{$order->id}} </p>
                                    <span class="order-time"><i class="fa fa-clock-o"></i> {{now()->diffInMinutes($order->created_at)}} دقائق</span>
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