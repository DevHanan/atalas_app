@extends('auth.layouts.master')
@section('title','تسجيل الدخول')
@section('content')

<!-- Start Content-->
<div class="card">
    <div class="card-body text-center">
        <div class="mb-4">
            <i class="feather icon-unlock auth-icon"></i>
        </div>
        <h3 class="mb-4">تسجيل الدخول </h3>


        <!-- Form Start -->
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="إسم المستخدم" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-4">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="كلمة المرور">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group" style="text-align:right;">
                <div class="checkbox checkbox-fill d-inline">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="cr" for="remember">
                       تذكرنى
                    </label>
                </div>
            </div>
            <input type="submit" class="btn btn-primary shadow-2 mb-4" name="submit" value="تسجيل الدخول">
        </form>
        <!-- Form End -->

    </div>
</div>
<!-- End Content-->

@endsection
