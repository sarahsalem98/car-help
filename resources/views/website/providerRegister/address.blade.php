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
                    <select name="city_id" id="country" class="form-control">
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
                    <label for="country"> العنوان الاقرب</label>
                    <input type="text" class="form-control mb-3" name="address" id="address" placeholder="الرجاء ادخال المدينة">
                    <i class="fa fa-map-marker map_icon"></i>
                </div>

                <input type="hidden" name="provider_id" value={{$provider_id}}>
                lat
                <input type="hidden" name="lat" id="lat" value="lat">
                <input type="hidden" name="long" id="long" value="long">
                long


                </script>

                <div id="map"></div>


                <button type="submit" class="btn main_btn moving_bk submit_btn">التالى</button>
            </div>
        </form>
    </div>
</div>
@push('map')
<script>


map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 30,
            lng: 30
        },
        zoom: 5
    });
    
    var marker = new google.maps.Marker({
        position: {
            lat: 30,
            lng: 30
        },
        map: map,
        draggable: true
    });
var searchBox=new google.maps.places.SearchBox(document.getElementById('address'));
google.maps.event.addListener(searchBox,'places_changed' ,function(){
     var places=searchBox.getPlaces();
     var bounds=new google.maps.LatLngBounds();
     var i,place;
     for(i=0;place=places[i];i++){
         bounds.extend(place.geometry.location);
         marker.setPosition(place.geometry.location);
     }
     map.fitBounds(bounds);
     map.setZoom(15);
});
google.maps.event.addListener(marker,'position_changed',function(){
    var lat=marker.getPosition().lat();
    var lng=marker.getPosition().lng();
    $('#lat').val(lat);
    $('#long').val(lng);
});
 // now it IS a function and it is in global



    
</script>


@endpush

@endsection