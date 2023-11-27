@extends('admin.layouts.master')
@section('title','إضافة شركة')
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
                        <h5> إضافة شركة  </h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route('admin.companies.index') }}" class="btn btn-rounded btn-primary">{{ __('btn_back') }}</a>

                        <a href="{{ route('admin.companies.create') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route('admin.companies.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-block">
                        <!-- Form Start -->
                        <fieldset class="row scheduler-border">
                      

                        <div class="form-group col-md-12">
                            <label for="name">إسم الشركة <span>*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} إسم الشركة
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="section_id">{{ __('field_section') }} <span>*</span></label>
                            <select class="form-control" name="section_id" id="section_id" >
                                <option value="">{{ __('select') }}</option>
                                @foreach( $sections as $section )
                                <option value="{{ $section->id }}" @if(old('section_id') == $section->id) selected @endif>{{ $section->title }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_section') }}
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="category_id">{{ __('field_category') }} <span>*</span></label>
                            <select class="form-control" name="category_id" id="category_id" >
                                <option value="">{{ __('select') }}</option>
                                @foreach( $categories as $category )
                                <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->title }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_category') }}
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
