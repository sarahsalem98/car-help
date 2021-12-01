
<div id="update-google" class="modal-demo">
            <button type="button" class="close btnclose" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title ">     تعديل لينك جوجل   </h4>
            <div class="custom-modal-text text-right">
                <form role="form" method="POST" action="{{route('others.update')}}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text" class="form-control" id="name" name="google" value="{{$others->google}}">
                    </div>
               <input type="hidden" name="id" value="{{$others->id}}">
               
                    <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose"onclick="Custombox.close();">Cancel</button>
                </form>
            </div>
        </div>
