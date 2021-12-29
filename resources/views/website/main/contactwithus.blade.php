<div class="contact-us main-section">
    <div class="container">
        @include('website.alertSuccess')
        <h3 class="main-center-title"> {{__('contact us')}}</h3>
        <p class="main-center-des">{{__('contact us details')}} </p>
        <form action="{{route('contact.us.post')}}" method="POST" class="contact_form">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phoneNumber"> {{__('phone number')}}</label>
                    <input type="text" class="form-control" name="phone_number" id="phoneNumber" placeholder=" {{__('please enter your phone number')}}  ">
                    @include('website.more',['field'=>'phone_number'])
                </div>
                <div class="form-group col-md-6">
                    <label for="yourEmail"> {{__('email')}}</label>
                    <input type="email" class="form-control" name="email" id="yourEmail" placeholder=" {{__('please enter your email')}}">
                    @include('website.more',['field'=>'email'])
                </div>
                <div class="form-group col-xs-12">
                    <label for="yourComment">{{__('your message')}}</label>
                    <textarea class="form-control"  name="message" id="yourComment" placeholder="{{__('please enter your message')}}"></textarea>
                    @include('website.more',['field'=>'message'])
                </div>
                <button type="submit" class="btn main_btn moving_bk submit_btn">{{__('send')}}</button>
            </div>
        </form>
    </div>
</div>