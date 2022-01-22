


@extends('layouts.website')
@section('client.profile.address.index')
@include('website.client.profile.layout.profileTop')
     <!--start profile-->
     <div class="profile-section">
        <div class="container">
            <div class="row">
            @include('website.client.profile.layout.profileMenu')

                <div class="col-xs-12 col-sm-8 profile_content">
                    <h5 class="sections-title mb-15">العناوين المسجلة</h5>
                    @include('website.alertSuccess')
                    <div class="addresses_wrapper">      
                        @foreach($addresses as $address) 
                        <div class="shipping_to_wrapper">
                            <div class="user-table">
                                <form method="POST" action="{{route('client.address.delete',['address_id'=>$address->id])}}">
                                 @csrf
                                 @method('delete')
                                    <button type="submit" class="remove_address"><i class="fa fa-times"></i></button>
                                </form>
                                <a href="{{route('client.address.edit',['address_id'=>$address->id])}}"><h5 class="user-name"> {{$address->name}}</h5></a>
                                <p class="user-address">   {{$address->address}}   </p>
                                <div class="info-div">
                                    <a href="" class="user-phone">{{$address->phone_number}}</a>
                                    <a href="{{route('client.address.edit',['address_id'=>$address->id])}}" class="change-address"> <i class="fa fa-edit"></i> تغيير العنوان</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    
                  
               
                    </div>
                    <a href="{{route('client.address.add')}}" class="btn main_btn moving_bk"> <i class="fa fa-plus"></i>اضافة عنوان جديد</a>
                </div>
            </div>
        </div>
     </div>
     @endsection