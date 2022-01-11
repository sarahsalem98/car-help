@extends('layouts.website')
@section('client.profile.orders.index')
@include('website.client.profile.layout.profileTop')

<!--start profile-->
<div class="profile-section">
    <div class="container">
        <div class="row">
            @include('website.client.profile.layout.profileMenu')

            <div class="col-xs-12 col-sm-8 profile_content">
                <ul class="nav nav-pills">
                    <li class="nav-item active">
                        <a class="nav-link" href="#products_wrapper" data-toggle="tab">
                            طلبات المنتجات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#special_orders" data-toggle="tab">
                            طلبات خاصة
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#general_orders" data-toggle="tab">
                            طلبات عامة
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContentwrapper">
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
                                @foreach($productOrders as $productOrder)
                                @if($productOrder->status==0 )
                                <div class="media">
                                    <a href="{{route('client.product.orders.new.show',['order_id'=>$productOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.product.orders.new.show',['order_id'=>$productOrder->id])}}">
                                            <h5 class="product-title"> {{$productOrder->provider->enginner_name}} </h5>
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$productOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i> {{now()->diffInMinutes($productOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach


                            </div>



                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="product_two">
                                @foreach($productOrders as $productOrder)
                                @if($productOrder->status==1 ||$productOrder->status==2 ||$productOrder->status==3 )
                                <div class="media">
                                    <a href="{{route('client.product.orders.now.show',['order_id'=>$productOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.product.orders.now.show',['order_id'=>$productOrder->id])}}">
                                            <h5 class="product-title"> {{$productOrder->provider->enginner_name}} </h5>
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$productOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i> {{now()->diffInMinutes($productOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>

                                @endif
                                @endforeach

                            </div>
                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="product_three">
                                @foreach($productOrders as $productOrder)
                                @if($productOrder->status==4 )
                                <div class="media">
                                    <a href="{{route('client.product.orders.complete.show',['order_id'=>$productOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.product.orders.complete.show',['order_id'=>$productOrder->id])}}">
                                            <h5 class="product-title"> {{$productOrder->provider->enginner_name}} </h5>
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$productOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($productOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>


                                @endif
                                @endforeach
                            </div>
                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="product_four">
                                @foreach($productOrders as $productOrder)
                                @if($productOrder->status==5 )
                                <div class="media">
                                    <a href="{{route('client.product.orders.cancel.show',['order_id'=>$productOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.product.orders.cancel.show',['order_id'=>$productOrder->id])}}">
                                            <h5 class="product-title"> {{$productOrder->provider->enginner_name}} </h5>
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$productOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i> {{now()->diffInMinutes($productOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>

                                @endif
                                @endforeach

                            </div>
                        </div>

                    </div>
                    <div class="orders_wrapper tab-pane fade" role="tabpanel" id="special_orders">
                        <ul class="nav nav-pills products-pills">
                            <li class="nav-item active">
                                <a class="nav-link" href="#special_order_one" data-toggle="tab">
                                    طلبات جديدة
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#special_order_two" data-toggle="tab">
                                    طلبات قيد التنفيذ
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#special_order_three" data-toggle="tab">
                                    طلبات مكتملة
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#special_order_four" data-toggle="tab">
                                    طلبات ملغاة
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContentOrders">
                            <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="special_order_one">
                                @foreach($privateOrders as $privateOrder)
                                @if($privateOrder->status==0 )
                                <div class="media">
                                    <a href="{{route('client.private.public.orders.new',['order_id'=>$privateOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.private.public.orders.new',['order_id'=>$privateOrder->id])}}">
                                            <h5 class="product-title"> {{$privateOrder->provider->enginner_name}} </h5>
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$privateOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($privateOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach


                            </div>
                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="special_order_two">
                                @foreach($privateOrders as $privateOrder)
                                @if($privateOrder->status==1 || $privateOrder->status==3)
                                <div class="media">
                                    <a href="{{route('client.private.public.orders.now',['order_id'=>$privateOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.private.public.orders.now',['order_id'=>$privateOrder->id])}}">
                                            <h5 class="product-title"> {{$privateOrder->provider->enginner_name}} </h5>
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$privateOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($privateOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                            </div>
                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="special_order_three">
                                @foreach($privateOrders as $privateOrder)
                                @if($privateOrder->status==4)
                                <div class="media">
                                    <a href="{{route('client.private.public.orders.complete',['order_id'=>$privateOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.private.public.orders.complete',['order_id'=>$privateOrder->id])}}">
                                            <h5 class="product-title"> {{$privateOrder->provider->enginner_name}} </h5>
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$privateOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($privateOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="special_order_four">
                                @foreach($privateOrders as $privateOrder)
                                @if($privateOrder->status==5)
                                <div class="media">
                                    <a href="{{route('client.private.public.orders.cancel',['order_id'=>$privateOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.private.public.orders.cancel',['order_id'=>$privateOrder->id])}}">
                                            <h5 class="product-title"> {{$privateOrder->provider->enginner_name}} </h5>
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$privateOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($privateOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach



                            </div>
                        </div>
                    </div>
                    <div class="orders_wrapper tab-pane fade" role="tabpanel" id="general_orders">
                        <ul class="nav nav-pills products-pills">
                            <li class="nav-item active">
                                <a class="nav-link" href="#general_one" data-toggle="tab">
                                    طلبات جديدة
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#general_two" data-toggle="tab">
                                    طلبات قيد التنفيذ
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#general_three" data-toggle="tab">
                                    طلبات مكتملة
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#general_four" data-toggle="tab">
                                    طلبات ملغاة
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContentSpecial">
                            <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="general_one">
                                @foreach($publicOrders as $publicOrder)
                                @if($publicOrder->status==0)
                                <div class="media">
                                    <a href="{{route('client.private.public.orders.new',['order_id'=>$publicOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.private.public.orders.new',['order_id'=>$publicOrder->id])}}">
                                            @if(empty($publicOrder->provider->enginner_name))
                                            <h5 class="product-title">طلب عام لجميع مقدمى الخدمة</h5>
                                            @else
                                            <h5 class="product-title"> {{$publicOrder->provider->enginner_name}} </h5>
                                            @endif
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$publicOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($publicOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach



                            </div>
                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="general_two">
                                @foreach($publicOrders as $publicOrder)
                                @if($publicOrder->status==1 || $publicOrder->status==3)
                                <div class="media">
                                    <a href="{{route('client.private.public.orders.now',['order_id'=>$publicOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.private.public.orders.now',['order_id'=>$publicOrder->id])}}">
                                        @if(empty($publicOrder->provider->enginner_name))
                                            <h5 class="product-title">طلب عام لجميع مقدمى الخدمة</h5>
                                            @else
                                            <h5 class="product-title"> {{$publicOrder->provider->enginner_name}} </h5>
                                            @endif
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$publicOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($publicOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach


                            </div>
                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="general_three">
                                @foreach($publicOrders as $publicOrder)
                                @if($publicOrder->status==4)
                                <div class="media">
                                    <a href="{{route('client.private.public.orders.complete',['order_id'=>$publicOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.private.public.orders.complete',['order_id'=>$publicOrder->id])}}">
                                        @if(empty($publicOrder->provider->enginner_name))
                                            <h5 class="product-title">طلب عام لجميع مقدمى الخدمة</h5>
                                            @else
                                            <h5 class="product-title"> {{$publicOrder->provider->enginner_name}} </h5>
                                            @endif
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$publicOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($publicOrder->created_at)}} دقائق</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                            </div>
                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="general_four">
                                @foreach($publicOrders as $publicOrder)
                                @if($publicOrder->status==5)
                                <div class="media">
                                    <a href="{{route('client.private.public.orders.cancel',['order_id'=>$publicOrder->id])}}" class="product-img">
                                        <img src="{{asset('website/image/box.png')}}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{route('client.private.public.orders.cancel',['order_id'=>$publicOrder->id])}}">
                                        @if(empty($publicOrder->provider->enginner_name))
                                            <h5 class="product-title">طلب عام لجميع مقدمى الخدمة</h5>
                                            @else
                                            <h5 class="product-title"> {{$publicOrder->provider->enginner_name}} </h5>
                                            @endif
                                        </a>
                                        <p class="order-number">رقم الطلب : {{$publicOrder->id}}</p>
                                        <span class="order-time"><i class="fa fa-clock-o"></i>{{now()->diffInMinutes($publicOrder->created_at)}} دقائق</span>
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
</div>
@endsection