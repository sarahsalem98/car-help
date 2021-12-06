@extends('layouts.website')
@section('provider.register.work.hours')
<div class="login_section">
    <div class="container">
        <form method="POST" action="{{route('provider.register.work_hours.post')}}" class="login_form">
            @csrf
            <h3 class="main-pages-title">حدد أوقات العمل</h3>
            <p class="main-center-des">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر</p>
            <h5 class="provider-time-title">الوقت</h5>
            <input type="hidden" name="provider_id" value="{{$provider_id}}">
            <div class="provider_items">
                <div class="provider_time_row">
                    <input type="text" name="time[day][]" class="day_input provider_input" placeholder="ادخل اليوم">
                    <div class="time-form-group">
                        <input type="time" name="time[from][]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="من">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="time-form-group time_input">
                        <input type="time" name="time[to][]" class="time_input hidden_input">
                        <input type="text" class="time_input provider_input" placeholder="الي">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <label class="close_label mb-0">
                        <input  id="1" type="checkbox" class="close_checkbox" value="1"   name="time[closed][]">
                        مغلق
                    </label>
               
                    

                    <button class="repeater-add-btn" type="button">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
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