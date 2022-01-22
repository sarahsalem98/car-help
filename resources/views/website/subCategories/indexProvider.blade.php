@extends('layouts.website')
@section('subCategories.index')


<div class="inner_pages_top">
    <h3 class="inner-pages-title">{{$mainCategory->name}} </h3>
    <ol class="breadcrumb">
        <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li class="active"> {{$mainCategory->name}}</li>
    </ol>
</div>
<!--start categories-->
<div class="main-section categry-details">
    <div class="cate_top_wrapper container">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="search-wrapper">
                    <form action="" class="inner-search-form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 form-group">
                                <input type="search" class="form-control" placeholder="ابحث عم تريد">
                                <i class="fa fa-search"></i>
                            </div>
                            <div class="col-xs-12 col-sm-4 form-group">
                                <select id="choose_cat" class="form-control nice-select">
                                    <option value="">اختر القسم</option>
                                    @foreach($subCategories as $subCategory)
                                    <option value="{{$subCategory->id}}"> {{$subCategory->name}}</option>
                                    @endforeach
                                </select>
                                <i class="flaticon-menu"></i>
                            </div>
                            <div class="col-xs-12 col-sm-4 form-group">
                                <select id="filter_with" class="form-control nice-select">
                                    <option value="volvo">فلتر حسب</option>
                                    <option value="saab">Saab</option>
                                    <option value="opel">Opel</option>
                                    <option value="audi">Audi</option>
                                </select>
                                <i class="icon-filter"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <ul class="nav nav-pills">
                    <li class="nav-item active">
                        <a class="nav-link" href="#provider_wrapper" data-toggle="tab">
                            <i class="flaticon-menu"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#map_wrapper" data-toggle="tab">
                            <i class="flaticon-map"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content container" id="myTabContent">
        <div class="provider_wrapper tab-pane fade in active" role="tabpanel" id="provider_wrapper">
            <div class="row">
                @foreach($providers as $provider)
                <div class="col-xs-12 col-sm-6 col-md-3">

                    @include('website.layoutProvider')
                </div>
                @endforeach
            </div>
        </div>
        <div class="map_wrapper tab-pane fade" role="tabpanel" id="map_wrapper">
            @foreach($addresses as $index=>$address)
            <input type="text" id="lat_{{$index}}" value="{{$address->lat}}" />
            <input type="text" id="long_{{$index}}" value="{{$address->long}}" />
            @endforeach

            <input type="text" id="total" value="{{$addressesCount}}"/>
            <div class="check_wrapper">
                <div class="checkbox service_checkbox">
                    <label>
                        <input type="checkbox" value="" name="service">
                        <span class="check_yellow check_green"></span>
                        الصيانة العامة
                    </label>
                </div>
                <div class="checkbox service_checkbox">
                    <label>
                        <input type="checkbox" value="" name="service">
                        <span class="check_yellow check_blue"></span>
                        العيادات الخارجية
                    </label>
                </div>
                <div class="checkbox service_checkbox">
                    <label>
                        <input type="checkbox" value="" name="service">
                        <span class="check_yellow check_orange"></span>
                        التجميل والتزيين
                    </label>
                </div>
                <div class="checkbox service_checkbox">
                    <label>
                        <input type="checkbox" value="" name="service">
                        <span class="check_yellow"></span>
                        الصيانة العامة
                    </label>
                </div>
            </div>
            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.650859370141!2d46.64176368475698!3d24.738863956212338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2ee36823527cdb%3A0x67b0574b6b8f0d27!2sMCIT!5e0!3m2!1sar!2seg!4v1632406153544!5m2!1sar!2seg" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
            <div id="map2"></div>
        </div>
    </div>
</div>
@endsection