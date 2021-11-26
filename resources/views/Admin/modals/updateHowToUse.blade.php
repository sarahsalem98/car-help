
<div id="update-howToUse" class="modal-demo">
            <button type="button" class="close btnclose" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title ">  تعديل سياسة الاستخدام  </h4>
            <div class="custom-modal-text text-right">
                <form role="form" method="POST" action="{{route('howToUse.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">سياسة الاستخدام</label>
                        <textarea name="how_to_use" class="form-control" placeholder="ادخل اسم هنا" id="" cols="30" rows="10">
                        
                        {{old('how_to_use',$howToUse->how_to_use ?? null)}}
                        </textarea>
                        <input type="hidden" name="id" value="{{$howToUse->id}}">
                    </div>
               
                 

                    <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose">Cancel</button>
                </form>
            </div>
        </div>
