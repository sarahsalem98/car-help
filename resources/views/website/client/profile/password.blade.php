

 <!--start page top section-->

 @extends('layouts.website')
@section('client.profile.password')
 @include('website.client.layout.profileTop')

     <!--start profile-->
     <div class="profile-section">
        <div class="container">
            <div class="row">
            @include('website.client.layout.profileMenu')

                <div class="col-xs-12 col-sm-8 profile_content">
                    @include('website.allErrors')
                    @include('website.alertSuccess')
                    @include('website.alertDanger')
                    <form action="{{route('client.password.update.post')}}" method="POST" class="car_form">
                        @csrf
                        <h3 class="sections-title">تغيير كلمة المرور</h3>
                        <div class="form-group">
                            <label for="password1">كلمة المرور القديمة</label>
                            <input type="password" class="form-control mb-3" name="old_password" id="password1" placeholder="الرجاء ادخال كلمة المرور">
                            <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                        </div>
                        <div class="form-group">
                            <label for="password2">كلمة المرور الجديدة</label>
                            <input type="password" class="form-control mb-3" id="password2"name="new_password" placeholder="الرجاء ادخال كلمة المرور">
                            <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                        </div>
                        <div class="form-group">
                            <label for="password3">تأكيد كلمة المرور الجديدة</label>
                            <input type="password" class="form-control mb-3" id="password3"name="new_password_confirmation" placeholder="الرجاء ادخال كلمة المرور">
                            <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                        </div>
                        <div class="form_btns_wrapper">
                            <button  type="submit" class="btn main_btn w-100 moving_bk w-md-40 mb-sm-2">حفظ التغييرات</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
     </div>
     @endsection