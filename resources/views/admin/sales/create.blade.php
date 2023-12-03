@extends('admin.layouts.master')
@section('title', trans('module_staff'))

@section('page_css')
    <!-- Wizard css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/wizard.css') }}">
@endsection

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
                        <h5> مندب مبيعات     </h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-rounded btn-primary">{{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.create') }}" class="btn btn-rounded btn-info">{{ __('btn_refresh') }}</a>
                    </div>

                    <div class="wizard-sec-bg">
                    <form id="" class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data" >
                    @csrf

                        <h3> </h3>
                        <content class="form-step">
                            <!-- Form Start -->
                            <div class="row">
                            <fieldset class="row scheduler-border">
                           

                            <div class="form-group col-md-6">
                                <label for="name">  {{ __('field_name') }} <span>*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }}  {{ __('field_name') }}
                                </div>
                            </div>
                               <div class="form-group col-md-6">
                                <label for="email">{{ __('field_email') }} <span>*</span></label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_email') }}
                                </div>
                            </div>
      <div class="form-group col-md-6">
                                <label for="password">{{ __('field_password') }} <span>*</span></label>
                                <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_password') }}
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="password_confirmation">{{ __('field_password') }} <span>*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_password_confirmation') }}
                                </div>
                            </div>
                            

                               
                            <div class="form-group col-md-6">
                            <label for="province">المدينة  <span>*</span></label>
                            <select class="form-control select2-multiple provinceobj" name="province_id" id="province" required  >
                                <option value="">{{ __('select') }}</option>
                                @foreach( $provinces as $province )
                                <option value="{{ $province->id }}" @if(old('province_id') == $province->id) selected @endif>{{ $province->title }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_province') }}
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="district">المنطقة  <span>*</span></label>
                            <select class="form-control select2-multiple districtObj" name="district_id" id="district" required  >
                              
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_province') }}
                            </div>
                        </div>

                            
                      

                         
                            <div class="form-group col-md-6">
                                <label for="phone">{{ __('field_phone') }} <span>*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_phone') }}
                                </div>
                            </div>
                            
                      
                            
                            </hr>
                          
                            
                           
                            </fieldset>
                            <div class="col-md-6">
                                             <button type="submit" class="btn btn-primary"> حقظ </button>

                            </div>

                            <!-- Form End -->
                        </content>

                    </form>
                    </div>
                    </content>
                    </form>
                    
                </div>
            </div>
            
            <!-- [ Card ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
</div>
<!-- End Content-->

@endsection

@section('page_js')
    <!-- validate Js -->
    <script src="{{ asset('dashboard/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

    <!-- Wizard Js -->
    <script src="{{ asset('dashboard/js/pages/jquery.steps.js') }}"></script>

    <script type="text/javascript">
        "use strict";
        var form = $("#wizard-advanced-form").show();

        form.steps({
            headerTag: "h3",
            bodyTag: "content",
            transitionEffect: "slideRight",
           
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                $("#wizard-advanced-form").submit();
            }
        }).validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {

            }
        });
        $("a[href$='previous']").hide();

    </script>
    <style>
        a#wizard-advanced-form-t-0{
            display:none !important;
        }
    </style>

  
@endsection