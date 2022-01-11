@extends('layouts.website')
@section('client.profile.orders.public.private.complete')



<!--start page top section-->
<div class="inner_pages_top">
    <h3 class="inner-pages-title">تفاصيل الطلب</h3>
    <ol class="breadcrumb">
        <li><a href="index.html"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li><a href="profile.html">الملف الشخصي</a></li>
        <li class="active">تفاصيل الطلب</li>
    </ol>
</div>
<!--start order details-->
<div class="profile-section">
    <div class="container">
        <h5 class="sections-title b-0">تفاصيل الطلب</h5>
        <div class="order_details">
            <h5 class="sections-title">تفاصيل الطلب</h5>
            <div class="order_table">
                <div class="order_row">
                    <div class="order-name">رقم الطلب</div>
                    <div class="order-details">#{{$order->id}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">تاريخ الطلب</div>
                    <div class="order-details"> {{$order->created_at}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">اسم السيارة</div>
                    <div class="order-details">{{$order->car->name}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">نوع السيارة</div>
                    <div class="order-details"> {{$order->car->type}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">موديل السيارة</div>
                    <div class="order-details">{{$order->car->carModel->name}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name"> رقم الهيكل</div>
                    <div class="order-details">{{$order->car->chassis_number}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">تفاصيل الطلب</div>
                    <div class="order-details">{{$order->details}} </div>
                </div>
            </div>
        </div>
        <div class="order_details">
            <h5 class="sections-title">معلومات مزود الخدمة</h5>
            <div class="provider-media">
                <img src="{{$order->provider->photoUrl()}}" alt="" class="provider-img">
                <div class="card-body">
                    <h3 class="card-title">{{$order->provider->enginner_name}} </h3>
                    <div class="card-address">
                        <i class="fa fa-map-marker"></i>
                        @if(empty($order->provider->address[0]->address))
                        <span> no address found</span>
                        @else
                        <span>{{$order->provider->address[0]->address}}</span>
                        @endif
                    </div>
                </div>
                <div class="provider-rating">

                    @for($i=0 ;$i < 5; $i++) <i class="fa fa-star star-{{$rate[$i]}} {{$order->provider->rate<=$i?'':'rated-star'}}"></i>

                        @endfor


                </div>
            </div>
        </div>
        <div class="order_details">
            <h5 class="sections-title">تعليقك لمزود الخدمة</h5>
            <div class="rating_body p-10-16">
                <div class="stars_wrapper">
                    @for($i=0 ;$i < 5; $i++) <i class="fa fa-star star-{{$rate[$i]}} {{$order->comment->rate<=$i?'':'rated-star'}}"></i>

                        @endfor
                </div>
                <p class="comment_des">{{$order->comment->comment}}</p>
            </div>
        </div>
        <div class="orders_btns">
            <!-- <a class="btn open_chat" href="chat_order_completed.html"> <i class="fa fa-comments"></i> مشاهدة المحادثة</a> -->
        </div>
    </div>
</div>



@endsection