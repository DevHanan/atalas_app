@extends('admin.layouts.master')
@section('title', 'تعديل وحدة')
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Card ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> {{ 'تعديل وحدة' }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route('admin.units.index') }}" class="btn btn-rounded btn-primary">{{ __('btn_back') }}</a>

                        <a href="{{ route('admin.units.create') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route('admin.units.update',$unit) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="card-block">
                        <!-- Form Start -->
                        <fieldset class="row scheduler-border">
      

                        <div class="form-group col-md-12">
                            <label for="title"> إسم الوحدة <span>*</span></label>
                            <input type="text" class="form-control" name="name" id="title" value="{{ old('name',$unit) }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }}  إسم الوحدة
                            </div>
                        </div>
                      
                                               

                       

                       

                        
                        
                        </fieldset>


                        <!-- Form End -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{ __('btn_save') }}</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- [ Card ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection
