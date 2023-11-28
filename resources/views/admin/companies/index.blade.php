@extends('admin.layouts.master')
@section('title', 'عرض الشركات')
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        
           <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>عرض الشركات</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{route('admin.companies.create')}}" class="btn btn-rounded btn-primary">{{ __('btn_add_new') }}</a>

                        <a href="{{route('admin.companies.index')}}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>الإسم</th>
                                    <th>الحالة</th>
                                    <th> الصورة</th>

            						<th>{{ __('control') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($companies as $company)
					<tr >
						<td class="ui-state-default drag-handler" data-faq="{{$company->id}}">{{$company->id}}</td>
						<td>{{$company->name}}</td>
                        <td>
                                            @if( $company->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                            @endif
                                        </td>
                                        <td><img src="{{asset($company->image)}}" style="width:40px"></td>					
				
						<td style="width: 270px;">

					 

							<a href="{{url('admin/companies/'.$company->id.'/edit')}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> {{__('modal_edit')}}
								</span>
							</a>
							<form method="POST" action="{{url('admin/companies/destroy')}}" class="d-inline-block">@csrf @method("DELETE")
							<input type="hidden" name="id" value="{{$company->id}}">
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
									<span class="fas fa-trash "></span> {{ __('btn_delete') }}
								</button>
							</form>
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
