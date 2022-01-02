@extends('layouts.website')
@section('provider.order.product.new.show')


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
                    <div class="order-details">#{{$order->id}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">عنوان التسليم</div>
                    <div class="order-details"> {{$order->address->address}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">رقم الجوال</div>
                    <div class="order-details">{{$order->client->phone_number}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">طريقة الدفع</div>
                    <div class="order-details"> {{$order->payement_method}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">تاريخ الطلب</div>
                    <div class="order-details"> {{$order->created_at}}</div>
                </div>
            </div>
        </div>
        <div class="order_details">
            <h5 class="sections-title">المنتجات</h5>
            @foreach($order->product as $product)
            <div class="product_row">

                <div class="product-name">
                    <span class="pro-name">{{$product->name}}</span>
                    <span class="pro-price">{{$product->pivot->total_price}} رس </span>
                </div>
                <div class="order-details">الكمية : {{$product->pivot->qty}}</div>
            </div>
            @endforeach

        </div>
        <div class="order_summary">
            <h5 class="sections-title">ملخص الطلب</h5>
            <div class="product_row b-0">

                <div class="value-name">قيمة المنتجات</div>
                <div class="order-num"> {{$total_price}}</div>
            </div>
            <div class="product_row b-0">
                <div class="value-name">قيمة الضريبة {{$commession['commission']}} %</div>
                <div class="order-num"> {{$commession_price}} رس</div>
            </div>
            <div class="product_row value-sum b-0">
                <div class="value-name">المجموع</div>
                <div class="order-num">{{round($final_price)}}رس</div>
            </div>
        </div>
        <div class="order_details">
            <h5 class="sections-title">معلومات المستخدم</h5>
            <div class="provider-media">
                @if($order->client->photoUrl()==null)
                <img src="image/most.png" alt="" class="provider-img">

                @else
                <img src="{{$order->client->photoUrl()}}" alt="" class="provider-img">

                @endif

                <div class="card-body">
                    <h3 class="card-title"> {{$order->client->name}}</h3>
                    <div class="card-address">
                        <i class="fa fa-map-marker"></i>
                        <span> {{$order->address->address}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="orders_btns">
            <form action="{{route('provider.order.is.accepted.show.post',['order_id'=>$order->id])}}" method="POST">
                @csrf
                <button type="submit" class="btn moving_bk accept__order__btn">قبول الطلب</button>

            </form>
            <a class="btn main_btn moving_bk cancel_order" data-toggle="modal" data-target="#cancelModal2">رفض الطلب</a>
        </div>
    </div>
</div>
<!--cancel order modal-->
<div class="modal ordersentModal fade " id="cancelModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h2 class="modal-bold-title">برجاء ادخال سبب رفض الطلب</h2>
            <form action="{{route('provider.cancellation.reasons.post')}}" method="POST" id="cancel_form2" class="modal-body">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="provider_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="order_id" value="{{$order->id}}">
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
                        <a class="btn btn-default w-40" href="order_details_provider_2.html"> تراجع</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--add to cart modal-->
<div class="modal ordersentModal fade text-center" id="confirmModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="image/check.png" alt="">
                <h2 class="order-title mb-4"> تم ارسال سبب رفض الطلب بنجاح </h2>
                <a class="btn main_btn moving_bk" href="index_second.html">الرجوع للرئيسية</a>
            </div>
        </div>
    </div>
</div>
@endsection