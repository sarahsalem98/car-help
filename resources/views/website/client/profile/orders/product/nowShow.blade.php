@extends('layouts.website')
@section('client.profile.orders.product.now')


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
        <ul class="order_process_steps">
            <li class="ui-step done">
                <a class="one_step">
                    <i class="fa fa-check"></i>
                </a>
                <span>تم الاستلام</span>
            </li>
            @if($order->status==2||$order->status==3)
            <li class="ui-step done">
                <a class="one_step">
                    <i class="fa fa-check"></i>
                </a>
                <span>تم التجهيز</span>
            </li>
            @else
            <li class="ui-step">
                <a class="one_step">
                    <i class="fa fa-check"></i>
                </a>
                <span>تم التجهيز</span>
            </li>
            @endif
            @if($order->status==3)
            <li class="ui-step done">
                <a class="one_step">
                    <i class="fa fa-check"></i>
                </a>
                <span>تم التسليم</span>
            </li>
            @else
            <li class="ui-step">
                <a class="one_step">
                    <i class="fa fa-check"></i>
                </a>
                <span>تم التسليم</span>
            </li>
            @endif

        </ul>
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

       @if($order->status==3)
        <div class="orders_btns">
            <a class="btn deliver_order" data-toggle="modal" data-target="#rateModal1"> استلام الطلب والتعليق للمقدم الخدمة</a>
            <!-- <a class="btn open_chat" href="chat.html"> <i class="fa fa-comments"></i> اجراء محادثة</a> -->
        </div>
        @endif
    </div>
</div>


<!--rate modal-->
<div class="modal ordersentModal fade text-center" id="rateModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body padding-50">
                <img src="{{$order->provider->photoUrl()}}" alt="" class="provider-modal-img">
                <h2 class="modal-title"> {{$order->provider->enginner_name}}</h2>
                <form action="{{route('client.add.comment.rate')}}" method="POST" id="form_rate" >
                    @csrf
                    <input type="hidden" name="provider_id" value="{{$order->provider->id}}">
                    <input type="hidden" name="order_id" value="{{$order->id}}" >
                    <div class="rate_wrapper">
                        <i class="fa fa-star star-one"></i>
                        <i class="fa fa-star star-two"></i>
                        <i class="fa fa-star star-three"></i>
                        <i class="fa fa-star star-four"></i>
                        <i class="fa fa-star star-five"></i>
                    </div>
                    <input type="text" class="form-control mb-2" id="rate-numbers" name="rate" value="0">
                    <p class="rate-p">من فضلك قم بتقييم مقدم الخدمة</p>
                    <textarea name="comment" class="form-control rating_desc"></textarea>
                    <div class="btns_wrapper mt-20">
                        <button type="submit" class="btn main_btn moving_bk w-40" >ارسال</button>
                        <a class="btn btn-default w-40" href="special_order_details.html"> تراجع</a>
                    </div>
                </form>
                </div>
        </div>
    </div>
</div>

<!--confirm rate modal-->
<div class="modal ordersentModal fade text-center" id="confirmRateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body padding-30">
                <img src="image/check.png" alt="">
                <h2 class="order-title mb-4"> تهانينا تم اضافة تقييمك بنجاح </h2>
                <a class="btn main_btn moving_bk" href="index_second.html">الرجوع للرئيسية</a>
            </div>
        </div>
    </div>
</div>



@endsection