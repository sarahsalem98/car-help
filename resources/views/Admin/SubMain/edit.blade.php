@extends('layouts.app2')
@section('submain.edit')

<div class="container">


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title"> تفاصيل الخدمة الفرعية </h4>
            <h6 class="page-title">{{$subservice->name}}</h6>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a>
                </li>
                <li>
                    <a href="{{route('subservice.index')}}" class="btn btn-link"> الخدمات الفرعية</a>
                </li>
                <li class="active">
                    تفاصيل الخدمة الفرعية :{{$subservice->name}}
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
                            <a href="{{$subservice->photoUrl()}}"><img src="{{$subservice->photoUrl()}}" alt=""></a>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="product-right-info">
                            <h3><b>{{$subservice->name}}</b></h3>

                            <hr />
                            <hr />
                            <form role="form" method="POST" action="{{route('subservice.update',['subservice'=>$subservice->id])}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label for="">الاسم </label>
                                <input type="text" class="form-control font-900" value="{{old('name',$subservice->name ?? null)}}" placeholder="Enter name" name="name">

                                <label for=""> الاسم بالانجليزية</label>
                                <input type="text" class="form-control font-900" value="{{old('name_en',$subservice->name_en ?? null)}}" placeholder="Enter name" name="name_en">

                                <label for=""> الصورة</label>
                                <input type="file" class="form-control font-900" placeholder="Enter name" name="sub_service_photo_path">
                                <label for="">القسم الرئيسى التابع له </label>
                                <select name="service_id" class="form-select " aria-label="Default select example">
                                    <option value="{{$subservice->mainService->id}}">{{$subservice->mainService->name}}</option>
                                    @foreach($services as $service)
                                    <option name="service_id" value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>

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