@extends('layouts.website')
@section('client.favourite.providers')
<div class="inner_pages_top">
    <h3 class="inner-pages-title"> المفضلة</h3>
    <ol class="breadcrumb">
        <li><a href="{{route('main')}}"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li class="active">المفضلة</li>
    </ol>
</div>
<!--start categories-->
<div class="categry-details">
    <div class="container">
        <div class="row">
            @foreach($providers as $provider)
            <div class="col-xs-12 col-sm-6 col-md-3">
                @include('website.layoutProvider')
            </div>
           @endforeach
        </div>
    </div>
</div>
@endsection