@extends('layouts.app2')
@section('brand.search')
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
                <li><a href="{{route('brandType.index')}}" class="btn btn-link"> البراندات</a></li>
                <li class="active"> البراندات الناتجين عن عمليه البحث </li>
            </ol>
        </div>
    </div>
    @if($brandTypes->isNotEmpty())

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


                                <th>الرقم التعريفى</th>
                                <th>الاسم</th>
                                <th>الاسم بالانجليزية </th>
                                <th>#</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($brandTypes as $brandType)

                            <tr class="active">

                                <td>

                                    {{$brandType->id}}
                                </td>

                                <td>
                                    {{$brandType->name }}
                                </td>
                                <td>
                                    {{$brandType->name_en }}
                                </td>





                                <td>
                                    @include('Admin.modals.Brand.updateBrand')
                                    <a href="#update-brand{{$brandType->id}}" class="table-action-btn" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-edit"></i> </a>



                                    <form method="POST" action="{{route('brandType.destroy',['brandType'=>$brandType->id])}}">
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
    @else
    <div>
        <h4 class="page-title m-r-300"> لا يوجد </h4>
    </div>
    @endif

    <!-- end col -->

    <!-- end row -->
    @endsection