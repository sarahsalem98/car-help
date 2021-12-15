@extends('layouts.website')
@section('provider.register.address')
<div class="inner_pages_top">
    <h3 class="inner-pages-title">انشاء حساب</h3>
    <ol class="breadcrumb">
        <li><a href="index.html"> <i class="flaticon-home"></i> الرئيسية</a></li>
        <li class="active">انشاء حساب</li>
    </ol>
</div>
<!--start contact us-->
<div class="login_section">
    <div class="container">
        <form action="{{route('provider.register.address.post')}}" method="POST" class="login_form">
            @csrf
            <h3 class="main-pages-title">انشاء حساب</h3>
            <p class="main-center-des">سجل بياناتك من اجل انشاء حساب جديد</p>
            <div class="row">
                <div class="form-group col-xs-12">
                    <label for="yourName">المدينة</label>
                    <select name="country" id="country" class="form-control">
                        <option value="" selected>الرجاء ادخال المدينة</option>
                        @foreach($cities as $city)
                        @if(app()->getLocale()=='ar')
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @else
                        <option value="{{$city->id}}">{{$city->name_en}}</option>
                        @endif

                        @endforeach
                    </select>
                </div>
                <div class="form-group col-xs-12">
                    <label for="country">المدينة</label>
                    <input type="text" class="form-control mb-3" id="country" placeholder="الرجاء ادخال المدينة">
                    <i class="fa fa-map-marker map_icon"></i>
                </div>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsGwp19k_0lr31Hnyos-OPLdJ9FwTO6k4&callback=initMap">google.maps.event.addDomListener(window,'load', initMap);</script>                <div id="map"></div>


                <button type="submit" class="btn main_btn moving_bk submit_btn">تأكيد</button>
            </div>
        </form>
    </div>
</div>
@push('map')
<script>
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: -34.397,
            lng: 150.644
        },
        zoom: 11
    });
</script>


@endpush

@endsection