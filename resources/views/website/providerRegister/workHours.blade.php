@extends('layouts.website')
@section('provider.register.work.hours')


<div class="login_section">
    <div class="container">
        <form method="POST" action="{{route('provider.register.work_hours.post')}}" class="login_form">
            @csrf
            <h3 class="main-pages-title">حدد أوقات العمل</h3>
            <p class="main-center-des">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر</p>
            @include('website.allErrors')
            <h5 class="provider-time-title">الوقت</h5>
            <input type="hidden" name="provider_id" value="{{$provider_id}}">
            <div class="provider_items">
                <div class="provider_time_row">
                    <input type="text" name="time[0][day]" value="{{__('sat')}}" class="day_input provider_input" placeholder="ادخل اليوم">
                    <div class="time-form-group">
                        <input type="time" name="time[0][from]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="من">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="time-form-group time_input">
                        <input type="time" name="time[0][to]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="الي">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <label class="close_label mb-0">
                        <input type="hidden" class="close_checkbox" value="0" name="time[0][closed]">
                        <input type="checkbox" class="close_checkbox" value="1" name="time[0][closed]">
                        مغلق
                    </label>



                    <!-- <button class="repeater-add-btn" type="button">
                        <i class="fa fa-plus"></i>
                    </button> -->
                </div>



                <div class="provider_time_row">
                    <input type="text" name="time[1][day]" value="{{__('sun')}}" class="day_input provider_input" placeholder="ادخل اليوم">
                    <div class="time-form-group">
                        <input type="time" name="time[1][from]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="من">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="time-form-group time_input">
                        <input type="time" name="time[1][to]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="الي">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <label class="close_label mb-0">
                        <input type="hidden" class="close_checkbox" value="0" name="time[1][closed]">
                        <input id="1" type="checkbox" class="close_checkbox" value="1" name="time[1][closed]">
                        مغلق
                    </label>



                    <!-- <button class="repeater-add-btn" type="button">
                        <i class="fa fa-plus"></i>
                    </button> -->
                </div>


                <div class="provider_time_row">
                    <input type="text" name="time[2][day]" value="{{__('mon')}}" class="day_input provider_input" placeholder="ادخل اليوم">
                    <div class="time-form-group">
                        <input type="time" name="time[2][from]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="من">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="time-form-group time_input">
                        <input type="time" name="time[2][to]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="الي">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <label class="close_label mb-0">
                        <input type="hidden" class="close_checkbox" value="0" name="time[2][closed]">

                        <input id="1" type="checkbox" class="close_checkbox" value="1" name="time[2][closed]">
                        مغلق
                    </label>


                    <!-- 
                    <button class="repeater-add-btn" type="button">
                        <i class="fa fa-plus"></i>
                    </button> -->
                </div>


                <div class="provider_time_row">
                    <input type="text" name="time[3][day]" value="{{__('tue')}}" class="day_input provider_input" placeholder="ادخل اليوم">
                    <div class="time-form-group">
                        <input type="time" name="time[3][from]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="من">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="time-form-group time_input">
                        <input type="time" name="time[3][to]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="الي">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <label class="close_label mb-0">
                        <input type="hidden" class="close_checkbox" value="0" name="time[3][closed]">

                        <input id="1" type="checkbox" class="close_checkbox" value="1" name="time[3][closed]">
                        مغلق
                    </label>



                    <!-- <button class="repeater-add-btn" type="button">
                        <i class="fa fa-plus"></i>
                    </button> -->
                </div>



                <div class="provider_time_row">
                    <input type="text" name="time[4][day]" value="{{__('wen')}}" class="day_input provider_input" placeholder="ادخل اليوم">
                    <div class="time-form-group">
                        <input type="time" name="time[4][from]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="من">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="time-form-group time_input">
                        <input type="time" name="time[4][to]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="الي">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <label class="close_label mb-0">
                        <input type="hidden" class="close_checkbox" value="0" name="time[4][closed]">

                        <input id="1" type="checkbox" class="close_checkbox" value="1" name="time[4][closed]">
                        مغلق
                    </label>


                    <!-- 
                    <button class="repeater-add-btn" type="button">
                        <i class="fa fa-plus"></i>
                    </button> -->
                </div>


                <div class="provider_time_row">
                    <input type="text" name="time[5][day]" value="{{__('thu')}}" class="day_input provider_input" placeholder="ادخل اليوم">
                    <div class="time-form-group">
                        <input type="time" name="time[5][from]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="من">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="time-form-group time_input">
                        <input type="time" name="time[5][to]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="الي">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <label class="close_label mb-0">
                        <input type="hidden" class="close_checkbox" value="0" name="time[5][closed]">

                        <input id="1" type="checkbox" class="close_checkbox" value="1" name="time[5][closed]">
                        مغلق
                    </label>



                    <!-- <button class="repeater-add-btn" type="button">
                        <i class="fa fa-plus"></i>
                    </button> -->
                </div>


                <div class="provider_time_row">
                    <input type="text" name="time[6][day]" value="{{__('fri')}}" class="day_input provider_input" placeholder="ادخل اليوم">
                    <div class="time-form-group">
                        <input type="time" name="time[6][from]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="من">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="time-form-group time_input">
                        <input type="time" name="time[6][to]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="الي">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <label class="close_label mb-0">
                        <input type="hidden" class="close_checkbox" value="0" name="time[6][closed]">

                        <input id="1" type="checkbox" class="close_checkbox" value="1" name="time[6][closed]">
                        مغلق
                    </label>



                    <!-- <button class="repeater-add-btn" type="button">
                        <i class="fa fa-plus"></i>
                    </button> -->
                </div>


                <button id="submit" type="submit" class="btn main_btn moving_bk submit_btn">التالي</button>
        </form>
    </div>

    @push('script')

    <script>
        function onClickHandler(chk) {
            chk.value = chk.checked ? '1' : '0';
            console.log(chk.id);
        }
    </script>
    @endpush
    @endsection