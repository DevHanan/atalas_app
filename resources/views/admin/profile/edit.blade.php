<!-- [ Main Content ] start -->
<div class="row">
    <div class="col-md-12">
        <form class="needs-validation" novalidate action="{{ route($route.'.update', [$row->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <!-- Form Start -->
            <div class="row">
            <div class="form-group col-md-4">
                <label for="first_name"> {{ __('field_name') }}<span>*</span></label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $row->first_name }}" required>

                <div class="invalid-feedback">
                  {{ __('required_field') }}  {{ __('field_name') }}
                </div>
            </div>

           

 <div class="form-group col-md-4">
                <label for="email">{{ __('field_email') }}</label>
                <input type="text" class="form-control" name="email" id="photo" value="{{ $row->email }}">

                <div class="invalid-feedback">
                  {{ __('required_email') }} {{ __('field_email') }}
                </div>
            </div>


            <div class="form-group col-md-4">
                <label for="photo">{{ __('field_photo') }}</label>
                <input type="file" class="form-control" name="photo" id="photo" value="{{ old('photo') }}">
  @if(is_file('uploads/'.$path.'/'.$row->photo))
      <img src="{{ asset('uploads/'.$path.'/'.$row->photo) }}" class="card-img-top img-fluid profile-thumb" alt="{{ __('field_photo') }}" onerror="this.src='{{ asset('dashboard/images/user/avatar-1.jpg') }}';">
     
      
      @endif
                <div class="invalid-feedback">
                  {{ __('required_field') }} {{ __('field_photo') }}
                </div>
            </div>

            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success">{{ __('btn_update') }}</button>
            </div>
            <div class="clearfix"></div>
            </div>
            <!-- Form End -->
        </form>
    </div>
</div>
<!-- [ Main Content ] end -->