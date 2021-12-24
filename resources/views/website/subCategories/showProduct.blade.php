@extends('layouts.website')
@section('subCategories.show.product')


<div class="inner_pages_top">
    <h3 class="inner-pages-title">تفاصيل المنتج</h3>
    <ol class="breadcrumb">
        <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li><a href="{{route('subCategories.index',['mainCategoryId'=>$mainCategory->id])}}"> {{$mainCategory->name}} </a></li>
        <li><a href="{{route('subCategories.provider.show',['mainCategory_id'=>$mainCategory->id,'provider_id'=>$provider->id ])}}">تفاصيل مزود الخدمة</a></li>
        <li class="active">تفاصيل المنتج</li>
    </ol>
</div>
<!--start about us-->
<div class="details_section">
    <div class="container">
        <div class="product-details-card">
            <div class="card-img-top">
                <img src="{{$product->firstImageUrl()}}" alt="" class="img-resposnsive">
            </div>
            <div class="product-details-body">
                <h2 class="product-details-title"> {{$product->name}}</h2>
                <div class="price-wrapper">
                    <span class="new-price">{{$product->price_after_discount}} رس</span>
                    <del class="old-price">{{$product->price}} رس</del>
                </div>
                <p class="product-des">{{$product->details}}</p>
                <h5 class="sections-title b-0">الكمية المطلوبة</h5>
                <div class="number-spinner">
                    <span class="ns-btn">
                        <a data-dir="dwn">
                            <i class="fa fa-minus"></i>
                        </a>
                    </span>
                    <input type="text" class="pl-ns-value" value="1" maxlength=2>
                    <span class="ns-btn">
                        <a data-dir="up">
                            <i class="fa fa-plus"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <a class="btn main_btn moving_bk add_to_cart" data-toggle="modal" data-target="#addtocartmodal">اضف الي السلة</a>
    </div>
</div>
<!--add to cart modal-->
<div class="modal ordersentModal fade text-center" id="addtocartmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body padding-30">
                <img src="image/check.png" alt="">
                <h2 class="order-title">تهانينا ! تم إضافة المنتجات
                    للسلة بنجاح</h2>
                <div class="btns_wrapper">
                    <a class="btn main_btn moving_bk w-40" href="cart.html">استكمال الشراء</a>
                    <a class="btn btn-default w-40" href="service_provider_details.html">منتجات أخري</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection