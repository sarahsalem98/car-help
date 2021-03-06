@extends('layouts.website')
@section('provider.order.public.private.show')

<div class="inner_pages_top">
    <h3 class="inner-pages-title"> </h3>
    <ol class="breadcrumb">
        <li><a href="index.html"> <i class="flaticon-home"></i> {{__('main')}}</a></li>
        <li><a href="provider_profile.html"> {{__('profile')}}</a></li>
        <li class="active"> {{__('order details')}}</li>
    </ol>
</div>
<!--start order details-->
<div class="profile-section">
    <div class="container">
        @include('website.alertSuccess')
        @include('website.more',['field'=>'price'])
        <h5 class="sections-title b-0"> {{__('order details')}}</h5>
        <div class="order_details">
            <h5 class="sections-title">{{__('order details')}} </h5>
            <div class="order_table">
                <div class="order_row">
                    <div class="order-name"> {{__('order number')}}</div>
                    <div class="order-details">{{$service->id}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">  {{__('order date')}}</div>
                    <div class="order-details"> {{$service->created_at->toDateString()}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name"> {{__('car name')}} </div>
                    <div class="order-details">{{$service->car->name}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name"> {{__('car type')}} </div>
                    <div class="order-details"> {{$service->car->type}} </div>
                </div>
                <div class="order_row">
                    <div class="order-name"> {{__('car model')}}</div>
                    <div class="order-details">{{$service->car->carModel->name}} </div>
                </div>
                <div class="order_row">
                    <div class="order-name"> {{__('chassis number')}}</div>
                    <div class="order-details">{{$service->car->chassis_number}}</div>
                </div>
                <div class="order_row">
                    <div class="order-name">  {{__('order details')}} </div>
                    <div class="order-details"> {{$service->details}}</div>
                </div>
            </div>
        </div>

        <div class="order_details">
            <h5 class="sections-title">?????????????? ????????????????</h5>
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
            
        <div class="sections-title color_danger">
            <h1 center>   ?????? ?????????? ?????? ????????????</h1>
        </div>
        @else
        <div class="sent__price__offer">
            <h5 class="sections-title">?????????? ?????? ??????</h5>
            <form action="{{route('provider.price.send',['service_id'=>$service->id])}}" method="POST" id="price_form" class="address_form">
                @csrf
                <div class="row">
                    <input type="hidden" name="provider_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="order_id" value="{{$service->id}}">

                    <div class="form-group col-xs-12 col-lg-8">
                        <label for="proprice">?????? ??????????</label>
                        <input type="text" name="price" class="form-control" id="proprice" placeholder="???????????? ?????????? ??????????">
                        @include('website.more',['field'=>'price'])

                    </div>
                    <div class="form-group col-xs-12 col-lg-8">
                        <label for="productdetails">??????????????</label>
                        <textarea name="notes" class="form-control" placeholder="???? ???????? ???????? ??????????????"></textarea>
                    </div>
                    <!-- <div class="form-group col-xs-12 col-lg-8">
                            <div class="dropzone__wrapper">
                                <div class="upload__thumb">
                                    <img src="image/cloud-computing.png" alt="" class="upload__img">
                                    <span class="upload__des">?????????? ??????</span>
                                </div>
                                <div class="dropzone">
                                
                                </div>
                            </div>                             
                        </div> -->
                    <div class="form-group col-xs-12 col-lg-8">
                        <input type="hidden" name="viewing_price" value="0">
                        <input type="checkbox" name="viewing_price" value="1">
                        ?????? ????????????????
                    </div>
                    <div class="orders_btns col-xs-12 col-lg-8">
                        <button type="submit" class="btn main_btn moving_bk deliver_order">?????????? ??????????</button>
                        <a class="btn main_btn moving_bk cancel_order" data-toggle="modal" data-target="#cancelModal">?????? ??????????</a>
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
            <h2 class="modal-bold-title">?????????? ?????????? ?????? ?????? ??????????</h2>
            <form action="{{route('provider.cancellation.reasons.post')}}" method="POST" id="cancel_form" class="modal-body">
                <div id="cancelReasonError" class="alert-danger"> </div>
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
                    <button type="submit" class="btn main_btn moving_bk w-40" >??????????</button>
                    <a class="btn btn-default w-40" href="{{route('provider.service.show',['service_id'=>$service->id])}}"> ??????????</a>
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
                <h2 class="order-title mb-4"> ???? ?????????? ?????? ?????????? ?????????? </h2>
                <a class="btn main_btn moving_bk" href="{{route('main')}}">???????????? ????????????????</a>
            </div>
        </div>
    </div>
</div>
@endsection