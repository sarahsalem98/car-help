
<div id="update-whoWeAre" class="modal-demo">
            <button type="button" class="close btnclose" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title ">    تعديل من نحن  </h4>
            <div class="custom-modal-text text-right">
                <form role="form" method="POST" action="{{route('whoWeAre.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name"> من نحن </label>
                        <textarea name="who_are_we" class="form-control" placeholder="ادخل اسم هنا" id="" cols="30" rows="10">
                        
                        {{old('who_are_we',$whoWeAre->who_are_we ?? null)}}
                        </textarea>
                        <input type="hidden" name="id" value="{{$whoWeAre->id}}">
                    </div>
               
                 

                    <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose"onclick="Custombox.close();">Cancel</button>
                </form>
            </div>
        </div>
