@extends('layouts.website')
@section('provider.order.public.private.show')

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
    @include('website.alertSuccess')
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
  
        @if($service->providerHasPrice(Auth::user()->id))

        <div class="sent__price__offer">
            <h1 center>   لقد ارسلت سعر بالفعل</h1>
        </div>


 

        @else
        <div class="sent__price__offer">
            <h5 class="sections-title">ارسال عرض سعر</h5>
            <form action="{{route('provider.price.send',['service_id'=>$service->id])}}" method="POST" id="price_form" class="address_form">
                @csrf
                <div class="row">
                    <input type="hidden" name="provider_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="order_id" value="{{$service->id}}">

                    <div class="form-group col-xs-12 col-lg-8">
                        <label for="proprice">سعر الطلب</label>
                        <input type="text" name="price" class="form-control" id="proprice" placeholder="الرجاء ادخال السعر">
                    </div>
                    <div class="form-group col-xs-12 col-lg-8">
                        <label for="productdetails">ملاحظات</label>
                        <textarea name="notes" class="form-control" placeholder="في حالة وجود ملاحظات"></textarea>
                    </div>
                    <!-- <div class="form-group col-xs-12 col-lg-8">
                            <div class="dropzone__wrapper">
                                <div class="upload__thumb">
                                    <img src="image/cloud-computing.png" alt="" class="upload__img">
                                    <span class="upload__des">ارفاق صور</span>
                                </div>
                                <div class="dropzone">
                                
                                </div>
                            </div>                             
                        </div> -->
                    <div class="form-group col-xs-12 col-lg-8">
                        <input type="hidden" name="viewing_price" value="0">
                        <input type="checkbox" name="viewing_price" value="1">
                        سعر المعاينة
                    </div>
                    <div class="orders_btns col-xs-12 col-lg-8">
                        <button type="submit" class="btn main_btn moving_bk deliver_order">ارسال السعر</button>
                        <a class="btn main_btn moving_bk cancel_order" data-toggle="modal" data-target="#cancelModal">رفض الطلب</a>
                    </div>
                </div>
            </form>
        </div>
   
        @endif

    </div>
</div>
<!--cancel order modal-->
<div class="modal ordersentModal fade " id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h2 class="modal-bold-title">برجاء ادخال سبب رفض الطلب</h2>
            <form action="{{route('provider.cancellation.reasons.post')}}" method="POST" id="cancel_form" class="modal-body">
                 @csrf
                 <input type="hidden" name="provider_id" value="{{Auth::user()->id}}">
                 <input type="hidden" name="order_id" value="{{$service->id}}">
                @foreach($cacellationReasons as $cacellationReason)


                <div class="reason_radio">
                    <label>
                        <input type="radio" value="{{$cacellationReason->id}}" name="cancel_id">
                        {{$cacellationReason->name}}
                    </label>
                </div>
                @endforeach
                <div class="btns_wrapper">
                    <button type="submit" class="btn main_btn moving_bk w-40" >ارسال</button>
                    <a class="btn btn-default w-40" href="{{route('provider.service.show',['service_id'=>$service->id])}}"> تراجع</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--add to cart modal-->
<div class="modal ordersentModal fade text-center" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="image/check.png" alt="">
                <h2 class="order-title mb-4"> تم ارسال سبب الرفض بنجاح </h2>
                <a class="btn main_btn moving_bk" href="{{route('main')}}">الرجوع للرئيسية</a>
            </div>
        </div>
    </div>
</div>
@endsection