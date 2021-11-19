<div id="add-sub-service-modal" class="modal-demo">
    <button type="button" class="close btnclose" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title ">اضافه عنصر جديد للفرعية </h4>
    <div class="custom-modal-text text-right">
        <form role="form" method="POST" action="{{route('subservice.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">الاسم</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="ادخل اسم هنا">
            </div>
            <div class="form-group">
                <label for="name">الاسم بالانجليزية</label>
                <input type="text" class="form-control" id="name" name="name_en" placeholder="ادخل الاسم بالانجليزيه  هنا">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">الصورة</label>
                <input name="sub_service_photo_path" type="file">
            </div>
            <div class="form-group">
                <label for="">القسم الرئيسى التابع له </label>
                <select name="service_id" class="form-select " aria-label="Default select example">
                    <option value=""></option>
                    @foreach($services as $service)
                    <option name="service_id" value="{{$service->id}}">{{$service->name}}</option>
                    @endforeach
                </select>
            </div>



            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
            <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose">Cancel</button>
        </form>
    </div>
</div>