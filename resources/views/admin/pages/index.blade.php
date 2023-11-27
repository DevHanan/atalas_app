@extends('admin.layouts.master')
@section('title', 'عرض الصفحات')
@section('content')
<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        
           <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ 'عرض الصفحات' }}</h5>
                    </div>
                    <div class="card-block">
                       <a href="{{route('admin.pages.create')}}" class="btn btn-rounded btn-primary">{{ __('btn_add_new') }}</a>

                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                                    	<th>#</th>
            						<th>{{ __('title') }}</th>
            						<th>{{ __('image') }}</th>
            						<th>{{ __('control') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 	@foreach($pages as $page)
					<tr>
						<td>{{$page->id}}</td>
						<td>{{$page->title}}</td>
						<td><img src="{{asset($page->image)}}" style="width:40px"></td>

						<td style="width: 270px;">

						
							<a href="{{url('admin/pages/'.$page->id.'/edit')}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> {{ __('modal_edit') }}
								</span>
							</a>
					
						
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
