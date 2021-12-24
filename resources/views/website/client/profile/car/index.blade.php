

@extends('layouts.website')
@section('client.profile.cars.index')
@include('website.client.profile.layout.profileTop')

     <!--start profile-->
     <div class="profile-section">
        <div class="container">
            <div class="row">
            @include('website.client.profile.layout.profileMenu')
                <div class="col-xs-12 col-sm-8 profile_content">
                    <h5 class="sections-title mb-15">السيارات المسجلة</h5>

                    @include('website.alertSuccess')
                    <div class="addresses_wrapper"> 
                        @foreach($cars as $car)      
                        <div class="shipping_to_wrapper">
                            <div class="user-table">
                                <form action="{{route('cars.destroy',['car'=>$car->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="remove_address"><i class="fa fa-times"></i></button>
                                </form>
                                <a href="cart.html"><h5 class="user-name">{{$car->name}}</h5></a>
                                <div class="info-div">
                                    <a href="#" class="user-phone"> {{$car->type}}</a>
                                    <a href="{{route('cars.edit',['car'=>$car->id])}}" class="change-address"> <i class="fa fa-edit"></i> تغيير السيارة</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{route('cars.create')}}" class="btn main_btn moving_bk"> <i class="fa fa-plus"></i>اضافة سيارة جديدة</a>
                </div>
            </div>
        </div>
     </div>
@endsection