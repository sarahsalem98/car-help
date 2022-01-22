@extends('layouts.website')
@section('client.public.order')

<div class="inner_pages_top">
    <h3 class="inner-pages-title">طلب عام</h3>
    <ol class="breadcrumb">
        <li><a href="index.html"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li class="active">طلب عام</li>
    </ol>
</div>
<!--start categories-->
<div class="general_order">
    <div class="about-us-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-8">
                    <h5 class="sections-title b-0">بيانات الطلب</h5>
                    <h5 class="sections-title b-0">اختر سيارة</h5>
                    <ul class="nav nav-pills cars-pills">
                        <li class="nav-item active">
                            <a class="nav-link" href="#prev_car" data-toggle="tab">
                                <span class="check-car"></span> سيارة مسجلة من قبل
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#add_car" data-toggle="tab">
                                <span class="check-car"></span> اضافة سيارة جديدة
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContentcars">
                        <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="prev_car">
                            <form id="form_order" method="POST" action="{{route('public.private.order.post')}}" enctype="multipart/form-data" class="car_form">
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <input type="hidden" name="provider_id" value="">
                                        <input type="hidden" name="order_type" value="0">

                                        <label for="yourName">موديل السيارة</label>
                                        <select name="car_id" id="country" class="form-control">
                                            <option value="" selected> الرجا اختيار سيارة</option>
                                            @foreach($clientCars as $clientCar)
                                            <option value="{{$clientCar->id}}"> {{$clientCar->name}}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="yourName">تفاصيل الطلب</label>
                                        <textarea class="form-control" name="details" placeholder="الرجاء كتابة تفاصيل الطلب"></textarea>
                                    </div>
                                    <div class="workshop_name col-xs-12">
                                        <img src="{{asset('website/image/drop.png')}}" id="mg" alt="" class="workshop_avatar">
                                        <div class="preview">
                                        </div>
                                        <input type="file" name="images[]" multiple="multiple" id="file-input">
                                        <p>ارفاق صور وفيديو</p>
                                    </div>
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn main_btn moving_bk send_order" href="general_order_confirm.html">ارسال الطلب</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="products_wrapper tab-pane fade" role="tabpanel" id="add_car">
                            <form action="{{route('public.private.car.order.post')}}" id="form_car_order" method="POST" enctype="multipart/form-data" class="car_form">
                                <h5 class="sections-title mb-3 b-0">برجاء ادخال بيانات السيارة الجديدة</h5>
                                <div class="row">
                                    <input type="hidden" name="provider_id" value="">
                                    <input type="hidden" name="order_type" value="0">
                                    <div class="form-group col-xs-12">
                                        <label for="carName">اسم السيارة</label>
                                        <input type="text" class="form-control" id="carName" name="name" placeholder="الرجاء ادخال اسم السيارة">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="carType">نوع السيارة</label>
                                        <input type="text" class="form-control" id="carType" name="type" placeholder="الرجاء ادخال نوع السيارة">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="carType"> رقم الهيكل</label>
                                        <input type="text" class="form-control" id="carType" name="chassis_number" placeholder="الرجاء ادخال نوع السيارة">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="yourName">تحديد السيارة</label>
                                        <select name="model_id" id="country" class="form-control">
                                            <option value="" selected> الرجا اختيار سيارة</option>
                                            @foreach($carModels as $carModel)
                                            <option value="{{$carModel->id}}"> {{$carModel->name}}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="yourName">تفاصيل الطلب</label>
                                        <textarea class="form-control" name="details" placeholder="الرجاء كتابة تفاصيل الطلب"></textarea>
                                    </div>
                                    <div class="workshop_name col-xs-12">
                                        <img src="{{asset('website/image/drop.png')}}" alt="" class="workshop_avatar">
                                        <div class="preview">
                                        </div>
                                        <input type="file" name="images[]" multiple="multiple" id="file-input2">
                                        <p>ارفاق صور وفيديو</p>
                                    </div>
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn main_btn moving_bk send_order" href="general_order_confirm.html">ارسال الطلب</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal ordersentModal fade text-center" id="ordersentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body padding-30">
                                        <img src="image/check.png" alt="">
                                        <h2 class="order-title">تهانينا ! تم ارسال طلبك بنجاح</h2>
                                        <p class="order-des">سوف تتلقى اشعارا عند قيام مقدم الخدمة
                                            بعرض سعر عليك</p>
                                        <a class="btn main_btn moving_bk" href="{{route('main')}}">الرجوع للرئيسية</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection