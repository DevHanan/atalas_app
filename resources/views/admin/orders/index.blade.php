@extends('admin.layouts.master')
@section('title', 'عرض  الطلبات')
@section('content')

<!-- Start Content-->
<style>
    .steps.clearfix{
        display:none;
    }
</style>
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> عرض  الطلبات</h5>
                    </div>
                   

                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                                                                <th>#</th>

                                        <th>تاريخ إنشاء</th>
                                        <th>تاريخ التسليم</th>

                                        <th>العميل</th>
                                        <th>مندوب التوصيل</th>     
                                        <th>  إجمالى الطلب</th>     
                                        <th>  حالة الطلب</th>                                                                 
                                        <th>{{ __('field_action') }}</th>


                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $row->order_date->format('d/m/Y') }}</td>
                                        <td>{{ $row->delivery_date->format('d/m/Y') }}</td>

                                         <td>{{ optional($row->client)->name }}</td>
                                         <td>{{ optional($row->delivery)->name }}</td>
                                         <td>{{ $row->total }}</td>
                                         <td>
                                           {{ $row->StatusLabel }}
                                        </td>


                                               
 
                                               
                                                        
     <td>

     <button class="btn btn-icon btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#changeOrderStatusModal-{{ $row->id }}">
                                            <i class="far fa-bell-slash	"></i>
                                            </button>

                                            <!-- Include Password Change modal -->
                                            @include('admin.orders.status-change')

                                            
     <button class="btn btn-icon btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#changeOrderStatusModal-{{ $row->id }}">
                                            <i class=" fas fa-shopping-cart	"></i>
                                            </button>

                                            <!-- Include Password Change modal -->
                                            @include('admin.orders.add-delivery')

                                           	
                                           
 
                                            
                                            <a href="{{ url('admin/orders/'. $row->id) }}" class="btn btn-icon btn-primary btn-sm">
                                                <i class="far fa-eye"></i>
                                            </a>

                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')
                                          
                                            
                                            
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection