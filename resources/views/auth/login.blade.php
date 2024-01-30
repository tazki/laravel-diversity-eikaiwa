@extends('layouts.auth')

@section('content')
<form method="POST" id="loginForm" action="{{ $row['login_url'] }}" class="auth-form">
    @csrf
    @include('includes.flash-messages')
    <div class="form-group">
        <label for="signin-email">{{ __('Email') }} <span class="text-danger">*</span></label>
        <input id="signin-email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ (!empty($row['email'])) ? $row['email'] : old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="signin-password">{{ __('Password') }} <span class="text-danger">*</span></label>
        <div class="password-visibility js-password-visibility">
            <input id="signin-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ (!empty($row['password'])) ? $row['password'] : '' }}" required autocomplete="current-password">
            <i class="far fa-eye js-togglePassword"></i>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-row my-3">
        <div class="col-md-6">
            <div class="custom-control custom-control-inline custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ (old('remember') || isset($row['email'])) ? 'checked' : '' }}>
                <label class="custom-control-label"
                    for="remember">{{ __('Remember Me') }}</label>
            </div>
        </div>

        <div class="col-md-6">
            {{-- <div class="text-right">
                @if (Route::has('password.request'))
                    <a class="link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div> --}}
        </div>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-lg btn-primary btn-block" onclick="validateForm();">{{ __('Login') }}</button>
    </div>

    {{-- <div class="text-middle-line">or</div>
    <button class="btn btn-lg btn-primary btn-google btn-block" type="submit"><i class="fab fa-google"></i> {{ __('Google') }}</button> --}}
</form>
<script>
function validateForm() {
    grecaptcha.ready(function() {
        document.getElementById("loginForm").submit();
        // grecaptcha.execute("{!! env('RECAPTCHA_SITE_KEY') !!}", {action: 'submit'}).then(function(token) {
        //     $.ajax({
        //         url: "{{ route('page_recaptcha') }}",
        //         type: "POST",
        //         dataType: 'json',
        //         data : {"_token":"{{ csrf_token() }}", "token":token}
        //     }).done(function (data) {
        //         console.log(data);
        //         if(data.success == true) {
        //             document.getElementById("loginForm").submit();
        //         } else {
        //             alert('Robots detected need to reload page');
        //             location.reload();
        //         }
        //     });
        // });
    });
}
</script>
<footer class="auth-footer">© 2021 DIVERSITY EIKAIWA</footer>
@endsection
