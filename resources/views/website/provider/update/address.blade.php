@extends('layouts.website')
@section('provider.address.update')
@include('website.provider.layout.profileTop')

<div class="profile-section">
    <div class="container">
        <div class="row">
            @include('website.provider.layout.profileMenu')
            @include('website.alertSuccess')
            <div class="col-xs-12 col-sm-9 profile_content">

                <form action="{{route('provider.address.update.post',['address_id'=>$address->id])}}" method="POST" class="login_form w-100">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="yourName">المدينة</label>
                            <select name="city_id" id="country" class="form-control">
                                <option value="{{$address->city_id}}" selected>  {{$address->city->name}}</option>
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
                            <input type="text" class="form-control mb-3" value="{{$address->address}}" name="address" id="address" placeholder="الرجاء ادخال المدينة">
                            <i class="fa fa-map-marker map_icon"></i>
                        </div>
                        <div id="map"></div>

                        lat
                        <input type="hidden" name="lat" id="lat" value="{{$address->lat}}">
                        <input type="hidden" name="long" id="long" value="{{$address->long}}">
                        long


                        <!-- </script> -->

                       


                        <button type="submit" class="btn main_btn moving_bk submit_btn">التالى</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('map')
<script>
//     map = new google.maps.Map(document.getElementById('map'), {
//         center: {
//             lat: 30,
//             lng: 30
//         },
//         zoom: 5
//     });

//     var marker = new google.maps.Marker({
//         position: {
//             lat: 30,
//             lng: 30
//         },
//         map: map,
//         draggable: true
//     });
//     var searchBox = new google.maps.places.SearchBox(document.getElementById('address'));
//     google.maps.event.addListener(searchBox, 'places_changed', function() {
//         var places = searchBox.getPlaces();
//         var bounds = new google.maps.LatLngBounds();
//         var i, place;
//         for (i = 0; place = places[i]; i++) {
//             bounds.extend(place.geometry.location);
//             marker.setPosition(place.geometry.location);
//         }
//         map.fitBounds(bounds);
//         map.setZoom(15);
//     });
//     google.maps.event.addListener(marker, 'position_changed', function() {
//         var lat = marker.getPosition().lat();
//         var lng = marker.getPosition().lng();
//         $('#lat').val(lat);
//         $('#long').val(lng);
//     });
//     // now it IS a function and it is in global
// </script>


@endpush
@endsection