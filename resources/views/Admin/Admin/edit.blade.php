@extends('layouts.app2')
@section('Admin.edit')
<div class="container">

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <!-- <div class="btn-group pull-right m-t-15">
                <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                <ul class="dropdown-menu drop-menu-right" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div> -->

            <h4 class="page-title"> تفاصيل الادمن </h4>
            <h5 class="page-title">{{$admin->name}}</h5>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a>
                </li>
                <li>
                    <a href="{{route('admin.index')}}" class="btn btn-link"> الادمنز</a>
                </li>
                <li class="active">
                    تفاصيل الادمن :{{$admin->name}}
                </li>
            </ol>
        </div>
    </div>
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
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="card-box product-detail-box">
                <div class="row">


                    <div class="col-sm-8">
                        <div class="product-right-info">
                            <h3><b>{{$admin->name}}</b></h3>

                            <hr />
                            <hr />
                            <form role="form" method="POST" action="{{route('admin.update',['admin'=>$admin->id])}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label for="enginner_name">الاسم</label>
                                <input type="text" class="form-control font-900" value="{{old(' name',$admin->name ?? null)}}" placeholder="Enter name" name="name">

                                <label for="phone_number">الايميل </label>
                                <input type="text" class="form-control font-900" value="{{old('email',$admin->email ?? null)}}" placeholder="Enter name" name="email">
                                
                                <label for="phone_number">الرقم السرى </label>
                                <input type="text" class="form-control font-900" value="{{old('password',$admin->password ?? null)}}" placeholder="Enter name" name="password">
                                <label for="position"> تحديد وظيفة الادمن</label>
                                <select name="super_admin" class="form-select m-t-10" aria-label="Default select example">
                                    <option value="{{$admin->super_admin==1}}">@if($admin->super_admin==1)
                                        ادمن
                                        @else
                                        ادمن مساعد
                                        @endif</option>

                                    <option name="super_admin" value="1">ادمن</option>
                                    <option name="super_admin" value="0">ادمن مساعد</option>
                                </select>





                                <!-- <input type="hidden" class="form-control font-9" value="{{old('id',$provider->id??null)}}" placeholder="Enter name" name="id"> -->
                                <div class="m-t-20">
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-l-10">
                                        تعديل</button>
                                      

                                </div>
                            </form>





                        </div>
                    </div>
                </div>
                <!-- end row -->



            </div> <!-- end card-box/Product detai box -->
        </div> <!-- end col -->
    </div> <!-- end row -->


</div> <!-- container -->

@endsection