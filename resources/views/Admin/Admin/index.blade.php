@extends('layouts.app2')
@section('Admin.index')
<!-- Page-Title -->
<div class="container">





    @include('Admin.modals.addAdmin')


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
            <h4 class="page-title"> الادمنز</h4>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a></li>
                <li class="active"> الادمنز</li>
            </ol>
        </div>
    </div>

    <div class="row" wire:key="pp">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-8">

                        <form role="form" action="{{route('search.admin')}}" method="GET">
                            @csrf
                            <div class="form-group contact-search m-b-50">

                                <input type="text" name="searchAdmin" class="form-control" placeholder="بحث........">
                                <button type="submit" class="btn btn-white m-r-2"><i class="fa fa-search"></i></button>
                            </div> <!-- form-group -->
                        </form>

                    </div>
                    @can('store-admin',$AuthAdmin)
                    <div class="col-sm-4">
                        <!-- <a class="btn btn-default btn-md waves-effect waves-light m-b-30 btnopen"><i class="md md-add"></i> اضافه ادمن جديد</a> -->
                        <a href="#add-admin-modal" class="btn btn-default btn-md waves-effect waves-light m-b-30 btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> اضافة ادمن جديد</a>
                    </div>
                    @endcan
                </div>


                <div class="table-responsive">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                            <tr>
                                <th>


                                </th>

                                <th>الرقم التعريفى</th>
                                <th>الاسم</th>
                                <th>الايميل </th>
                                <th>الوظيفة </th>
                                <th>#</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($admins as $admin)

                            <tr class="active">
                                <td></td>
                                <td>

                                    {{$admin->id}}
                                </td>

                                <td>
                                    {{$admin->name }}
                                </td>


                                <td>{{$admin->email}}
                                </td>
                                <td>
                                    @if($admin->super_admin==1)
                                    <span class="label label-success">ادمن</span>
                                    @elseif($admin->super_admin==0)
                                    <span class="label label-inverse">ادمن مساعد</span>
                                    @endif
                                </td>



                                <td>
                                    @can('update-admin',$admin)
                                    <a href="{{route('admin.edit',['admin'=>$admin->id])}}" class="table-action-btn"><i class="md md-edit"></i></a>

                                    @endcan
                                    @can('delete-admin',$admin)

                                    <form method="POST" action="{{route('admin.destroy',['admin'=>$admin->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="table-action-btn"><i class="md md-close"></i></button>
                                    </form>

                                    @endcan
                                </td>

                            </tr>






                            @endforeach

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!!$admins->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->

    <!-- end row -->
    @endsection