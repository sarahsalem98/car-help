@extends('layouts.app2')
@section('commession.index')






<div class="container">

    <!-- Page-Title -->
    @include('Admin.Modals.updateCommession')

    
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session()->has('message'))

    <!-- <a class="btn btn-info waves-effect waves-light autohidebut" href="javascript:;" onclick="$.Notification.autoHideNotify('info', 'top right', 'I will be closed in 5 seconds...','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci ut dolor scelerisque aliquam.')">Info</a> -->
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif






    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title"> المزيد</h4>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a></li>
                <li class="active"> العمولة </li>
            </ol>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-4">
            <div class="mini-stat clearfix card-box">
                <span class="mini-stat-icon bg-info"><i class="ion-social-usd text-white"></i></span>
                <div class="mini-stat-info text-right text-dark">
                    <span class=" text-dark" >{{$commission->commission}} ريال سعودى</span>
                   العمولة
                </div>
                <!-- <button class="btn btn-inverse m-t-20">تعديل </button> -->
                <a href="#update-commession" class="btn btn-inverse btn-md waves-effect waves-light  m-t-20  btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>


            </div>
        </div>
    </div>
</div>
@endsection