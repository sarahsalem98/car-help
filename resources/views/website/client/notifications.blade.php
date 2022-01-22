@extends('layouts.website')
@section('client.notifications')
<div class="inner_pages_top">
    <h3 class="inner-pages-title">الاشعارات</h3>
    <ol class="breadcrumb">
        <li><a href="index.html"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li class="active">الاشعارات</li>
    </ol>
</div>

<!--start categories-->
<div class="categry-details">
    <div class="container">
        <div class="row">
            @foreach($notifications as $notification)
            <div class="col-xs-12">
                @if($notification->order_type==0 || $notification->order_type==1)
                @if($notification->order->status==0)
                <a href="{{route('client.private.public.orders.new',['order_id'=>$notification->order_id])}}" class="notification_media">
                    @elseif($notification->order->status==1 ||$notification->order->status==3)
                    <a href="{{route('client.private.public.orders.now',['order_id'=>$notification->order_id])}}" class="notification_media">
                        @elseif($notification->order->status==4 )
                        <a href="{{route('client.private.public.orders.complete',['order_id'=>$notification->order_id])}}" class="notification_media">
                            @else
                            <a href="{{route('client.private.public.orders.cancel',['order_id'=>$notification->order_id])}}" class="notification_media">
                                @endif
                                <div class="noti-img">
                                    <img src="{{asset('website/image/bell.png')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <h5 class="notification-title">{{$notification->title}}</h5>
                                    <h5 class="notification-body">{{$notification->body}}</h5>
                                    <div class="notification-time"> <i class=" fa fa-clock-o"></i> <span>منذ {{now()->diffInMinutes($notification->created_at)}} دقائق</span> </div>
                                </div>
                            </a>


                            @elseif($notification->order_type==2)
                            @if($notification->order->status==0)
                            <a href="{{route('client.product.orders.new.show',['order_id'=>$notification->order_id])}}" class="notification_media">
                                @elseif($notification->order->status==1 ||$notification->order->status==3)
                                <a href="{{route('client.product.orders.now.show',['order_id'=>$notification->order_id])}}" class="notification_media">
                                    @elseif($notification->order->status==4 )
                                    <a href="{{route('client.product.orders.complete.show',['order_id'=>$notification->order_id])}} " class="notification_media">
                                        @else
                                        <a href="{{route('client.product.orders.cancel.show',['order_id'=>$notification->order_id])}}" class="notification_media">
                                            @endif
                                            <div class="noti-img">
                                                <img src="{{asset('website/image/bell.png')}}" alt="">
                                            </div>
                                            <div class="media-body">
                                                <h5 class="notification-title">{{$notification->title}}</h5>
                                                <h5 class="notification-body">{{$notification->body}}</h5>
                                                <div class="notification-time"> <i class=" fa fa-clock-o"></i> <span>منذ {{now()->diffInMinutes($notification->created_at)}} دقائق</span> </div>
                                            </div>
                                        </a>



                                        @endif
            </div>
            @endforeach



        </div>
    </div>
</div>

@endsection