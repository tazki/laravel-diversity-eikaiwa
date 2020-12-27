@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('admin_reset_password_without_token') }}" class="auth-form">
    @csrf
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="text-center mt-0 mb-4">
        <h1 class="h3"> {{ __('Reset Your Password') }} </h1>
    </div>
    <p class="mb-4 text-center">{{ __('We\'ll send password reset link to your email') }}</p>
    <div class="form-group mb-4">
        <label class="d-block text-left" for="forgotpassword-email">{{ __('E-Mail Address') }}</label>
        <input id="forgotpassword-email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="d-block d-md-inline-block mb-2">
        <button class="btn btn-lg btn-block btn-primary" type="submit">{{ __('Send Password Reset Link') }}</button>
    </div>
    <div class="d-block d-md-inline-block">
        <a href="{{ url('admin/login') }}" class="btn-link">{{ __('Return to signin') }}</a>
    </div>
</form>
<footer class="auth-footer">© 2020 MOSAIQUE PVT LTD.</footer>
@endsection
