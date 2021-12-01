@extends('layouts.app2')
@section('home.index')
<!-- Page-Title -->

<div class="container">




    <div class="row">



        <h4 class="page-title">لوحة التحكم</h4>
        <p class="text-muted page-title-alt"> مرحبا بك فى لوحة التحكم
        <p>
    </div>
</div>

<div class="row">



    <div class="col-lg-3 col-sm-6">
        <div class="widget-panel widget-style-2 bg-white">
            <i class="md md-attach-money text-primary"></i>
            <h2 class="m-0 text-dark counter font-600">{{$revenue}}</h2>
            <div class="text-muted m-t-5">العائد</div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6">
        <div class="widget-panel widget-style-2 bg-white">
            <i class="md md-add-shopping-cart text-pink"></i>
            <h2 class="m-0 text-dark counter font-600"> {{$orders}}</h2>
            <div class="text-muted m-t-5"> الطلبات المكتملة</div>
        </div>
    </div>


</div>
<div class="row  ">
    <div class="col-lg-3 ">
        <div class="widget-panel widget-style-2 bg-white">
            <i class="md md-account-child text-custom"></i>
            <h2 class="m-0 text-dark counter font-600">{{$clients}}</h2>
            <div class="text-muted m-t-5">العملاء</div>
        </div>
    </div>
    <div class="col-lg-3 ">
        <div class="widget-panel widget-style-2 bg-white">
            <i class="md md-store-mall-directory text-info"></i>
            <h2 class="m-0 text-dark counter font-600">{{$providers }}</h2>
            <div class="text-muted m-t-5">مقدمى الخدمة </div>
        </div>
    </div>
</div>





<!-- end col -->


@endsection