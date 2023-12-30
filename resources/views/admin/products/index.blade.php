@extends('admin.layouts.master')
@section('title', 'عرض المنتجات')
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
          
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>عرض المنتجات</h5>
                    </div>
                    <div class="card-header">
                         <a href="{{ route($route.'.create') }}" class="btn btn-rounded btn-info"> إضافة جديد</a>
                         <a href="{{ route($route.'.index') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>

                        </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> إسم المنتج </th>
                                        <th>  صورة أساسية</th>
                                        <th>  الشركة</th>
                                        <th>  القسم</th>
                                        <th>  الفئة</th>
                                        <th>حالة </th>
                                        <th>الأحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->name }}</td>

                                        	<td><img src="{{asset($row->main_img)}}" style="width:40px"></td>
                                        

                                        
                                            <td> {{ optional($row->company)->name }}</td>
                                            <td> {{ optional($row->section)->title }}</td>
                                            <td> {{ optional($row->category)->title }}</td>

                                        <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">مفعلة</span>
                                            @else
                                            <span class="badge badge-pill badge-danger"> غير مفعلة </span>
                                            @endif
                                        </td>
                                        <td>
                                           
                                                 <a href="{{ route($route.'.edit',$row->id) }}" class="btn btn-icon btn-primary btn-s">                                                <i class="far fa-edit"></i>
</a>
                                            <!-- Include Edit modal -->
                                            

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