     <!-- Page-Title -->
     <div class="container">


         <div class="my-modal-wrapper">

             <div id="custom-modal" class="modal-demo">
                 <button type="button" class="close btnclose" onclick="Custombox.close();">
                     <span>&times;</span><span class="sr-only">Close</span>
                 </button>
                 <h4 class="custom-modal-title ">Add Customer</h4>
                 <div class="custom-modal-text text-right">
                     <form role="form">
                         <div class="form-group">
                             <label for="name">Name</label>
                             <input type="text" class="form-control" id="name" placeholder="Enter name">
                         </div>

                         <div class="form-group">
                             <label for="exampleInputEmail1">Email address</label>
                             <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                         </div>

                         <div class="form-group">
                             <label for="position">Contact number</label>
                             <input type="text" class="form-control" id="position" placeholder="Enter number">
                         </div>


                         <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                         <button type="button" class="btn btn-danger waves-effect waves-light m-l-10 btnclose">Cancel</button>
                     </form>
                 </div>
             </div>
         </div>



 





         <div class="row" wire:key="foo">
             <div class="col-sm-12">
                 <h4 class="page-title">مقدمى الخدمة</h4>
                 <ol class="breadcrumb">
                     <li><a href="{{route('dashboard')}}">الرئيسية</a></li>
                     <li class="active">مقدمى الخدمة</li>
                 </ol>
             </div>
         </div>

         <div class="row" wire:key="pp">
             <div class="col-lg-12">
                 <div class="card-box">
                     <div class="row">
                         <div class="col-sm-8">
                             <form role="form">
                                 <div class="form-group contact-search m-b-30">
                                     <input type="text" id="search" class="form-control" placeholder="بحث........">
                                     <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                 </div> <!-- form-group -->
                             </form>
                         </div>
                         <div class="col-sm-4">
                             <a class="btn btn-default btn-md waves-effect waves-light m-b-30" wire:click="modal"><i class="md md-add"></i> اضافه مقدم خدمه جديد</a>

                         </div>
                     </div>


                     <div class="table-responsive">
                         <table class="table table-hover mails m-0 table table-actions-bar">
                             <thead>
                                 <tr>
                                     <th>

                                         <div class="btn-group dropdown">
                                             <button type="button" class="btn btn-white btn-xs dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
                                             <ul class="dropdown-menu" role="menu">
                                                 <li><a href="#">Action</a></li>
                                                 <li><a href="#">Another action</a></li>
                                                 <li><a href="#">Something else here</a></li>
                                                 <li class="divider"></li>
                                                 <li><a href="#">Separated link</a></li>
                                             </ul>
                                         </div>
                                     </th>
                                     <th>Name</th>

                                     <th>Email</th>
                                     <th>Number</th>
                                     <th>Whats number</th>
                                     <th>rate</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>

                             <tbody>
                                 @foreach($providers as $provider)

                                 <tr class="active">

                                     <td>

                                         <img src="{{$provider->url()}}" alt="contact-img" title="contact-img" class="img-circle thumb-lg" />
                                     </td>

                                     <td wire:key="{{ $provider->id }}">
                                         {{$provider->enginner_name }}
                                     </td>

                                     <td wire:key="{{ $provider->id }}" data-bs-toggle="collapse" href="#collapseExample{{$provider->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                         <a wire:click="details">{{$provider->email}}</a>
                                     </td>
                                     <td wire:key="{{ $provider->id }}" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                         <a href="#">{{$provider->phone_number}}</a>
                                     </td>
                                     <td wire:key="{{ $provider->id }}" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                         <a href="#">{{$provider->whatsapp_number}}</a>
                                     </td>

                                     <td wire:key="{{ $provider->id }}">
                                         {{$provider->rate}}
                                     </td>
                                     <td>
                                         <a href="#custom-modal" class="table-action-btn"><i class="md md-edit"></i></a>
                                         <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                     </td>

                                 </tr>






                                 @endforeach

                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div> <!-- end col -->

         <!-- end row -->
  