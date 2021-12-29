
@extends('layouts.website')
@section('client.cart')

 <div class="inner_pages_top">
        <h3 class="inner-pages-title">سلة المشتريات</h3>
        <ol class="breadcrumb">
            <li><a href="index.html"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li class="active">سلة المشتريات</li>
        </ol>
    </div>
     <!--start about us-->
     <div class="cart_page_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-8 products_wrapper">
                    <h5 class="sections-title b-0">المنتجات</h5>
                    <div class="media">
                        <a href="product_details.html" class="product-img">
                            <img src="image/pro.png">
                        </a>
                        <div class="media-body">
                            <a href="product_details.html"><h5 class="product-title"> منتج 1</h5></a>
                            <span class="price">20.00 رس</span>
                            <div class="number-spinner">
                                <span class="ns-btn">
                                    <a data-dir="dwn">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                </span>
                                <input type="text" class="pl-ns-value" value="2" maxlength=2>
                                <span class="ns-btn">
                                     <a data-dir="up">
                                        <i class="fa fa-plus"></i>
                                      </a>
                                </span>
                            </div> 
                        </div>
                    </div>
                    <div class="media">
                        <a href="product_details.html" class="product-img">
                            <img src="image/pro.png">
                        </a>
                        <div class="media-body">
                            <a href="product_details.html"><h5 class="product-title"> منتج 1</h5></a>
                            <span class="price">20.00 رس</span>
                            <div class="number-spinner">
                                <span class="ns-btn">
                                    <a data-dir="dwn">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                </span>
                                <input type="text" class="pl-ns-value" value="2" maxlength=2>
                                <span class="ns-btn">
                                     <a data-dir="up">
                                        <i class="fa fa-plus"></i>
                                      </a>
                                </span>
                            </div> 
                        </div>
                    </div>
                    <div class="media">
                        <a href="product_details.html" class="product-img">
                            <img src="image/pro.png">
                        </a>
                        <div class="media-body">
                            <a href="product_details.html"><h5 class="product-title"> منتج 1</h5></a>
                            <span class="price">20.00 رس</span>
                            <div class="number-spinner">
                                <span class="ns-btn">
                                    <a data-dir="dwn">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                </span>
                                <input type="text" class="pl-ns-value" value="2" maxlength=2>
                                <span class="ns-btn">
                                     <a data-dir="up">
                                        <i class="fa fa-plus"></i>
                                      </a>
                                </span>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4 products_price_wrapper">
                    <h5 class="sections-title ">ملخص الطلب</h5>
                    <div class="products-table">
                        <div class="products-row">
                            <div class="value-name">قيمة المنتجات</div>
                            <div class="value-num">15 رس</div>
                        </div>
                        <div class="products-row">
                            <div class="value-name">قيمة الضريبة 10 %</div>
                            <div class="value-num">15 رس</div>
                        </div>
                        <div class="products-row value-sum">
                            <div class="value-name">المجموع</div>
                            <div class="value-num">30 رس</div>
                        </div>
                    </div>
                    <a class="btn main_btn moving_bk send_order" data-toggle="modal" data-target="#confirmModal">تأكيد الشراء</a>
                </div>
                <div class="col-xs-12  col-lg-8 shipping_to_wrapper">
                    <h5 class="sections-title ">الشحن الي</h5>
                    <div class="user-table">
                        <h5 class="user-name">خالد على</h5>
                        <p class="user-address">شارع الصندوق الأسود , الرياض, المملكة العربية السعودية</p>
                        <div class="info-div">
                            <a href="#" class="user-phone">0096548796413</a>
                            <a href="addresses.html" class="change-address"> <i class="fa fa-edit"></i> تغيير العنوان</a>
                        </div>
                    </div>
                   
                </div>
                <div class="col-xs-12  col-lg-8 payment_methods">
                    <h5 class="sections-title ">طريقة الدفع</h5>   
                    <div class="payment-visa">
                        <span class="visa-check"></span>
                        <input type="radio" id="visa" name="visa" value="visa">
                        <img src="image/visa.png" alt="" class="visa-img">
                        <div class="visa-info">
                            <h5 class="visa-name">اسم الفيزا</h5>
                            <p class="visa-des">هذا النص هو مثال بمكن أن يستبدل بنص اخر في نفس المساحة</p>
                        </div>
                    </div>
                    <div class="payment-visa">
                        <span class="visa-check"></span>
                        <input type="radio" id="master" name="visa" value="visa">
                        <img src="image/visa2.png" alt="" class="visa-img">
                        <div class="visa-info">
                            <h5 class="visa-name">اسم الفيزا</h5>
                            <p class="visa-des">هذا النص هو مثال بمكن أن يستبدل بنص اخر في نفس المساحة</p>
                        </div>
                    </div>
                    <div class="payment-visa">
                        <span class="visa-check"></span>
                        <input type="radio" id="mada" name="visa" value="visa">
                        <img src="image/visa3.png" alt="" class="visa-img">
                        <div class="visa-info">
                            <h5 class="visa-name">اسم الفيزا</h5>
                            <p class="visa-des">هذا النص هو مثال بمكن أن يستبدل بنص اخر في نفس المساحة</p>
                        </div>
                    </div>
                    <div class="payment-visa">
                        <span class="visa-check"></span>
                        <input type="radio" id="pay" name="visa" value="visa">
                        <img src="image/visa4.png" alt="" class="visa-img">
                        <div class="visa-info">
                            <h5 class="visa-name">اسم الفيزا</h5>
                            <p class="visa-des">هذا النص هو مثال بمكن أن يستبدل بنص اخر في نفس المساحة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
     <!--add to cart modal-->
     <div class="modal ordersentModal fade text-center" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">      
                        <img src="image/check.png" alt="">
                        <h2 class="order-title">تهانينا ! تم ارسال طلبك بنجاح </h2>
                        <p class="order-des">يمكنك متابعة طلبك من خانة طلباتى</p>
                        <a class="btn main_btn moving_bk" href="index_second.html">الرجوع للرئيسية</a>
                    </div>
                </div>
            </div>
     </div>
     @endsection