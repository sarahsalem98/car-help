@extends('layouts.app2')
@section('main.edit')

<div class="container">


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title"> تفاصيل الخدمة الرئيسة </h4>
            <h6 class="page-title">{{$service->name}}</h6>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a>
                </li>
                <li>
                    <a href="{{route('service.index')}}" class="btn btn-link"> الخدمات الرئيسة</a>
                </li>
                <li class="active">
                    تفاصيل الخدمة الرئيسة :{{$service->name}}
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
                    <div class="col-sm-4">

                        <div class="sp-wrap">
                            <a href="{{$service->photoUrl()}}"><img src="{{$service->photoUrl()}}" alt=""></a>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="product-right-info">
                            <h3><b>{{$service->name}}</b></h3>

                            <hr />
                            <hr />
                            <form role="form" method="POST" action="{{route('service.update',['service'=>$service->id])}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label for="">الاسم </label>
                                <input type="text" class="form-control font-900" value="{{old('name',$service->name ?? null)}}" placeholder="Enter name" name="name">

                                <label for=""> الاسم بالانجليزية</label>
                                <input type="text" class="form-control font-900" value="{{old('name_en',$service->name_en ?? null)}}" placeholder="Enter name" name="name_en">

                                <label for=""> الصورة</label>
                                <input type="file" class="form-control font-900" placeholder="Enter name" name="service_photo_path">

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