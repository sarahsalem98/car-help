@extends('layouts.app2')
@section('public.order')
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
            <h4 class="page-title"> الخدمات الرئيسة</h4>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}" class="btn btn-link">الرئيسية</a></li>
                <li class="active">  الطلبات العامة</li>
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

                                <th>Id</th>
                                <th>صورة</th>
                                <th> مقدم الخدمة</th>
                                <th>العميل</th>
                                <th>السيارة</th>
                                <th>التفاصييل</th>
                                <th>حالة الطلب</th>
                                <th>تاريخ الطلب</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($publicOrders as $publicOrder)

                            <tr class="active">
                                <td></td>
                                <td>
                                    {{$publicOrder->id}}
                                </td>
                           
                              <td>

<img src="{{$publicOrder->firstImageUrl()}}" alt="contact-img" title="contact-img" class="img-circle thumb-lg" />
</td>
                                <td>

                                    {{$publicOrder->provider->enginner_name ?? 'لايوجد'}}
                                </td>

                                <td>
                                    {{$publicOrder->client->name }}
                                </td>
                                
                             <td>

                             {{$publicOrder->car->name}}
                             </td>
                             <td>
                                 {{$publicOrder->details}}
                             </td>                             
                             <td>
                                 @if($publicOrder->status==0)
                                 <span class="label label-default">جديدة</span>

                                 @elseif($publicOrder->status==1)
                                 <span class="label label-primary">قيد التنفيذ</span>

                                 @elseif($publicOrder->status==4)
                                <span class="label label-success" >مكتملة</span>

                                @elseif($publicOrder->status==5)
                                <span class="label label-danger">ملغاة</span>
                                 @endif
                             </td>
                             <td>{{$publicOrder->created_at}}</td>
                             

                                
                            </tr>






                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->

    <!-- end row -->
    @endsection