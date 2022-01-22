@extends('layouts.website')
@section('subCategories.show.provider')
<div class="inner_pages_top">
    <h3 class="inner-pages-title">تفاصيل مزود الخدمة</h3>
    <ol class="breadcrumb">
        <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li><a href="{{route('subCategories.index',['mainCategoryId'=>$mainCategory->id])}}"> {{$mainCategory->name}} </a></li>
        <li class="active">تفاصيل مزود الخدمة</li>
    </ol>
</div>
<!--start categories-->
<div class="main-section provider-details">
    <div class="about-us-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-8 about-us-info">
                    <h5 class="sections-title">نبذه عنا</h5>
                    <p class="info-p">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا
                        النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق</p>
                    <p class="info-p">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من
                        مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى</p>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4 provider-info">
                    <h5 class="sections-title">معلومات مزود الخدمة</h5>
                    @include('website.layoutProvider')

                </div>
                <div class="col-xs-12 col-lg-8 work-times">
                    <h5 class="sections-title">أوقات العمل</h5>
                    <div class="time-table">
                        <div class="work-row">
                            <div class="work-day">{{$provider->workHour[0]->day}}</div>
                            <div class="work-hours">
                                @if($provider->workHour[0]->closed==0)
                                <span>{{$provider->workHour[0]->from}} </span>
                                <i class="fa fa-angle-double-left"></i>
                                <span>{{$provider->workHour[0]->to}} </span>
                                @else
                                <span class="closed">مغلق</span>
                                @endif
                            </div>
                            <button class="toggle-table">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>
                        @foreach($provider->workHour as $key=> $time)
                        @if($key==0)
                        @else
                        <div class="work-row">
                            <div class="work-day">{{$time->day}}</div>
                            <div class="work-hours">
                                @if($time->closed==0)
                                <span>{{$time->from}}</span>
                                <i class="fa fa-angle-double-left"></i>
                                <span>{{$time->to}}</span>
                                @else
                                <span class="closed">مغلق</span>
                                @endif
                            </div>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
                <div class="col-xs-12 col-lg-8 work-times">
                    <h5 class="sections-title">الخدمات</h5>
                    <div class="services-wrapper">
                        @foreach($provider->subServices as $subservice)
                        <div class="one-service"> {{$subservice->name}}</div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-lg-8 work-times">
                    <h5 class="sections-title">الماركات</h5>
                    <div class="services-wrapper">
                        @foreach($provider->brandTypes as $brandType)
                        <div class="one-service"> <img src="{{$brandType->photoUrl()}}" alt=""> {{$brandType->name}} </div>
                        @endforeach
                    </div>

                </div>


                <!-- <div class="col-xs-12 col-lg-8 work-times">
                    <h5 class="sections-title">الجنسيات</h5>
                    <div class="services-wrapper">
                        <div class="one-service">سعودي</div>
                        <div class="one-service">مصري</div>
                        <div class="one-service">اماراتي</div>
                    </div>
                </div> -->
                <div class="col-xs-12 col-lg-8 products-order-wrapper">
                    <ul class="nav nav-pills">
                        <li class="nav-item active">
                            <a class="nav-link" href="#products_wrapper" data-toggle="tab">
                                المنتجات
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#orders_wrapper" data-toggle="tab">
                                اجراء طلب
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContentwrapper">
                        <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="products_wrapper">
                            @if($productOfProviderInCart==1 || $cart==0)
                            <form action="{{route('client.cart.add')}}" method="POST">
                                @csrf
                                <ul class="nav nav-pills products-pills">
                                    @foreach($productCategories as $key=> $productCategory)
                                    <li class="nav-item @if($key==0) active @endif">
                                        <a class="nav-link" href="#product_{{$key+1}}" data-toggle="tab">
                                            {{$productCategory->name}}
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                                <div class="tab-content" id="myTabContentproducts">
                                    @foreach($productCategories as $key=> $productCategory)
                                    <div class="products_wrapper tab-pane fade in @if($key==0) active @endif" role="tabpanel" id="product_{{$key+1}}">
                                        @foreach($providerProducts as $providerProduct)
                                        @if($providerProduct->category_id ==$key+1)
                                        <div class="media">
                                            <a href="{{route('client.product.show',['product_id'=>$providerProduct->id,'mainCategory_id'=>$mainCategory->id,'provider_id'=>$provider->id])}}" class="product-img">
                                                <img src="{{$providerProduct->firstImageUrl()}}">
                                            </a>
                                            <div class="media-body">

                                                <a href="{{route('client.product.show',['product_id'=>$providerProduct->id,'mainCategory_id'=>$mainCategory->id,'provider_id'=>$provider->id])}}">
                                                    <h5 class="product-title"> {{$providerProduct->name}}</h5>
                                                </a>

                                                <p class="product-des">{{$providerProduct->details}}</p>
                                                <span class="price">{{$providerProduct->price}}رس</span>
                                                <input type="hidden" name="product_id[]" value="{{$providerProduct->id}}">
                                                <div class="number-spinner">
                                                    <span class="ns-btn">
                                                        <a data-dir="dwn">
                                                            <i class="fa fa-minus"></i>
                                                        </a>
                                                    </span>
                                                    <input type="text" name="qty[]" class="pl-ns-value" value="0" maxlength=2>
                                                    <span class="ns-btn">
                                                        <a data-dir="up">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach

                                    </div>

                                    @endforeach
                                </div>
                                <button type="submit" class="btn main_btn moving_bk next-btn"> التالى </button>
                            </form>
                            @elseif($productOfProviderInCart==null)
                         
                            <ul class="nav nav-pills products-pills">
                                @foreach($productCategories as $key=> $productCategory)
                                <li class="nav-item @if($key==0) active @endif">
                                    <a class="nav-link" href="#product_{{$key+1}}" data-toggle="tab">
                                        {{$productCategory->name}}
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                            <div class="tab-content" id="myTabContentproducts">
                                @foreach($productCategories as $key=> $productCategory)
                                <div class="products_wrapper tab-pane fade in @if($key==0) active @endif" role="tabpanel" id="product_{{$key+1}}">
                                    @foreach($providerProducts as $providerProduct)
                                    @if($providerProduct->category_id ==$key+1)
                                    <div class="media">
                                        <a href="{{route('client.product.show',['product_id'=>$providerProduct->id,'mainCategory_id'=>$mainCategory->id,'provider_id'=>$provider->id])}}" class="product-img">
                                            <img src="{{$providerProduct->firstImageUrl()}}">
                                        </a>
                                        <div class="media-body">

                                            <a href="{{route('client.product.show',['product_id'=>$providerProduct->id,'mainCategory_id'=>$mainCategory->id,'provider_id'=>$provider->id])}}">
                                                <h5 class="product-title"> {{$providerProduct->name}}</h5>
                                            </a>

                                            <p class="product-des">{{$providerProduct->details}}</p>
                                            <span class="price">{{$providerProduct->price}}رس</span>
                                            <input type="hidden" name="product_id[]" value="{{$providerProduct->id}}">
                                            <div class="number-spinner">
                                                <span class="ns-btn">
                                                    <a data-dir="dwn">
                                                        <i class="fa fa-minus"></i>
                                                    </a>
                                                </span>
                                                <input type="text" name="qty[]" class="pl-ns-value" value="0" maxlength=2>
                                                <span class="ns-btn">
                                                    <a data-dir="up">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach

                                </div>

                                @endforeach
                            </div>
                            <a data-toggle="modal" data-target="#cart" class="btn main_btn moving_bk next-btn"> التالى </a>
                            <!-- <a class="remove__wrap" href="" data-toggle="modal" data-target="#deleteConfirmModal">
                                            <i class="fa fa-trash"></i>
                                            <span>حذف</span>
                                        </a> -->
                            @endif

                        </div>
                        <div class="orders_wrapper tab-pane fade" role="tabpanel" id="orders_wrapper">
                            <h5 class="sections-title">اختر سيارة</h5>
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
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="provider_id" value="{{$provider->id}}">
                                            <input type="hidden" name="order_type" value="1">

                                            <div class="form-group col-xs-12">
                                                <label for="yourName">تحديد السيارة</label>
                                                <select name="car_id" id="country" class="form-control">
                                                    <option value="" selected> الرجا اختيار سيارة</option>
                                                    @foreach($clientCars as $clientCar)
                                                    <option value="{{$clientCar->id}}"> {{$clientCar->name}}</option>

                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label for="yourName">تفاصيل الطلب</label>
                                                <textarea name="details" class="form-control" placeholder="الرجاء كتابة تفاصيل الطلب"></textarea>
                                            </div>
                                            <div class="workshop_name col-xs-12">
                                                <img src="{{asset('website/image/drop.png')}}" id="mg" alt="" class="workshop_avatar">
                                                <div class="preview">
                                                </div>
                                                <input type="file" name="images[]" multiple="multiple" id="file-input">
                                                <p>ارفاق صور وفيديو</p>
                                            </div>
                                            <div class="col-xs-12">
                                                <button type="submit" class="btn main_btn moving_bk send_order">ارسال الطلب</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="products_wrapper tab-pane fade" role="tabpanel" id="add_car">
                                    <form action="{{route('public.private.car.order.post')}}" id="form_car_order" method="POST" enctype="multipart/form-data" class="car_form">
                                        @csrf
                                        <h5 class="sections-title mb-3 b-0">برجاء ادخال بيانات السيارة الجديدة</h5>
                                        <div class="row">
                                            <input type="hidden" name="provider_id" value="{{$provider->id}}">
                                            <input type="hidden" name="order_type" value="1">
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
                                                <input type="text" class="form-control" name="chassis_number" id="carType" placeholder="الرجاء ادخال رقم الهيكل ">
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
                                                <textarea name="details" class="form-control" placeholder="الرجاء كتابة تفاصيل الطلب"></textarea>
                                            </div>
                                            <div class="workshop_name col-xs-12">
                                                <img src="{{asset('website/image/drop.png')}}" alt="" class="workshop_avatar">
                                                <div class="preview">
                                                </div>
                                                <input type="file" name="images[]" multiple="multiple" id="file-input2">
                                                <p>ارفاق صور وفيديو</p>
                                            </div>
                                            <div class="col-xs-12">
                                                <button type="submit" class="btn main_btn moving_bk send_order">ارسال الطلب</button>
                                            </div>



                                        </div>
                                    </form>
                                </div>
                                <!--order sent modal-->
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
    </div>
</div>

<div class="modal ordersentModal fade text-center" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('client.cart.provider.delete')}}" method="POST">
              @csrf


              <div class="modal-body padding-30">
                  <img src="{{asset('website/image/ask.png')}}" alt="">
  
                  <h2 class="order-title">    يوجد فى السلة منتجات لمقدم خدمة اخر هل تريد حذفها قبل اضافةاخر؟</h2>
        <!-- <input type="hidden" name="qty" value="5"> -->
                  <div class="btns_wrapper">
  
                      <button type="submit" class="btn main_btn moving_bk w-40" >نعم</button>
                      <button class="btn btn-default w-40" data-dismiss="modal" aria-label="Close">تراجع</button>
                  </div>
  
              </div>

            </form>
        </div>
    </div>
</div>

@push('modal')
<script>
    function SelectChange() {

        if (!$("#b").src) {
            $("#mg").hide();
        } else {
            $("#mg").show();
        }
    }
</script>
@endpush
@endsection