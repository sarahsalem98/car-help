@extends('layouts.app2')
@section('others.index')





@include('Admin.modals.others.updateEmail')
@include('Admin.modals.others.updateFaceBook')
@include('Admin.modals.others.updatePhone')
@include('Admin.modals.others.updateGoogle')
@include('Admin.modals.others.updateLocation')
@include('Admin.modals.others.updateTwitter')
@include('Admin.modals.others.updateYoutube')

<div class="container">

    <!-- Page-Title -->



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
                <li class="active"> السوشيال ميديا وجهات الاتصال </li>
            </ol>
        </div>
    </div>


    <div class="row">
       
       <div class="col-lg-4 col-sm-6">
           <div class="widget-panel widget-style-2 bg-white">
               <i class=" glyphicon glyphicon-earphone"></i>
               <h2 class="m-0 text-dark  font-600">{{$others->phone}}</h2>

               <a href="#update-phone" class="btn btn-inverse btn-md waves-effect waves-light   btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>
           </div>
       </div>
      
       <div class="col-lg-4 col-sm-6">
           <div class="widget-panel widget-style-2 bg-white">
               <i class="  glyphicon glyphicon-globe"></i>
               <h2 class="m-0 text-dark  font-600"> {{$others->location}} </h2>

               <a href="#update-location" class="btn btn-inverse btn-md waves-effect waves-light   btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>
           </div>
       </div>
       <div class="col-lg-4 col-sm-6">
           <div class="widget-panel widget-style-2 bg-white">
               <i class="glyphicon glyphicon-envelope"></i>
               <h2 class="m-0 text-dark  font-600">{{$others->email}}</h2>

             
               <a href="#update-email" class="btn btn-inverse btn-md waves-effect waves-light   btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>

           </div>
       </div>
      
   </div>


    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="fa fa-facebook"></i>
                <h2 class="m-0 text-dark  font-600">   {{$others->facebook}}</h2>
                <a href="#update-facebook" class="btn btn-facebook waves-effect waves-light   btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>

            </div>

        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="fa fa-youtube"></i>
                <h2 class="m-0 text-dark  font-600">  {{$others->youtube}} </h2>

                <a href="#update-youtube" class="btn btn-youtube waves-effect waves-light  btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="fa fa-google-plus "></i>
                <h2 class="m-0 text-dark  font-600">  {{$others->google}}</h2>
                <a href="#update-google" class="btn btn-googleplus waves-effect waves-light  btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>

            </div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="fa fa-twitter"></i>
                <h2 class="m-0 text-dark  font-600"> {{$others->twitter}}</h2>
           
                <a href="#update-twitter" class="btn btn-twitter waves-effect waves-light  btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"> تعديل </a>

            </div>
        </div>
    </div>
  
</div>
@endsection