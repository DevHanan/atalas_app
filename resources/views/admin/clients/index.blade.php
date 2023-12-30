@extends('admin.layouts.master')
@section('title', 'عرض  العملاء')
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
                        <h5> عرض  العملاء</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.create') }}" class="btn btn-rounded btn-primary">{{ __('btn_add_new') }}</a>
                        <a href="{{ route($route.'.index') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
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

                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_order_number') }}</th>
                                        <th>{{ __('field_order_total') }}</th>
                                        <th>{{ __('field_Indebtedness') }}</th>
                                        <th>{{ __('field_province') }}</th>
                                        <th>{{ __('field_location') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                        <th>{{ __('field_action') }}</th>


                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr style="text-align: center;">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->first_name }}</td>
                                        <td>{{ $row->orders()->count() }}</td>

                                        <td>{{ $row->orders()->sum('total') }}</td>
                                        <td>{{ $row->orders()->sum('remainig_payment') }}</td>

                                     <td>{{ optional($row->province)->title  }} -   {{ optional($row->district)->title  }}</td>
                                     <td>  {{  $row->location }}</td>
                                     <td>
                                            
                                            
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ __('status_blocked') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            
                                            @if( $row->status == 1 )
                                            <a href="{{ route($route.'.status', $row->id) }}" class="btn btn-icon btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                            @else
                                            <a href="{{ route($route.'.status', $row->id) }}" class="btn btn-icon btn-success btn-sm"><i class="fas fa-check"></i></a>
                                            @endif
                                           
 
                                            
                                            <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-icon btn-primary btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')
                                             
                                            <button class="btn btn-icon btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal-{{ $row->id }}">
                                            <i class="fas fa-key"></i>
                                            </button>

                                            <!-- Include Password Change modal -->
                                            @include('admin.sales.password-change')
                                            
                                            
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