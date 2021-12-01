@extends('layouts.app2')
@section('submain.search')
<!-- Page-Title -->
<div class="container">



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
            <h4 class="page-title"> نتيجه البحث عن {{$word}}</h4>
            <ol class="breadcrumb">
                <li><a href="{{route('client.index')}}" class="btn btn-link"> الخدمات الفرعية</a></li>
                <li class="active"> الخدمات الفرعية الناتجة عن عمليه البحث </li>
            </ol>
        </div>
    </div>
    @if($subservices->isNotEmpty())

    <div class="row" wire:key="pp">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <!-- <div class="col-sm-8">
                        <form role="form">
                            <div class="form-group contact-search m-b-50">
                                <input type="text" id="search" class="form-control" placeholder="بحث........">
                                <button type="submit" class="btn btn-white m-r-2"><i class="fa fa-search"></i></button>
                            </div> 
                        </form>
                    </div> -->
                    <!-- <div class="col-sm-4">
                             <a class="btn btn-default btn-md waves-effect waves-light m-b-30 btnopen"><i class="md md-add"></i> اضافه مقدم خدمه جديد</a>

                         </div> -->
                </div>




                <div class="table-responsive">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                            <tr>
                                <th>

                                    <!-- <div class="btn-group dropdown">
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
                                <th>الاسم </th>
                                <th>الاسم بالانجليزية</th>
                                <th>الخدمة الرئيسة التابعة لها</th>
                                <th>#</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($subservices as $subservice)

                            <tr class="active">

                                <td>

                                    <img src="{{$subservice->photoUrl()}}" alt="contact-img" title="contact-img" class="img-circle thumb-lg" />
                                </td>
                                <td>

                                    {{$subservice->id}}
                                </td>

                                <td>
                                    {{$subservice->name }}
                                </td>
                                <td>
                                    {{$subservice->name_en }}
                                </td>


                                <td>
                                    <span class="label label-purple">{{$subservice->mainService->name}}</span>
                                </td>



                                <td>

                                    <a href="{{route('subservice.edit',['subservice'=>$subservice->id])}}" class="table-action-btn"><i class="md md-edit"></i></a>



                                    <form method="POST" action="{{route('subservice.destroy',['subservice'=>$subservice->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="table-action-btn"><i class="md md-close"></i></button>
                                    </form>


                                </td>

                            </tr>






                            @endforeach

                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div>
    <h4 class="page-title m-r-300"> لا يوجد </h4>
</div>
@endif

<!-- end col -->

<!-- end row -->
@endsection