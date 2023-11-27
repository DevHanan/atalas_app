<!-- [ Main Content ] start -->
<div class="row">
    <div class="col-md-8">
        <div class="card-header">
          <h5>تعديل كلمة السر</h5>
        </div>
        <div class="card-body">
          <!-- Form Start -->
          <form class="needs-validation" novalidate action="{{ route($route.'.changepass') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">كلمة السر القديمة <span>*</span></label>

                <div class="col-md-6">
                    <input id="old_password" type="text" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="old_password" value="{{auth()->user()->plain_password}}">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="invalid-feedback">
                      {{ __('required_field') }} {{ __('field_old_password') }}
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right"> كلمة السر الجديدة <span>*</span></label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="invalid-feedback">
                      {{ __('required_field') }} {{ __('field_new_password') }}
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تأكيد كلمة السر الجديدة <span>*</span></label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="invalid-feedback">
                    {{ __('required_field') }} {{ __('field_confirm_password') }}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">{{ __('btn_change') }}</button>
                </div>
            </div>

          </form>
          <!-- Form End -->
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->