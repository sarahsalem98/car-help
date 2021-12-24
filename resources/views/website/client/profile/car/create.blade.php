


@extends('layouts.website')
@section('client.profile.cars.create')
 <div class="inner_pages_top">
        <h3 class="inner-pages-title">اضافة سيارة</h3>
        <ol class="breadcrumb">
            <li><a href="route('main')"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li><a href="{{route('cars.index')}}"> سياراتي</a></li>
            <li class="active">اضافة سيارة جديدة</li>
          </ol>
    </div>
     <!--start contact us-->
     <div class="login_section">
        <div class="container edit_address_wapper">
            <h5 class="sections-title mb-14">اضافة سيارة جديدة</h5>
            @include('website.allErrors')
           
            <div class="row">
                <div class="col-xs-12 col-lg-10">
                    <form action="{{route('cars.store')}}" method="POST" class="address_form">  
                        @csrf
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="carName">اسم السيارة</label>
                                <input type="text" class="form-control" name="name" id="carName" placeholder="الرجاء ادخال اسم السيارة">
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="carType">نوع السيارة</label>
                                <input type="text" class="form-control" name="type" id="carType" placeholder="الرجاء ادخال نوع السيارة">
                            </div>

                            <div class="form-group col-xs-12">
                                <label for="carType"> رقم الهيكل</label>
                                <input type="text" class="form-control" name="chassis_number" id="carType" placeholder="الرجاء ادخال  رقم الهيكل">
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="carModel">موديل السيارة</label>
                                <select  name="model_id" id="carModel" class="form-control">
                                    <option  value="" selected>برجاء تحديد موديل السيارة</option>
                                    @foreach($carModels as $carModel)
                                    <option value="{{$carModel->id}}">{{$carModel->name}}</option>
                                    @endforeach
                               
                                </select>    
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn main_btn moving_bk submit_btn" href="my_cars.html">اضافة</button>
                            </div>
                          </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
     @endsection