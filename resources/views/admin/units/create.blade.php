@extends('admin.layouts.master')
@section('title','إضافة وحدة')
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
                        <h5> إضافة وحدة  </h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route('admin.units.index') }}" class="btn btn-rounded btn-primary">{{ __('btn_back') }}</a>

                        <a href="{{ route('admin.units.create') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route('admin.units.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-block">
                        <!-- Form Start -->
                        <fieldset class="row scheduler-border">
                      

                        <div class="form-group col-md-12">
                            <label for="title">إسم الوحدة <span>*</span></label>
                            <input type="text" class="form-control" name="name" id="title" value="{{ old('title') }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} إسم الوحدة
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="number">العدد الجزئى  <span>*</span></label>
                            <input type="number" class="form-control" name="number" id="number" value="{{ old('number') }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} العدد 
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="sale_unit_id">الاساسى <span>*</span></label>
                            <select class="form-control select2" name="sale_unit_id" id="sale_unit_id" required>
                                <option value="">{{ __('select') }}</option>
                                @foreach( $units as $unit )
                                <option value="{{ $unit->id }}" @if(old('sale_unit_id') == $unit->id) selected @endif>{{ $unit->name }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_unit') }}
                            </div>
                        </div>

                        
                    
                       

                           <hr/>

                       
                        
                        
                        
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
