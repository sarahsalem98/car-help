
<div id="update-copoun{{$copoun->id}}" class="modal-demo">
            <button type="button" class="close btnclose" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title ">  تعديل الكوبون  </h4>
            <div class="custom-modal-text text-right">
                <form method="POST"  action="{{route('copoun.update',['copoun'=>$copoun->id])}}" role="x-www-form-urlencoded" >
                    @csrf
                    @method('PUT')
                    @foreach(json_decode($copoun->coupons) as $key=>$value)
                    <div class="form-group">
                        <label for="name">  
                         @if($key=='name')
                        اسم الكوبون
                        @else
                        القيمة
                         @endif  </label>
                        <input min="0" 
                       @if($key=='name')
                        type="text" 
                        @else
                         type="number" 
                         @endif 
                          class="form-control" value="{{$value}}" 
                          
                         @if($key=='name')
                         name="name" 
                        @else
                        name="value" 
                         @endif 
                       
                        >
                    </div>
                    @endforeach
           
               
                 

                    <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose">Cancel</button>
                </form>
            </div>
        </div>
