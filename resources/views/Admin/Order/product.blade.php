@extends('layouts.app2')
@section('product.order')
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
                <li class="active"> الطلبات الخاصة</li>
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
                                <!-- <th>

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
                                </th> -->

                                <th>Id</th>
                                <th> مقدم الخدمة</th>
                                <th>العميل</th>
                                <th>العنوان</th>
                                <th>طريقة الدفع</th>
                                <th> تفاصيل الطلب</th>
                                <th>حالة الطلب</th>
                                <th> تاريخ الطلب </th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach($productOrders as $productOrder)

                            <tr class="active">
                            
                                <td>
                                    {{$productOrder->id}}
                                </td>

                                <td>

                                    {{$productOrder->provider->enginner_name ?? 'لايوجد'}}
                                </td>

                                <td>
                                    {{$productOrder->client->name }}
                                </td>
                           

                                <td>

                                    {{$productOrder->address->address}}
                                </td>


                                <td>
                                    {{$productOrder->payement_method}}
                                </td>
                                <td>
                                    <div class="btn-group open">
                                        <button type="button" class="btn btn-inverse dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"> المنتجات  <span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach($productOrder->product as $order)
                                            <li><span>الكميه من المنتج{ {{$order->id}} } : <b>{{$order->pivot->qty}}</b><br>  <span>السعر الكلى:</span> <span> <b>{{$order->pivot->total_price}}</b> </span></li>
                                          <hr>
                                          <hr>
                                          <hr>
                                            @endforeach
                                        </ul>
                                    </div>
                              </td>
                                <td>
                                    @if($productOrder->status==0)
                                    <span class="label label-default">جديدة</span>

                                    @elseif($productOrder->status==1)
                                    <span class="label label-primary">قيد التنفيذ</span>

                                    @elseif($productOrder->status==2)
                                    <span class="label label-pink">تم التجهييز </span>

                                    @elseif($productOrder->status==3)
                                    <span class="label label-purple"> تم الاستلام</span>

                                    @elseif($productOrder->status==4)
                                    <span class="label label-success">مكتملة</span>

                                    @elseif($productOrder->status==5)
                                    <span class="label label-danger">ملغاة</span>
                                    @endif
                                </td>

                           
                                <td>
                                    {{$productOrder->created_at}}
                                </td>
                               

                            </tr>






                            @endforeach

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!!$productOrders->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->

    <!-- end row -->
    @endsection