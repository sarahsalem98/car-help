@extends('layouts.app2')
@section('banner.index')
<!-- Page-Title -->
<div class="container">





    @include('Admin.modals.Banner.addBanner')





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
            <h4 class="page-title">  المزيد</h4>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a></li>
                <li class="active"> البنرات </li>
            </ol>
        </div>
    </div>

    <div class="row" wire:key="pp">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-8">

                        <form role="form" action="" method="POST">
                            @csrf
                            <div class="form-group contact-search m-b-50">

                                <input type="text" name="searchservice" class="form-control" placeholder="بحث........">
                                <button type="submit" class="btn btn-white m-r-2"><i class="fa fa-search"></i></button>
                            </div> <!-- form-group -->
                        </form>

                    </div>

                    <div class="col-sm-4">
                        <!-- <a class="btn btn-default btn-md waves-effect waves-light m-b-30 btnopen"><i class="md md-add"></i> اضافه ادمن جديد</a> -->
                        <a href="#add-banner" class="btn btn-default btn-md waves-effect waves-light m-b-30 btnopen" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> اضافة بنر جديد</a>
                    </div>

                </div>


                <div class="table-responsive">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                            <tr>


                                <th>صورة البنر</th>
                                <th>الرقم التعريفى</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach($banners as $banner)

                            <tr class="active">

                                <td>

                                    <img src="{{Storage::url($banner->banners_pics)}}" alt="{{Storage::url($banner->banners_pics)}}" title="contact-img" class="img-rounded thumb-lg2" />
                                </td>
                                     
         
                                <td>
                                @include('Admin.modals.Banner.updateBanner')
                                 
                                   
                
                                    <a href="#update-banner{{$banner->id}}" class="table-action-btn" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-edit"></i> </a>


                                    
                                    <form method="POST" action="{{route('banner.destroy',['banner'=>$banner->id])}}">
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
                        {!!$banners->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->

    <!-- end row -->
    @endsection