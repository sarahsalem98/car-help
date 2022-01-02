
@extends('layouts.website')
@section('provider.product.show')


 <div class="inner_pages_top">
        <h3 class="inner-pages-title">تفاصيل المنتج</h3>
        <ol class="breadcrumb">
            <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
            <li><a href="{{route('yield.index')}}">منتجاتي</a></li>
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
                    <span class="wanted__count">{{$product->qty}}</span>
                </div>
            </div>
            <div class="orders_btns">
                <a class="btn main_btn moving_bk deliver_order" href="{{route('yield.edit',['yield'=>$product->id])}}">تعديل المنتج</a>
                <a class="btn main_btn moving_bk cancel_order" data-toggle="modal" data-target="#deleteConfirmModal">حذف المنتج</a>
            </div>
            
        </div>
     </div>
     <!--delete product modal-->
     <div class="modal ordersentModal fade text-center" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{route('yield.destroy',['yield'=>$product->id])}}" method="POST" > 
                      @csrf
                      @method('DELETE')
                        <div class="modal-body padding-30">      
                            <img src="{{asset('website/image/ask.png')}}" alt="">
                            <h2 class="order-title">هل تريد حذف المنتج</h2>
                           <div class="btns_wrapper">
                            <button type="submit" class="btn main_btn moving_bk w-40" >نعم</button>
                            <a class="btn btn-default w-40" href="{{route('yield.show',['yield'=>$product->id])}}">تراجع</a>
                           </div>
                        </div>
                    </form>
                </div>
            </div>
     </div>
     @endsection