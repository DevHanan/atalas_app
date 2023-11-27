@extends('admin.layouts.master')
@section('title','إضافة قسم')
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
                        <h5> إضافة قسم  </h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-rounded btn-primary">{{ __('btn_back') }}</a>

                        <a href="{{ route('admin.categories.create') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-block">
                        <!-- Form Start -->
                        <fieldset class="row scheduler-border">
                      

                        <div class="form-group col-md-12">
                            <label for="title">إسم القسم <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} إسم القسم
                            </div>
                        </div>
                        
                                                <div class="form-group col-md-12">
                            <label for="category">{{ __('field_category') }} <span>*</span></label>
                            <select class="form-control" name="parent_id" id="parent_id" >
                                <option value="">{{ __('select') }}</option>
                                @foreach( $categories as $category )
                                <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->title }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_category') }}
                            </div>
                        </div>

                        
                     

                       

                           <hr/>

                        <div class="form-group col-md-6">


                            <label for="logo">{{ __('image') }}: <span>{{ __('image_size', ['height' => 80, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="image" id="logo">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('image') }}
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
