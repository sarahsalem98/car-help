@extends('layouts.website')
@section('provider.order.product.is.prepared')



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
            <form id="isDeliverdForm" action="{{route('provider.order.is.delivered.show.post')}}" method="POST">
                @csrf
             <input type="hidden" name="order_id" value="{{$order->id}}">
                <button type="submit" class="btn deliver_order" >تم تسليم الطلب</button>
            </form>
            <!-- <a class="btn open_chat" href="chat.html"> <i class="fa fa-comments"></i> اجراء محادثة</a> -->
        </div>


    </div>
</div>
<div class="modal ordersentModal fade text-center" id="isDeliveredModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="fa fa-times"></i>
       </button>
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-body padding-30">      
                   <img src="image/check.png" alt="">
                   <h2 class="order-title mb-4">  تهانينا تم تسليم الطلب بنجاح </h2>
                   <a class="btn main_btn moving_bk" href="index_second.html">الرجوع للرئيسية</a>
               </div>
           </div>
       </div>
    </div>
<!--cancel order modal-->


<!--add to cart modal-->



@endsection