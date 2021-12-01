@extends('layouts.app2')
@section('whoWeAre.index')






<div class="container">

    <!-- Page-Title -->
    @include('Admin.modals.updateWhoWeAre')
    @include('Admin.modals.updateWhoWeAreEN')


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
            <h4 class="page-title"> المزيد </h4>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a></li>
                <li class="active"> من نحن </li>
            </ol>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-6">

            <div class="mini-stat clearfix card-box">
                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                <span class="label label-pink">  من نحن بالعربية</span>
                <p>{{$whoWeAre->who_are_we}}
                </p>
                <p>
                    <!-- <button type="button" class="btn btn-info waves-effect waves-light">Wanna do this</button> -->
                    <!-- <a href="#update-howToUse" type="button" class="btn btn-purple waves-effect">تعديل  </a> -->
                    <a href="#update-whoWeAre" class="btn btn-inverse btn-md waves-effect waves-light m-b-0 m-t-15  btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>
                </p>
            </div>
        </div>
        <div class="col-sm-6">

            <div class="mini-stat clearfix card-box">
                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                <span class="label label-pink">  من نحن بالانجليزية</span>
                <p>{{$whoWeAre->who_are_we_en}}
                </p>
                <p>
                    <!-- <button type="button" class="btn btn-info waves-effect waves-light">Wanna do this</button> -->
                    <!-- <a href="#update-howToUse" type="button" class="btn btn-purple waves-effect">تعديل  </a> -->
                    <a href="#update-whoWeAreEn" class="btn btn-inverse btn-md waves-effect waves-light m-b-0 m-t-15  btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>
                </p>
            </div>
        </div>

    </div>
    @endsection