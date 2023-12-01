                         
                            @extends('admin.layouts.master')
@section('title', ' تعديل إعلان')
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
                        <h5>تعديل إعلان</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-rounded btn-primary">{{ __('btn_back') }}</a>

                        <a href="{{ route('admin.sliders.create') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route('admin.sliders.update',$slider) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-block">
                        <!-- Form Start -->
                        <fieldset class="row scheduler-border">
                        
                        

                        <div class="form-group col-md-12">
                            <label for="title">{{ __('field_title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title',$slider) }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_title') }}
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="link">{{ __('field_link') }} <span>*</span></label>
                            <input type="text" class="form-control" name="link" id="link" value="{{ old('link',$slider->link) }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_link') }}
                            </div>
                        </div>
                     

                          <div class="form-group col-md-12">
                            <label for="status">{{ __('status') }} <span>*</span></label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="">{{ __('select') }}</option>
                                <option value="1"  @if($slider->status == '1')  selected @endif>{{ __('yes') }}</option>
                                  <option value="0"  @if($slider->status == '0')  selected @endif>{{ __('No') }}</option>
                              
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('status') }}
                            </div>
                        </div>

                           <hr/>

                        <div class="form-group col-md-6">

                            @if(isset($slider->image))
                            @if(is_file($slider->image))
                            <img src="{{ asset($slider->image) }}" class="img-fluid setting-image" alt="{{ __('field_site_logo') }}">
                            <div class="clearfix"></div>
                            @endif
                            @endif

                            <label for="logo">{{ __('image') }}: <span>{{ __('image_size', ['height' => 80, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="main_image" id="logo">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('image') }}
                            </div>
                        </div>
                        
                        
                        
                        </fieldset>
                        <fieldset class="row scheduler-border">
                        <div class="form-group col-md-12">
                            <label for="description">{{ __('field_description') }}</label>
                            <textarea class="form-control texteditor" name="description" id="description">
                                {{ $slider->description }}
                            </textarea>

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