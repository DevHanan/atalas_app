    @extends('admin.layouts.master')
@section('title', 'تعديل بيانات المنتج')
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
    <!-- Edit modal content -->
  <div class="col-md-12">
              <form class="needs-validation" novalidate action="{{ route($route.'.update',$row) }}"   method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                <div class="card-header">
                    <h5 class="card-title" id="myModalLabel">
تعديل بيانات المنتج
                    </h5>
                  
                </div>
                <div class="card-body">
                    <!-- Form Start -->
                    <div class="form-group">
                        <label for="name" class="form-label">إسم المنتج <span>*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $row->name }}" required>

                        <div class="invalid-feedback">
                          مطلوب إسم المنتج
                        </div>
                    </div>
                    
                  
                    <div class="form-group col-md-12">
                            <label for="company_id">الشركة <span>*</span></label>
                            <select class="form-control select2" name="company_id" id="company_id" required>
                                <option value="">{{ __('select') }}</option>
                                @foreach( $companies as $company )
                                <option value="{{ $company->id }}" @if($row->company_id == $company->id) selected @endif>{{ $company->name }}</option>
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
                                <option value="{{ $section->id }}" @if($row->section_id == $section->id) selected @endif>{{ $section->title }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_section') }}
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <label for="category">الفئة  <span>*</span></label>
                            <select class="form-control select2-multiple categoryObj" name="category_id" id="category" required  >
                            @foreach( $category as $categoryrow )
                                <option value="{{ $categoryrow->id }}">{{ $categoryrow->title }}</option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_section') }}
                            </div>
                        </div>

 <div class="form-group">
                                <label for="price" class="form-label">
                                     السعر
                                </label>
                                <input type="number" class="form-control" name="price" id="price" value="{{ $row->price }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('price') }}
                                </div>
                            </div>
                            
                                <div class="form-group">
                                <label for="discount" class="form-label">السعر بعد الخصم أن وجد </label>
                                <input type="text" class="form-control" name="discount" id="discount" value="{{ $row->discount }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('discount') }}
                                </div>
                            </div>
                            
             
                            <div class="form-group">
                        <label for="status" class="form-label">{{ __('select_status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" @if( $row->status == 1 ) selected @endif>{{ __('status_active') }}</option>
                            <option value="0" @if( $row->status == 0 ) selected @endif>{{ __('status_inactive') }}</option>
                        </select>
                    </div>

                            <div class="form-group">
                                <label for="supplier_price" class="form-label">
                                     السعر من الموردد 
                                </label>
                                <input type="text" class="form-control" name="supplier_price" id="supplier_price" value="{{ $row->supplier_price }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('supplier_price') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gomalla_price" class="form-label">
                                     السعر بالجملة  
                                </label>
                                <input type="text" class="form-control" name="gomalla_price" id="gomalla_price" value="{{ $row->gomalla_price }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('gomalla_price') }}
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="carton_price" class="form-label">
                                     السعر  بالكرتونة 
                                </label>
                                <input type="text" class="form-control" name="carton_price" id="carton_price" value="{{ $row->carton_price }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('carton_price') }}
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label for="quantity" class="form-label">
                                       الكمية 
                                </label>
                                <input type="number" class="form-control" name="quantity" id="quantity" value="{{ $row->quantity }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('quantity') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="max_order_quantity" class="form-label">
                                       أقصى كمية للطلب 
                                </label>
                                <input type="number" class="form-control" name="max_order_quantity" id="max_order_quantity" value="{{ $row->max_order_quantity }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('max_order_quantity') }}
                                </div>
                            </div>
                            
    

                              

                   
                    
                                            <div class="form-group col-md-12">

                            @if(isset($row->img))
                            @if(is_file($row->img))
                            <img src="{{ asset($row->img) }}" class="img-fluid setting-image" alt="{{ __('field_site_logo') }}">
                            <div class="clearfix"></div>
                            @endif
                            @endif

                            <label for="logo">{{ __('image') }}: <span>{{ __('image_size', ['height' => 80, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="img" id="logo">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('image') }}
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">

                       

                             <label for="photos">صور المتج     <span>{{ __('image_size', ['height' => 80, 'width' => 'Any']) }}</span></label>
                            <input type="file" class="form-control" name="photos[]" id="photos[]" multiple >

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('image') }}
                            </div>
                             @if($row->photos)
                            @foreach($row->photos as $photo)



  <img src="{{ asset($photo->path) }}" alt="Snow" style="clear:none;margin:0px 10px;max-height:140px;">
 <a href="{{url('admin/delete-photo/'.$photo->id)}}" style="color:red;left:130px;" >  <i class="fas fa-trash-alt"></i> </a>

                            @endforeach
                            @endif
                        </div>
                        </div>
                        


                    
                    <div class="form-group col-md-12">
                            <label for="about">{{ __('field_about') }}</label>
                            <textarea class="form-control texteditor" name="note" id="description">{!! $row->description !!}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_about') }}
                            </div>
                        </div>
                    <!-- Form End -->
                </div>
                <div class="card-footer">
                    <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('btn_Back') }}</button>-->
                    <button type="submit" class="btn btn-success">{{ __('btn_update') }}</button>
                </div>
                </div>

              </form>
            </div>
       
    </div>
    </div>
    </div>
    @endsection