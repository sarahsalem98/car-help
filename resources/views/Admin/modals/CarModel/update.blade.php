
<div id="update-carModel{{$carModel->id}}" class="modal-demo">
            <button type="button" class="close btnclose" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title ">    تعديل موديل السيارة   </h4>
            <div class="custom-modal-text text-right">
                <form role="form" method="POST" action="{{route('carModel.update',['carModel'=>$carModel->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$carModel->name}}">
                    </div>
               
                    <div class="form-group">
                        <label for="name"> الاسم بالانجليزية</label>
                        <input type="text" class="form-control" id="name" name="name_en" value="{{$carModel->name_en}}" >
                    </div>

                    <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose" onclick="Custombox.close();">Cancel</button>
                </form>
            </div>
        </div>
