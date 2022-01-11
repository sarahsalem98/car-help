@extends('layouts.website')
@section('provider.order.public.private.complete.show')

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
        <div class="order_details">
            <div class="order_table">
                <h5 class="sections-title"> قيمة الطلب</h5>
                <div class="order_row">
                    <i class="Fa fa-money" aria-hidden="true"></i>
                    <div class="order-name"> السعر </div>
                    <div class="order-details"> {{$service->details}}</div>
                </div>
            </div>
        </div>
        @if(empty($service->comment->rate))
        <h5 class="sections-title color_danger">لم يعلق المستخدم بعد</h5>
        @else
       
        <div class="order_details">
            <h5 class="sections-title">تعليق لمزود الخدمة</h5>
            <div class="rating_body p-10-16">
                <div class="stars_wrapper">
                    @for($i=0 ;$i < 5; $i++) 
                    
                    
                    <i class="fa fa-star star-{{$rate[$i]}} {{$service->comment->rate<=$i?'':'rated-star'}}"></i>
                   
                        @endfor
          
                </div>
                <p class="comment_des"> {{$service->comment->comment}}</p>
            </div>
        </div>

        @endif


        <!-- <div class="orders_btns">
            <form action="{{route('provider.complete,service')}}" method="POST" id="complete_form">
                @csrf
                <input type="hidden" name="service_id" value="{{$service->id}}">
                <button class="btn deliver_order">  اكتمال الطلب</button>

            </form>
            <a class="btn open_chat" href="chat.html"> <i class="fa fa-comments"></i> اجراء محادثة</a>
        </div> -->
    </div>
</div>

<!-- <div class="modal ordersentModal fade text-center" id="completModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="image/check.png" alt="">
                <h2 class="order-title mb-4"> تهانينا! تم انهاء الخدمة بنجاح </h2>
                <a class="btn main_btn moving_bk" href="{{route('main')}}">الرجوع للرئيسية</a>
            </div>
        </div>
    </div>
</div> -->
@endsection