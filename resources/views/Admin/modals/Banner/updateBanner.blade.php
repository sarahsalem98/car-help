<div id="update-banner{{$banner->id}}" class="modal-demo">
    <button type="button" class="close btnclose" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title ">تعديل البنر  </h4>
    <div class="custom-modal-text text-right">
        <form role="form" method="POST" action="{{route('banner.update',['banner'=>$banner->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exampleInputEmail1">البنر</label>
                <img src="{{Storage::url($banner->banners_pics)}}" id="blah" alt="your image" width="100" height="100" />
                <!-- <img  id="blah" alt="your image" width="100" height="100" /> -->
                <input class="form-control"  name="banners_pics" type="file"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            </div>



            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
            <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose" onclick="Custombox.close();">Cancel</button>
        </form>
    </div>
</div>
