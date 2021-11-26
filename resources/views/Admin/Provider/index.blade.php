     @extends('layouts.app2')
     @section('index')
     <!-- Page-Title -->
     <div class="container">
  

         <div class="my-modal-wrapper">

             <div id="custom-modal" class="modal-demo">
                 <button type="button" class="close btnclose" onclick="Custombox.close();">
                     <span>&times;</span><span class="sr-only">Close</span>
                 </button>
                 <h4 class="custom-modal-title ">Add Customer</h4>
                 <div class="custom-modal-text text-right">
                     <form role="form" method="POST" action="{{route('provider.store')}}">
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





         @if (count($errors) > 0)
         <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
         @endif
         @if(session()->has('message'))
         <div class="alert alert-success">
             {{ session()->get('message') }}
         </div>
         @endif



         <div class="row" wire:key="foo">
             <div class="col-sm-12">
                 <h4 class="page-title">مقدمى الخدمة</h4>
                 <ol class="breadcrumb">
                     <li><a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a></li>
                     <li class="active">مقدمى الخدمة</li>
                 </ol>
             </div>
         </div>

         <div class="row" wire:key="pp">
             <div class="col-lg-12">
                 <div class="card-box">
                     <div class="row">
                         <div class="col-sm-8">
                           
                             <form role="form"  action="{{route('provider.search')}}" method="POST" >
                                 @csrf
                                         <div class="form-group contact-search m-b-50">

                                         <input type="text" name="searchprovider"  class="form-control" placeholder="بحث........">
                                         <button type="submit" class="btn btn-white m-r-2"><i class="fa fa-search"></i></button>
                                        </div> <!-- form-group -->
                                     </form>
                            
                         </div>
                         <!-- <div class="col-sm-4">
                             <a class="btn btn-default btn-md waves-effect waves-light m-b-30 btnopen"><i class="md md-add"></i> اضافه مقدم خدمه جديد</a>

                         </div> -->
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

                                         <img src="{{$provider->photoUrl()}}" alt="contact-img" title="contact-img" class="img-circle thumb-lg" />
                                     </td>

                                     <td>
                                         {{$provider->enginner_name }}
                                     </td>

                                     <td data-bs-toggle="collapse" href="#collapseExample{{$provider->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
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
                                         @if($provider->suspended==0)
                                         <form method="POST" action="{{route('privider.suspend',['provider'=>$provider])}}">
                                             @csrf
                                             <input type="hidden" name="suspended" value="1">
                                             <button type="submit" class="btn btn-danger" title="Add to Wish List"><i class="fa fa-close"></i> ايقاف  </button>

                                         </form>

                                         @else
                                         <form method="POST" action="{{route('privider.suspend',['provider'=>$provider])}}">
                                             @csrf
                                             <input type="hidden" name="suspended" value="0">
                                             <button type="submit" class="btn btn-success waves-effect waves-light">
                                                 <span class="btn-label"><i class="fa fa-check"></i>
                                                 </span>تفعيل  </button>
                                         </form>

                                         @endif
                                     </td>
                                     <td>
                                     <a href="{{route('provider.products.show',['provider'=>$provider->id])}}" type="button" class="btn btn-primary waves-effect waves-light">منتجات </a>
                                     </td>
                                     <td>
                                         <a href="{{route('provider.edit',['provider'=>$provider->id])}}" class="table-action-btn"><i class="md md-edit"></i></a>
                                         <form method="POST" action="{{route('provider.destroy',['provider'=>$provider->id])}}">
                                           @method('DELETE')
                                           @csrf
                                             <button type="submit"  class="table-action-btn"><i class="md md-close"></i></button>
                                         </form>
                                     </td>

                                 </tr>






                                 @endforeach

                             </tbody>
                         </table>
                         <div class="d-flex justify-content-center">
                        {!!$providers->links() !!}
                    </div>
                     </div>
                 </div>
             </div>
         </div> <!-- end col -->

         <!-- end row -->
         @endsection