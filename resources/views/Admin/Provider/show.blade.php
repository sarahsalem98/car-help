@extends('layouts.app2')
@section('show')
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

            <h4 class="page-title"> تفاصيل مقدم الخدمة </h4>
            <h5 class="page-title">{{$provider->enginner_name}}</h5>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a>
                </li>
                <li>
                    <a href="{{route('provider.index')}}" class="btn btn-link">مقدمى الخدمة</a>
                </li>
                <li class="active">
                    تفاصيل مقدم الخدمه :{{$provider->enginner_name}}
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
                            <a href="{{$provider->photoUrl()}}"><img src="{{$provider->photoUrl()}}" alt=""></a>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="product-right-info">
                            <h3><b>{{$provider->enginner_name}}</b></h3>
                            <div class="rating">
                                <ul class="list-inline">
                                    @for($i=0 ;$i< 5; $i++) <li><a class="fa fa-star{{$provider->rate<=$i?'-o':''}}" href=""></a></li>
                                        @endfor
                                </ul>
                            </div>
                            <hr />
                            <hr />
                            <form role="form" method="POST" action="{{route('provider.update',['provider'=>$provider])}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label for="enginner_name">الاسم</label>
                                <input type="text" class="form-control font-900" value="{{old('enginner_name',$provider->enginner_name ?? null)}}" placeholder="Enter name" name="enginner_name">

                                <label for="phone_number">رقم الجوال </label>
                                <input type="text" class="form-control font-900" value="{{old('phone_number',$provider->phone_number ?? null)}}" placeholder="Enter name" name="phone_number">

                                <label for="whatsapp_number"> رقم الواتساب</label>
                                <input type="text" class="form-control font-900" value="{{old('whatsapp_number',$provider->whatsapp_number??null)}}" placeholder="Enter name" name="whatsapp_number">

                                <label for="email">الايميل</label>
                                <input type="text" class="form-control font-9" value="{{old('email',$provider->email??null)}}" placeholder="Enter name" name="email">
                                <label for="name"> السجل التجارى</label>

                                <a href="{{$provider->registerationUrl()}}" class="btn-link">pdf.السجل التجارى الخاص بالمقدم الخدمه</a>
                                <input name="business_registeration_file" type="file" accept="application/pdf, application/vnd.ms-excel" />

                                <label for="workshop_photo_path">صورة للمكان </label>
                                <input name="workshop_photo_path" type="file" />

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

                <div class="row m-t-30">
                    <div class="col-xs-12">
                        <h4><b>تفاصيل اخرى عن مقدم الخدمه</b></h4>


                        <div class="table-responsive m-t-70">
                            <table class="table">
                                <tbody>
                                    <tr>

                                        <td class="label label-inverse">
                                            الماركات
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            @foreach($provider->brandTypes as $brand)
                                            {{$brand->name}},
                                            @endforeach
                                        </td>

                                        <td>
                                            <div id="list1" class="dropdown-check-list" tabindex="100">
                                                <span class="anchor btn-purple">تعديل الماركات</span>
                                                <ul class="items">
                                                    <form enctype="multipart/form-data" role="form" method="POST" action="{{route('brand.update',['provider'=>$provider])}}">
                                                        @csrf
                                                        @foreach($brands as $brand)
                                                        <li>
                                                            <div class="checkbox checkbox-primary">
                                                                <input id="checkbox{{$brand->id}}" type="checkbox" name="brandtyps[{{$brand->id}}]">
                                                                <label for="checkbox{{$brand->id}}">
                                                                    {{$brand->name}}
                                                                </label>
                                                            </div>
                                                        </li>
                                                        @endforeach

                                                        <li class="divider"></li>
                                                        <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>

                                                    </form>


                                                </ul>
                                            </div>
                                        </td>
<!-- 
                                        <td>
                                            <div class="panel">
                                                <p>Lorem ipsum...</p>
                                            </div>
                                        </td> -->


                                    </tr>
                                    <tr>
                                        <td class="label label-inverse">ساعات العمل</td>
                                        <td>

                                            <!-- <button type="submit" class="btn btn-purple" >تعديل ساعات العمل</button> -->
                                        </td>

                                    </tr>

                                    <form method="POST" action="{{route('workHoure.update',['provider'=>$provider])}}">
                                        @csrf
                                        @foreach($provider->workHour as $hour)
                                        <tr>
                                            <td> {{$hour->day }}</td>
                                            <td>
                                                <!-- <div class="input-group clockpicker m-b-15">
                                                    <input type="text" class="form-control "  value="{{$hour->from}}" name="from[{{$provider->id}}][{{$hour->id}}]">
                                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> from</span>
                                                </div>

                                                <div class="input-group clockpicker m-b-15">
                                                    <input type="text" class="form-control " value="{{ $hour->to }}" name="to[{{$provider->id}}][{{$hour->id}}]">
                                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> to</span>
                                                </div> -->
                                                <input type="time" class="m-wrap" value="{{$hour->from}}" name="from[{{$provider->id}}][{{$hour->id}}]">
                                                : من <br><br>
                                                <input type="time" class="m-wrap" value="{{ $hour->to }}" name="to[{{$provider->id}}][{{$hour->id}}]">
                                                : الى

                                            </td>
                                            <td>

                                                <div class="radio radio-danger radio-inline">
                                                    <input type="radio" name="closed[{{$provider->id}}][{{$hour->id}}]" id="radio{{$hour->id}}" value="1" {{($hour->closed=='1') ? 'checked' : '' }}>
                                                    <label for="radio{{$hour->id}}">
                                                        مغلق
                                                    </label>
                                                </div>
                                                <div class="radio radio-success radio-inline">
                                                    <input type="radio" name="closed[{{$provider->id}}][{{$hour->id}}]" id="radio{{$hour->id}}" value="0" {{ ($hour->closed=='0') ? 'checked' : '' }}>
                                                    <label for="radio{{$hour->id}}">
                                                        مفتوح
                                                    </label>
                                                </div>


                                            </td>



                                        </tr>
                                        @endforeach

                                        <tr>
                                            <td> </td>

                                            <td>

                                                <button type="submit" class="btn btn-purple"> تعديل ساعات العمل</button>
                                            </td>

                                        </tr>

                                    </form>


                                    <!-- <tr>
                                        <td class=" btn-warning ">العنوان </td>

                                    </tr>
                                    <tr>
                                        <td>555555 </td>

                                    </tr> -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div> <!-- end card-box/Product detai box -->
        </div> <!-- end col -->
    </div> <!-- end row -->


</div> <!-- container -->

@endsection