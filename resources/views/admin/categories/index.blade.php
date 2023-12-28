@extends('admin.layouts.master')
@section('title', 'عرض الفئات')
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        
           <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>عرض الفئات</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{route('admin.categories.create')}}" class="btn btn-rounded btn-primary">{{ __('btn_add_new') }}</a>

                        <a href="{{route('admin.categories.index')}}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                                    	<th>#</th>
            						<th>الفئة</th>
                                    <th>الحالة</th>
            						          	<th> القسم</th>
            						<th>{{ __('field_photo') }}</th>
            						<th>{{ __('control') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($categories as $row)
					<tr >
						<td class="ui-state-default drag-handler" data-faq="{{$row->id}}">{{$row->id}}</td>
						<td>{{$row->title}}</td>
                        <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                            @endif
                                        </td>
						<td> {{ optional($row->section)->title }} </td>
<td><img src="{{asset($row->image)}}" style="width:40px"></td>					
						<td style="width: 270px;">

					 

							<a href="{{url('admin/categories/'.$row->id.'/edit')}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> {{__('modal_edit')}}
								</span>
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
        

</div>
</div>
@endsection
