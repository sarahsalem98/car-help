<div id="add-banner" class="modal-demo">
    <button type="button" class="close btnclose" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title ">اضافه بنر جديد </h4>
    <div class="custom-modal-text text-right">
        <form role="form" method="POST" action="{{route('banner.store')}}" enctype="multipart/form-data">
            @csrf


            <div class="form-group">
                <label for="exampleInputEmail1">الصورة</label>
            
                <input multiple="multiple" name="banners_pics[]" type="file">
            </div>



            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
            <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose" onclick="Custombox.close();">Cancel</button>
        </form>
    </div>
</div>
