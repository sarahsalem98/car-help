


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
                    <div class="addresses_wrapper">       
                        <div class="shipping_to_wrapper">
                            <div class="user-table">
                                <button class="remove_address"><i class="fa fa-times"></i></button>
                                <a href="cart.html"><h5 class="user-name">خالد على</h5></a>
                                <p class="user-address">شارع الصندوق الأسود , الرياض, المملكة العربية السعودية</p>
                                <div class="info-div">
                                    <a href="#" class="user-phone">0096548796413</a>
                                    <a href="address_edit.html" class="change-address"> <i class="fa fa-edit"></i> تغيير العنوان</a>
                                </div>
                            </div>
                        </div>
                        <div class="shipping_to_wrapper">
                            <div class="user-table">
                                <button class="remove_address"><i class="fa fa-times"></i></button>
                                <a href="cart.html"><h5 class="user-name">خالد على</h5></a>
                                <p class="user-address">شارع الصندوق الأسود , الرياض, المملكة العربية السعودية</p>
                                <div class="info-div">
                                    <a href="#" class="user-phone">0096548796413</a>
                                    <a href="address_edit.html" class="change-address"> <i class="fa fa-edit"></i> تغيير العنوان</a>
                                </div>
                            </div>
                        </div>
                        <div class="shipping_to_wrapper">
                            <div class="user-table">
                                <button class="remove_address"><i class="fa fa-times"></i></button>
                                <a href="cart.html"><h5 class="user-name">خالد على</h5></a>
                                <p class="user-address">شارع الصندوق الأسود , الرياض, المملكة العربية السعودية</p>
                                <div class="info-div">
                                    <a href="#" class="user-phone">0096548796413</a>
                                    <a href="address_edit.html" class="change-address"> <i class="fa fa-edit"></i> تغيير العنوان</a>
                                </div>
                            </div>
                        </div>
                        <div class="shipping_to_wrapper">
                            <div class="user-table">
                                <button class="remove_address"><i class="fa fa-times"></i></button>
                                <a href="cart.html"><h5 class="user-name">خالد على</h5></a>
                                <p class="user-address">شارع الصندوق الأسود , الرياض, المملكة العربية السعودية</p>
                                <div class="info-div">
                                    <a href="#" class="user-phone">0096548796413</a>
                                    <a href="address_edit.html" class="change-address"> <i class="fa fa-edit"></i> تغيير العنوان</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="add_address.html" class="btn main_btn moving_bk"> <i class="fa fa-plus"></i>اضافة عنوان جديد</a>
                </div>
            </div>
        </div>
     </div>
     @endsection