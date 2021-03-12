@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('page_register') }}" class="auth-form">
    @csrf

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-first-name">{{ __('First Name') }} <span class="text-danger">*</span></label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" id="client-first-name" required="">
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-last-name">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" id="client-last-name" required="">
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-mobilePhone">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" id="client-mobilePhone" required="">
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-skype_id">{{ __('Skype ID') }} <span class="text-danger">*</span></label>
                <input type="text" name="skype_id" value="{{ old('skype_id') }}" class="form-control @error('skype_id') is-invalid @enderror" id="client-skype_id" required="">
                @error('skype_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="client-email">{{ __('Email') }} <span class="text-danger">*</span></label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="client-email" required="">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-password">{{ __('Password') }} <span class="text-danger">*</span></label>
								<div class="password-visibility js-password-visibility">
									<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="client-password" required="">
									<i class="far fa-eye js-togglePassword"></i>
								</div>
								@error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-confirm-password">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" id="client-confirm-password" required="">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="client-service">{{ __('Service') }} <span class="text-danger">*</span></label>
        <select name="service" class="custom-select" id="client-service" data-toggle="select2" data-placeholder="Select service">
            <option value="1">{{ __('Trial') }}</option>
            {{-- <option value="2">{{ __('Silver') }}</option>
            <option value="3">{{ __('Gold') }}</option> --}}
        </select>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="agree" class="custom-control-input js-accept-checkbox" id="client-aggrement" required="">
            <label class="custom-control-label" for="client-aggrement">
                <p class="text-center text-muted mb-0">
                    By creating an account you agree to the <a href="{{ route('page_terms') }}" target="_blank">Terms and Condition</a>.
                </p>
            </label>
            <div class="invalid-feedback">
                {{ __('Accept our terms of use and privacy policy') }}
            </div>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Sign Up') }}</button>
    </div>

    {{-- DISPLAY THIS ON CONFIRMATION AFTER SIGNUP --}}
    {{-- ADD class d-none to hide d-block to show --}}
    <div class="form-row d-none">
        <div class="col-md-6">
            <div class="form-group">
                <button class="btn btn-lg btn-secondary btn-block" type="button">{{ __('Back') }}</button>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Confirm') }}</button>
            </div>
        </div>
    </div>
</form>
<footer class="auth-footer">© 2021 DIVERSITY EIKAIWA</footer>
@endsection
