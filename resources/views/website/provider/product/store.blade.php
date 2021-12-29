

@extends('layouts.website')
@section('provider.product.store')

   <div class="inner_pages_top">
        <h3 class="inner-pages-title">اضافة عنوان جديد</h3>
        <ol class="breadcrumb">
            <li><a href="index.html"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li><a href="addresses.html"> منتجاتي</a></li>
            <li class="active">اضافة منتج جديد</li>
          </ol>
    </div>
     <!--start contact us-->
     <div class="login_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-10">
                    <form action="" class="address_form" >
                        <h5 class="sections-title mb-14">اضافة منتج جديد</h5>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="proName">نوع القسم</label>
                                <select class="form-control">
                                    <option value="1" selected>الرجاء ادخال نوع القسم</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="proName">اسم المنتج</label>
                                <input type="text" class="form-control" id="proName" placeholder="الرجاء ادخال اسم المنتج">
                            </div>
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="proprice">سعر المنتج</label>
                                <input type="text" class="form-control" id="proprice" placeholder="الرجاء ادخال سعر المنتج">
                            </div>
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="count">الكمية</label>
                                <input type="text" class="form-control" id="count" placeholder="الرجاء ادخال الكمية">
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="productdetails">تفاصيل المنتج</label>
                                <textarea class="form-control" placeholder="الرجاء ادخال تفاصيل المنتج"></textarea>
                            </div>
                            <div class="form-group col-xs-12">
                                <div class="dropzone__wrapper">
                                    <div class="upload__thumb">
                                        <img src="image/cloud-computing.png" alt="" class="upload__img">
                                        <span class="upload__des">ارفاق صور</span>
                                    </div>
                                    <div class="dropzone">
                                    
                                    </div>
                                </div>                             
                            </div>
                            <div class="col-xs-12">
                                <a class="btn main_btn moving_bk submit_btn" href="product_details_provider.html">تأكيد الاضافة</a>
                            </div>
                          </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
@endsection