@extends('layouts.app2')
@section('main.index')
<!-- Page-Title -->
<div class="container">


    



@include('Admin.modals.addMainService')

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
            <h4 class="page-title"> الخدمات الرئيسة</h4>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a></li>
                <li class="active"> الصفحه الرئيسة</li>
            </ol>
        </div>
    </div>

    <div class="row" wire:key="pp">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-8">

                        <form role="form" action="{{route('service.search')}}" method="POST">
                            @csrf
                            <div class="form-group contact-search m-b-50">

                                <input type="text" name="searchservice" class="form-control" placeholder="بحث........">
                                <button type="submit" class="btn btn-white m-r-2"><i class="fa fa-search"></i></button>
                            </div> <!-- form-group -->
                        </form>

                    </div>
                   
                    <div class="col-sm-4">
                             <!-- <a class="btn btn-default btn-md waves-effect waves-light m-b-30 btnopen"><i class="md md-add"></i> اضافه ادمن جديد</a> -->
                             <a href="#add-main-service-modal" class="btn btn-default btn-md waves-effect waves-light m-b-30 btnopen" data-animation="fadein" data-plugin="custommodal" 
                                                    	data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> اضافة  عنصر جديد للرئيسة</a>
                         </div>
                     
                </div>


                <div class="table-responsive">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                            <tr>
                                <th>
<!-- 
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-white btn-xs dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div> -->
                                </th>

                                <th>الرقم التعريفى</th>
                                <th>الاسم</th>
                                <th>الاسم بالانجليزية</th>
                                <th>#</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($services as $service)

                            <tr class="active">
                           
                              <td>

<img src="{{$service->photoUrl()}}" alt="contact-img" title="contact-img" class="img-circle thumb-lg" />
</td>
                                <td>

                                    {{$service->id}}
                                </td>

                                <td>
                                    {{$service->name }}
                                </td>
                                
                                <td>
                                    {{$service->name_en }}
                                </td>
                                
                             

                                 
                                <td>
                                 
                                    <a href="{{route('service.edit',['service'=>$service->id])}}" class="table-action-btn"><i class="md md-edit"></i></a>
                
                                
                                    
                                    <form method="POST" action="{{route('service.destroy',['service'=>$service->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="table-action-btn"><i class="md md-close"></i></button>
                                    </form>
                                
                           
                                </td>

                            </tr>






                            @endforeach

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!!$services->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->

    <!-- end row -->
    @endsection