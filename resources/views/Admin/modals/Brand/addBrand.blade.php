
<div id="add-brand" class="modal-demo">
            <button type="button" class="close btnclose" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title ">  اضافة عنصر جديد لانواع البراندات الخاصة بالسيارات  </h4>
            <div class="custom-modal-text text-right">
                <form role="form" method="POST" action="{{route('brandType.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">الصورة</label>
                        <input type="file" class="form-control" id="name" name="picture" placeholder="ادخل  صورة للبراند هنا">
                    </div>
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ادخل الاسم بالعربى هنا">
                    </div>
                 
               
                    <div class="form-group">
                        <label for="name"> الاسم بالانجليزية</label>
                        <input type="text" class="form-control" id="name" name="name_en" placeholder="ادخل الاسم بالانجليزيه  هنا">
                    </div>

                    <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose " onclick="Custombox.close();">Cancel</button>
                </form>
            </div>
        </div>
