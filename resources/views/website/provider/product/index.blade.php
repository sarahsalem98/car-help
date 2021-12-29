@extends('layouts.website')
@section('provider.product.index')

@include('website.provider.layout.profileTop')

<!--start profile-->
<div class="profile-section">
    <div class="container">
        <div class="row">
            @include('website.provider.layout.profileMenu')
            <div class="col-xs-12 col-sm-8 profile_content">
                <div class="title__wrapper__div">
                    <h3 class="sections-title b-0 mb-15">منتجاتي</h3>
                    <a href="{{route('yield.create')}}" class="btn add__product"> <i class="fa fa-plus"></i>اضافة منتج</a>
                </div>

                <div class="products_wrapper tab-pane fade in active" role="tabpanel" id="products_wrapper">
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
                                <a href="" class="product-img">
                                    <img src="{{$providerProduct->firstImageUrl()}}">
                                </a>
                                <div class="media-body">
                                    <a href="">
                                        <h5 class="product-title"> {{$providerProduct->name}}</h5>
                                    </a>
                                    <p class="product-des">{{$providerProduct->details}}</p>
                                    <span class="price">{{$providerProduct->price}}رس</span>
                                    <div class="edit__delete__wrapper">
                                        <a class="edit__wrap" href="edit_product.html">
                                            <i class="fa fa-edit"></i>
                                            <span>تعديل</span>
                                        </a>
                                        <span>|</span>
                                        <a class="remove__wrap" href="" data-toggle="modal" data-target="#deleteConfirmModal">
                                            <i class="fa fa-trash"></i>
                                            <span>حذف</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach

                        </div>

                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection