<div class="contact-us main-section">
    <div class="container">
        <h3 class="main-center-title"> {{__('contact us')}}</h3>
        <p class="main-center-des">{{__('contact us details')}} </p>
        <form action="" class="contact_form">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phoneNumber"> {{__('phone number')}}</label>
                    <input type="text" class="form-control" id="phoneNumber" placeholder=" {{__('please enter your phone number')}}  ">
                </div>
                <div class="form-group col-md-6">
                    <label for="yourEmail"> {{__('email')}}</label>
                    <input type="email" class="form-control" id="yourEmail" placeholder=" {{__('please enter your email')}}">
                </div>
                <div class="form-group col-xs-12">
                    <label for="yourComment">{{__('your message')}}</label>
                    <textarea class="form-control" name="comment" id="yourComment" placeholder="{{__('please enter your message')}}"></textarea>
                </div>
                <button type="submit" class="btn main_btn moving_bk submit_btn">{{__('send')}}</button>
            </div>
        </form>
    </div>
</div>