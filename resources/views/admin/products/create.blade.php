@extends('admin.layouts.master')
@section('title', 'إاضافة منتج')
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12">
                <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>إضافة منتج جديد</h5>
                        </div>
                        <div class="card-block">
                            <a href="{{ route($route.'.index') }}" class="btn btn-rounded btn-info">{{ __('btn_back') }}</a>
                        </div>
                        <div class="card-block">
                            <div class="form-group">
                                <label for="name" class="form-label">إسم المنتج <span>*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} إسم المنتج
                                </div>
                            </div>
                            
                                   <div class="form-group col-md-12">
                            <label for="company_id">الشركة <span>*</span></label>
                            <select class="form-control select2" name="company_id" id="company_id" required>
                                <option value="">{{ __('select') }}</option>
                                @foreach( $companies as $company )
                                <option value="{{ $company->id }}" @if(old('company_id') == $company->id) selected @endif>{{ $company->name }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_company') }}
                            </div>
                        </div>

                            
                            
                            <div class="form-group col-md-12">
                            <label for="section">القسم  <span>*</span></label>
                            <select class="form-control select2-multiple sectionobj" name="section_id" id="section" required  >
                                <option value="">{{ __('select') }}</option>
                                @foreach( $sections as $section )
                                <option value="{{ $section->id }}" @if(old('section') == $section->id) selected @endif>{{ $section->title }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_section') }}
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <label for="category">الفئة  <span>*</span></label>
                            <select class="form-control select2-multiple categoryObj" name="category_id" id="category" required  >
                              
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_section') }}
                            </div>
                        </div>
                        
                           


                            <div class="form-group">
                                <label for="price" class="form-label">
                                     السعر
                                </label>
                                <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('price') }}
                                </div>
                            </div>
                            
                                <div class="form-group">
                                <label for="discount" class="form-label">السعر بعد الخصم أن وجد </label>
                                <input type="text" class="form-control" name="discount" id="discount" value="{{ old('discount') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('discount') }}
                                </div>
                            </div>
                            
                               <div class="form-group">
                        <label for="status" class="form-label">

الحالة                      </label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" @if( old('status') == 1 ) selected @endif> {{__('status_active')}} </option>
                            <option value="0" @if( old('status')  == 0 ) selected @endif>{{__('status_inactive')}} </option>
                        </select>
                    </div>
                    
                      <div class="form-group">
                                <label for="supplier_price" class="form-label">
                                     السعر من الموردد 
                                </label>
                                <input type="text" class="form-control" name="supplier_price" id="supplier_price" value="{{ old('supplier_price') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('supplier_price') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gomalla_price" class="form-label">
                                     السعر بالجملة  
                                </label>
                                <input type="text" class="form-control" name="gomalla_price" id="gomalla_price" value="{{ old('gomalla_price') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('gomalla_price') }}
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="carton_price" class="form-label">
                                     السعر  بالكرتونة 
                                </label>
                                <input type="text" class="form-control" name="carton_price" id="carton_price" value="{{ old('carton_price') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('carton_price') }}
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label for="quantity" class="form-label">
                                       الكمية 
                                </label>
                                <input type="number" class="form-control" name="quantity" id="quantity" value="{{ old('quantity') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('quantity') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="max_order_quantity" class="form-label">
                                       أقصى كمية للطلب 
                                </label>
                                <input type="number" class="form-control" name="max_order_quantity" id="max_order_quantity" value="{{ old('max_order_quantity') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('max_order_quantity') }}
                                </div>
                            </div>
                            
                            
                             <div class="form-group col-md-12">


                            <label for="logo">الصورة الأساسية للمنتج  <span>{{ __('image_size', ['height' => 80, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="img" id="img">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('image') }}
                            </div>
                        </div>
                        
                         <div class="form-group col-md-12">


                            <label for="photos">صور المتج     <span>{{ __('image_size', ['height' => 80, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="photos[]" id="photos" multiple >

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('image') }}
                            </div>
                        </div>
                         
                       

                         <div class="form-group col-md-12">
                            <label for="about">وصف المنتج </label>
                            <textarea class="form-control texteditor" name="description" id="description">{{ old('description') }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_description') }}
                            </div>
                        </div>
                       
                        </div>
                     
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">{{ __('btn_save') }}</button>
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