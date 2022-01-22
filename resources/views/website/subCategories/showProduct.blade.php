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
        @if($productOfProviderInCart==1 || $cart==0)
        <form id="add_to_cart_form" action="{{route('client.product.cart.add')}}" method="POST">
            @csrf
            <div class="product-details-card">
                <div class="card-img-top">
                    <img src="{{$product->firstImageUrl()}}" alt="" class="img-resposnsive">
                </div>
                <div class="product-details-body">
                    <input type="hidden" name="product_id" value="{{$product->id}}">

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
                        <input type="text" name="qty" class="pl-ns-value" value="0" maxlength=2>
                        <span class="ns-btn">
                            <a data-dir="up">
                                <i class="fa fa-plus"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <button class="btn main_btn moving_bk add_to_cart">اضف الي السلة</button>
        </form>
        @elseif($productOfProviderInCart==null)

        <div class="product-details-card">
            <div class="card-img-top">
                <img src="{{$product->firstImageUrl()}}" alt="" class="img-resposnsive">
            </div>
            <div class="product-details-body">
                <input type="hidden" name="product_id" value="{{$product->id}}">

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
                    <input type="text" name="qty" class="pl-ns-value" value="0" maxlength=2>
                    <span class="ns-btn">
                        <a data-dir="up">
                            <i class="fa fa-plus"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <a  data-toggle="modal" data-target="#cart" class="btn main_btn moving_bk add_to_cart">اضف الي السلة</a>
        @endif
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
                    <a class="btn main_btn moving_bk w-40" href="{{route('client.cart.show')}}">استكمال الشراء</a>
                    <a class="btn btn-default w-40" href="{{route('categories')}}"> متابعة التسوق</a>
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

                    <h2 class="order-title"> يوجد فى السلة منتجات لمقدم خدمة اخر هل تريد حذفها قبل اضافةاخر؟</h2>
                    <!-- <input type="hidden" name="qty" value="5"> -->
                    <div class="btns_wrapper">

                        <button type="submit" class="btn main_btn moving_bk w-40">نعم</button>
                        <button class="btn btn-default w-40" data-dismiss="modal" aria-label="Close">تراجع</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

@endsection