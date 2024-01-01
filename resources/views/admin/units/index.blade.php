@extends('admin.layouts.master')
@section('title', 'عرض الوحدات')
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        
           <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>عرض الوحدات</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{route('admin.units.create')}}" class="btn btn-rounded btn-primary">{{ __('btn_add_new') }}</a>

                        <a href="{{route('admin.units.index')}}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>#</th>
            						<th>إسم</th>
                                    <th> الوحدة الأساسية </th>
            						<th>{{ __('control') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($units as $row)
					<tr >
						<td class="ui-state-default drag-handler" data-faq="{{$row->id}}">{{$row->id}}</td>
						<td>{{$row->name}}</td>
                        <td> 

                         {{ optional($row->parent)->name}} / {{ $row->number }} </td>
                    
<td>

					 

							<a href="{{url('admin/units/'.$row->id.'/edit')}}">
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
