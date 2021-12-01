@extends('layouts.app2')
@section('search')
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
                <li><a href="{{route('provider.index')}}" class="btn btn-link"> مقدمى الخدمه</a></li>
                <li class="active">مقدمى الخدمه الناتجين عن عمليه البحث</li>
            </ol>
        </div>
    </div>
    @if($providers->isNotEmpty())

    <div class="row" wire:key="pp">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
             
                </div>


                <div class="table-responsive">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                            <tr>
                                <th>

                                
                                </th>
                                <th>الاسم</th>

                                <th>الايميل</th>
                                <th>رقم الجوال</th>
                                <th>رقم الواتساب </th>
                                <th>التقييم</th>
                                <th>#</th>
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
                                        <button type="submit" class="btn btn-danger" title="Add to Wish List"><i class="fa fa-close"></i> ايقاف </button>

                                    </form>

                                    @else
                                    <form method="POST" action="{{route('privider.suspend',['provider'=>$provider])}}">
                                        @csrf
                                        <input type="hidden" name="suspended" value="0">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            <span class="btn-label"><i class="fa fa-check"></i>
                                            </span>تفعيل </button>
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
        <h4 class="page-title m-r-300">  لا يوجد   </h4>
    </div>
    @endif
    
    <!-- end col -->

    <!-- end row -->
    @endsection