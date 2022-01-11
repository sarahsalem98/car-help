@extends('layouts.website')
@section('client.profile.orders.public.private.cancel')


<div class="inner_pages_top">
    <h3 class="inner-pages-title">تفاصيل الطلب</h3>
    <ol class="breadcrumb">
        <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li><a href="profile.html">الملف الشخصي</a></li>
        <li class="active">تفاصيل الطلب</li>
    </ol>
</div>
<!--start order details-->
<div class="profile-section">
    <div class="container">
        <h5 class="sections-title b-0">تفاصيل الطلب</h5>
        <div class="order_details">
            <h5 class="sections-title color_danger">سبب الالغاء</h5>
            <div class="delete_body px-16 pb-16">
                <p>{{empty($order->clientCancel->reason->name) ? $order->providerCancel->reason->name :$order->clientCancel->reason->name }}  </p>
            </div>
        </div>
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
    </div>
</div>

@endsection