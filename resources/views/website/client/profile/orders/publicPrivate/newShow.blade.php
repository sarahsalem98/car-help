@extends('layouts.website')
@section('client.profile.orders.public.private.new')

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
        @if(empty($order->price[0]->price))
      
        <h5 class="sections-title color_danger"> لا يوجد عرض سعر بعد</h5>
        @else
    
        
        <div class="order_details mb-4">
            <h5 class="sections-title"> عروض الاسعار</h5>
            @foreach($order->price as $price)
            <div class="provider-media">
                <img src="{{$price->provider->photoUrl()}}" alt="" class="provider-img">
                <div class="card-body">
                    <h3 class="card-title">{{$price->provider->enginner_name}}</h3>
                    <div class="card-address">
                        <i class="fa fa-map-marker"></i>
                        <span>{{$price->provider->address[0]->address}}</span>
                    </div>
                    <div class="card-price">
                        <i class="icon-money"></i>
                        <span>
                            <span>السعر : </span>
                            <span>{{$price->price}}</span>
                        </span>
                    </div>
                </div>
                <div class="provider-rating">

                    @for($i=0 ;$i < 5; $i++) <i class="fa fa-star star-{{$rate[$i]}} {{$price->provider->rate<=$i?'':'rated-star'}}"></i>

                        @endfor
                </div>

            </div>
            <div class="provider_btn">
                <form action="{{route('client.order.accept.price')}}" method="POST">
                    @csrf
                    <input type="hidden" name="price_id" value="{{$price->id}}" >
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <button type="submit" class="btn btn-success accept_order" >قبول</button>
                </form>
                <form action="{{route('client.order.refuse.price')}}" method="POST">
                    @csrf
                    <input type="hidden" name="price_id" value="{{$price->id}}">
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <button type="submit" class="btn btn-warning">رفض</button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
        <div class="col-xs-12">
            <a class="btn btn-danger cancel_order" data-toggle="modal" data-target="#cancelModal">الغاء الطلب</a>
        </div>
        <div class="col-xs-12">
            <a class="btn btn-warning complete_order" data-toggle="modal" data-target="#rateModal">انتهاء الطلب</a>
        </div>
    </div>
</div>
<!--cancel order modal-->
<div class="modal ordersentModal fade " id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h2 class="modal-bold-title">برجاء ادخال سبب الالغاء</h2>
            <form action="{{route('client.cancellation.reasons.post')}}" method="POST" id="cancel_client_form">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="client_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    @foreach($cancellationReasons as $cancellationReason)
                    <div class="reason_radio">
                        <label>
                            <input type="radio" value="{{$cancellationReason->id}}" name="cancel_id">
                            {{$cancellationReason->name}}
                        </label>
                    </div>
                    @endforeach


                    <div class="btns_wrapper">
                        <button class="btn main_btn moving_bk w-40" >ارسال</button>
                        <a class="btn btn-default w-40" href="order_details.html"> تراجع</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--confirm modal-->
<div class="modal ordersentModal fade text-center" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body padding-30">
                <img src="image/check.png" alt="">
                <h2 class="order-title mb-4"> تم ارسال سبب الالغاء بنجاح </h2>
                <a class="btn main_btn moving_bk" href="index_second.html">الرجوع للرئيسية</a>
            </div>
        </div>
    </div>
</div>

<!--rate modal-->
<div class="modal ordersentModal fade text-center" id="rateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body padding-50">
                <img src="image/provider.png" alt="" class="provider-modal-img">
                <h2 class="modal-title">اسم مقدم الخدمة</h2>
                <div class="rate_wrapper">
                    <i class="fa fa-star star-one"></i>
                    <i class="fa fa-star star-two"></i>
                    <i class="fa fa-star star-three"></i>
                    <i class="fa fa-star star-four"></i>
                    <i class="fa fa-star star-five"></i>
                </div>
                <input type="text" class="form-control mb-2" id="rate-numbers" value="0">
                <p class="rate-p">من فضلك قم بتقييم مقدم الخدمة</p>
                <textarea class="form-control rating_desc"></textarea>
                <div class="btns_wrapper mt-20">
                    <a class="btn main_btn moving_bk w-40" data-dismiss="modal" data-toggle="modal" data-target="#confirmRateModal">ارسال</a>
                    <a class="btn btn-default w-40" href="special_order_details.html"> تراجع</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--confirm rate modal-->
<div class="modal ordersentModal fade text-center" id="confirmModalCancelClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{asset('website/image/check.png')}}" alt="">
                <h2 class="order-title mb-4"> تم ارسال سبب الالغاء بنجاح </h2>
                <a class="btn main_btn moving_bk" href="index_second.html">الرجوع للرئيسية</a>
            </div>
        </div>
    </div>
</div>
@endsection