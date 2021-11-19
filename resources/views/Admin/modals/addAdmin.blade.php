
<div id="add-admin-modal" class="modal-demo">
            <button type="button" class="close btnclose" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title ">اضافه ادمن جديد </h4>
            <div class="custom-modal-text text-right">
                <form role="form" method="POST" action="{{route('admin.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ادخل اسم هنا">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">الايميل </label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="ادخل ايميل هنا ">
                    </div>

                    <div class="form-group">
                        <label for="position">الرقم السرى </label>
                        <input type="password" class="form-control" id="position" name="password" placeholder="ادخل الرقم السرى هنا ">
                    </div>
                    <div class="form-group">
                        <label for="position"> تأكييد الرقم السرى </label>
                        <input type="password" class="form-control" id="position" name="password_confirmation" placeholder="ادخل الرقم السرى هنا ">
                    </div>
                    <div class="form-group">
                        <label for="position"> تحديد وظيفة الادمن</label>
                        <select name="super_admin" class="form-select m-t-10 m-r-293" aria-label="Default select example">
                                    <option value="">اختر</option>
                                   
                                    <option name="super_admin" value="1">ادمن</option>
                                    <option name="super_admin" value="0">ادمن مساعد</option>
                                </select>
                    </div>


                    <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose">Cancel</button>
                </form>
            </div>
        </div>
