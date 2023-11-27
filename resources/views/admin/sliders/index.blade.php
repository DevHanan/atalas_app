@extends('admin.layouts.master')
@section('title', 'معرض الإعلانات')
@section('content')
<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        
           <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>الإعلانات</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{route('admin.sliders.create')}}" class="btn btn-rounded btn-primary">إضافة إعلان</a>

                    </div>
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>#</th>
            						<th>العنوان</th>
            						<th>الحالة </th>
            						<th> الصورة</th>
            						<th>التحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 	@foreach($sliders as $slider)
					<tr>
						<td>{{$slider->id}}</td>
						<td>{{$slider->title}}</td>
							<td>
							@if($slider->status==1)
							<span class="fas fa-check-circle text-success" ></span>
							@else
							<span class="fas fa-check-circle text-error" ></span>
							@endif
						</td>
						<td><img src="{{asset($slider->image)}}" style="width:40px"></td>

						<td style="width: 270px;">

						
						
							<a href="{{route('admin.sliders.edit',$slider)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تعديل
								</span>
							</a>
						
							<form method="POST" action="{{route('admin.sliders.destroy',$slider)}}" class="d-inline-block">@csrf @method("DELETE")
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
									<span class="fas fa-trash "></span> حذف
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
