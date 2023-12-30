@extends('admin.layouts.master')
@section('title', 'عرض  الزيارات')
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
                        <h5> عرض  الزيارات</h5>
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

                                        <th>تاريخ </th>
                                        <th>وقت الزيارة</th>
                                       <th>الحالة</th>
                                        <th>العميل</th>
                                        <th>المندوب</th>                                        
                                        <th>{{ __('field_action') }}</th>


                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $row->visit_date }}</td>
                                        <td>{{ $row->visit_time }}</td>
                                        <td>{{ $row->statusLabel }}</td>

                                         <td>{{ optional($row->client)->name }}</td>
                                         <td>{{ optional($row->sale)->name }}</td>

                                               
 
                                               
                                                            
     <td>

                                            @if( $row->status == 1 )
                                            <a href="{{ route($route.'.status', $row->id) }}" class="btn btn-icon btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                            @else
                                            <a href="{{ route($route.'.status', $row->id) }}" class="btn btn-icon btn-success btn-sm"><i class="fas fa-check"></i></a>
                                            @endif
                                           
 
                                            
                                            <a href="{{ url('admin/visits/'. $row->id) }}" class="btn btn-icon btn-primary btn-sm">
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