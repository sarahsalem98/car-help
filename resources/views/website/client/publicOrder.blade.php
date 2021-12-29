

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
                                    <span class="check-car"></span>   سيارة مسجلة من قبل 
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#add_car" data-toggle="tab">
                                    <span class="check-car"></span>  اضافة سيارة جديدة 
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content"  id="myTabContentcars">
                            <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="prev_car">
                                <form action="" class="car_form">
                                    <div class="row">
                                        <div class="form-group col-xs-12">
                                            <label for="yourName">موديل السيارة</label>
                                            <select name="country" id="country" class="form-control">
                                                <option value="0" selected>سيارة تويوتا</option>
                                                <option value="1">سيارة مارسيدس</option>
                                                <option value="2">شيفروليه</option>
                                                <option value="3">بوغاتي</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="yourName">تفاصيل الطلب</label>
                                            <textarea class="form-control" placeholder="الرجاء كتابة تفاصيل الطلب"></textarea>
                                        </div>
                                        <div class="workshop_name col-xs-12">
                                            <img src="{{asset('website/image/drop.png')}}" alt="" class="workshop_avatar">
                                            <input type="file">
                                            <p>ارفاق صور وفيديو</p>
                                        </div>
                                        <div class="col-xs-12">
                                            <a class="btn main_btn moving_bk send_order" href="general_order_confirm.html">ارسال الطلب</a>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="products_wrapper tab-pane fade" role="tabpanel" id="add_car">
                                <form action="" class="car_form">
                                    <h5 class="sections-title mb-3 b-0">برجاء ادخال بيانات السيارة الجديدة</h5>
                                    <div class="row">
                                        <div class="form-group col-xs-12">
                                            <label for="carName">اسم السيارة</label>
                                            <input type="text" class="form-control" id="carName" placeholder="الرجاء ادخال اسم السيارة">
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="carType">نوع السيارة</label>
                                            <input type="text" class="form-control" id="carType" placeholder="الرجاء ادخال نوع السيارة">
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="yourName">تحديد السيارة</label>
                                            <select name="country" id="country" class="form-control">
                                                <option value="0" selected>سيارة تويوتا</option>
                                                <option value="1">سيارة مارسيدس</option>
                                                <option value="2">شيفروليه</option>
                                                <option value="3">بوغاتي</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="yourName">تفاصيل الطلب</label>
                                            <textarea class="form-control" placeholder="الرجاء كتابة تفاصيل الطلب"></textarea>
                                        </div>
                                        <div class="workshop_name col-xs-12">
                                            <img src="image/drop.png" alt="" class="workshop_avatar">
                                            <input type="file">
                                            <p>ارفاق صور وفيديو</p>
                                        </div>
                                        <div class="col-xs-12">
                                            <a class="btn main_btn moving_bk send_order" href="general_order_confirm.html">ارسال الطلب</a>
                                        </div>   
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection