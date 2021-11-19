@extends('layouts.app2')
@section('main.search')
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
            <h4 class="page-title"> نتيجه البحث عن { {{$word}} }</h4>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a></li>
                <li class="active"> الخدمات الرئيسية الناتجه عن البحث</li>
            </ol>
        </div>
    </div>
    @if($services->isNotEmpty())

    <div class="row" wire:key="pp">
        <div class="col-lg-12">
            <div class="card-box">
            


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

                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
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
                </div>
            </div>
        </div>
    </div> <!-- end col -->
    @else
    <div>
        <h4 class="page-title m-r-300">  لا يوجد   </h4>
    </div>
    @endif

    <!-- end row -->
    @endsection