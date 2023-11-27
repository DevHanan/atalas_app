@extends('admin.layouts.master')
@section('title', 'إنشاء صفحة')
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
                        <h5>{{ 'إنشاء صفحة' }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-rounded btn-primary">{{ __('btn_back') }}</a>

                        <a href="{{ route('admin.pages.create') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route('admin.pages.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-block">
                        <!-- Form Start -->
                        <fieldset class="row scheduler-border">
                      
                      
                          <div class="form-group col-md-12">
                            <label for="category">{{ __('page_type') }} <span>*</span></label>
                            <select class="form-control" name="type" id="category" required>
                                <option value="">{{ __('select') }}</option>
                                <option value="about">{{ __('about us') }}</option>
                                 <option value="terms">{{ __('terms') }}</option>
                                  <option value="privacy">{{ __('privacy') }}</option>
                                  <option value="others">{{ __('others') }}</option>
                              
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('page_type') }}
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="title">{{ __('field_title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_title') }}
                            </div>
                        </div>
                        
                     

                       

                           <hr/>

                        <div class="form-group col-md-6">

                            <!--@if(isset($row->logo_path))-->
                            <!--@if(is_file('uploads/'.$path.'/'.$row->logo_path))-->
                            <!--<img src="{{ asset('uploads/'.$path.'/'.$row->logo_path) }}" class="img-fluid setting-image" alt="{{ __('field_site_logo') }}">-->
                            <!--<div class="clearfix"></div>-->
                            <!--@endif-->
                            <!--@endif-->

                            <label for="logo">{{ __('image') }}: <span>{{ __('image_size', ['height' => 80, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="image" id="logo">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('image') }}
                            </div>
                        </div>
                        
                        
                        
                        </fieldset>


                        <fieldset class="row scheduler-border">
                        <div class="form-group col-md-12">
                            <label for="description">{{ __('field_description') }}</label>
                            <textarea class="form-control texteditor" name="description" id="description">{{ old('description') }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_description') }}
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
