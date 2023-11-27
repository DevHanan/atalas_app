@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <form class="needs-validation" novalidate action="{{ route($route.'.siteinfo') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>
                    <div class="card-block row">
                        
                        <!-- Form Start -->
                        <input name="id" type="hidden" value="{{ (isset($row->id))?$row->id:-1 }}">

                        <div class="form-group col-md-6">
                            <label for="title">{{ __('field_site_title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ isset($row->title)?$row->title:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_site_title') }}
                            </div>
                        </div>


                        <hr/>

                        <div class="form-group col-md-6">

                            @if(isset($row->logo_path))
                            @if(is_file('uploads/'.$path.'/'.$row->logo_path))
                            <img src="{{ asset('uploads/'.$path.'/'.$row->logo_path) }}" class="img-fluid setting-image" alt="{{ __('field_site_logo') }}">
                            <div class="clearfix"></div>
                            @endif
                            @endif

                            <label for="logo">{{ __('field_site_logo') }}: <span>{{ __('image_size', ['height' => 80, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="logo" id="logo">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_site_logo') }}
                            </div>
                        </div>

                        <div class="form-group col-md-6">

                            @if(isset($row->favicon_path))
                            @if(is_file('uploads/'.$path.'/'.$row->favicon_path))
                            <img src="{{ asset('uploads/'.$path.'/'.$row->favicon_path) }}" class="img-fluid setting-image" alt="{{ __('field_site_favicon') }}">
                            <div class="clearfix"></div>
                            @endif
                            @endif

                            <label for="favicon">{{ __('field_site_favicon') }}: <span>{{ __('image_size', ['height' => 64, 'width' => 64]) }}</span></label>
                            <input type="file" class="form-control" name="favicon" id="favicon">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_site_favicon') }}
                            </div>
                        </div>

                        
                        </hr>
                        <div class="form-group col-md-6">
                            <label for="phone">{{ __('field_phone') }} <span>*</span></label>
                            <input type="text" class="form-control" name="phone" id="currency" value="{{ isset($row->phone)?$row->phone:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_phone') }}
                            </div>
                        </div>
                        
                            <div class="form-group col-md-6">
                            <label for="email">{{ __('field_email') }} <span>*</span></label>
                            <input type="text" class="form-control" name="email" id="currency" value="{{ isset($row->email)?$row->email:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_email') }}
                            </div>
                            </div>
                            
                            
                            
    <div class="form-group col-md-12">
                            <label for="address">{{ __('field_address') }} <span>*</span></label>
                            <input type="text" class="form-control" name="address" id="currency" value="{{ isset($row->address)?$row->address:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_address') }}
                            </div>
                            </div>
                            
                             <div class="form-group col-md-6">
                            <label for="facebook_url">{{ __('field_facebook_url') }} <span>*</span></label>
                            <input type="text" class="form-control" name="facebook_url" id="currency" value="{{ isset($row->facebook_url)?$row->facebook_url:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_facebook_url') }}
                            </div>
                        </div>
                        
                            <div class="form-group col-md-6">
                            <label for="twitter_url">{{ __('field_twitter_url') }} <span>*</span></label>
                            <input type="text" class="form-control" name="twitter_url" id="currency" value="{{ isset($row->twitter_url)?$row->twitter_url:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_twitter_url') }}
                            </div>
                            </div>
                            
                            
                            
    <div class="form-group col-md-6">
                            <label for="instgram_url">{{ __('field_instgram_url') }} <span>*</span></label>
                            <input type="text" class="form-control" name="instgram_url" id="currency" value="{{ isset($row->instgram_url)?$row->instgram_url:'' }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_instgram_url') }}
                            </div>
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{ __('btn_update') }}</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection