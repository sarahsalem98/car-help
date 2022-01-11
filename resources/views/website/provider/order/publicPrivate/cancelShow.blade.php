@extends('layouts.website')
@section('provider.order.public.private.cancel.show')

<div class="inner_pages_top">
    <h3 class="inner-pages-title">تفاصيل الطلب</h3>
    <ol class="breadcrumb">
        <li><a href="index.html"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li><a href="provider_profile.html">الملف الشخصي</a></li>
        <li class="active">تفاصيل الطلب</li>
    </ol>
</div>
<!--start order details-->
<div class="profile-section">
    <div class="container">
        <h5 class="sections-title b-0">تفاصيل الطلب</h5>
        <div class="order_details">
            @if(empty($service->clientCancel->reason->name))
            <h5 class="sections-title color_danger"> سبب الالغاء من قبل مقدم الخدمة</h5>
            @else
            <h5 class="sections-title color_danger"> سبب الالغاء من قبل العميل</h5>
            @endif
            <div class="delete_body px-16 pb-16">
            <p>{{empty($service->clientCancel->reason->name) ? $service->providerCancel->reason->name :$service->clientCancel->reason->name }}  </p>
            </div>
        </div>

        <div class="order_details">
            <h5 class="sections-title">تفاصيل الطلب</h5>
            <div class="order_table">
                <div class="order_row">
                    <div class="order-name">رقم الطلب</div>
                    <div class="order-details">{{$service->id}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name"> تاريخ الطلب</div>
                    <div class="order-details"> {{$service->created_at->toDateString()}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">اسم السيارة </div>
                    <div class="order-details">{{$service->car->name}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">نوع السيارة </div>
                    <div class="order-details"> {{$service->car->type}} </div>
                </div>
                <div class="order_row">
                    <div class="order-name"> موديل السيارة</div>
                    <div class="order-details">{{$service->car->carModel->name}} </div>
                </div>
                <div class="order_row">
                    <div class="order-name"> رقم الهيكل</div>
                    <div class="order-details">{{$service->car->chassis_number}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name"> تفاصيل الطلب </div>
                    <div class="order-details"> {{$service->details}}</div>
                </div>
            </div>
        </div>

        <div class="order_details">
            <h5 class="sections-title">معلومات المستخدم</h5>
            <div class="provider-media">
                @if($service->client->photoUrl()==null)
                <img src="{{asset('website/image/most.png')}}" alt="" class="provider-img">
                @else
                <img src="{{$service->client->photoUrl()}}" alt="" class="provider-img">
                @endif
                <div class="card-body">
                    <h3 class="card-title"> {{$service->client->name}}</h3>
                    <div class="card-address">
                        <i class="fa fa-map-marker"></i>
                        <span> {{$service->client->city->name}} </span>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>


@endsection