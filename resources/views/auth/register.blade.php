@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('register') }}" class="auth-form">
    @csrf
    <div class="form-group">
        <label for="client-companyName">{{ __('Company Name') }} <span class="text-danger">*</span></label>
        <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control @error('company_name') is-invalid @enderror" id="client-companyName" required="" autofocus="">
        @error('company_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-addressBuilding">{{ __('Address Building') }}</label>
                <input type="text" name="building" value="{{ old('building') }}" class="form-control" id="client-addressBuilding">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="client-street">{{ __('Street') }}</label>
                <input type="text" name="street" value="{{ old('street') }}" class="form-control" id="client-street">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="client-address">{{ __('Address') }}</label>
        <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="client-address">
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-city">{{ __('City') }}</label>
                <input type="text" name="city" value="{{ old('city') }}" class="form-control" id="client-city">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-province">{{ __('Province') }}</label>
                <input type="text" name="province" value="{{ old('province') }}" class="form-control" id="client-province">
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-zipcode">{{ __('Zipcode') }}</label>
                <input type="text" name="zipcode" value="{{ old('zipcode') }}" class="form-control" id="client-zipcode">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-country">{{ __('Country') }}</label>
                <select name="country_id" class="custom-select js-client-country" id="client-country">
                    <option value=""></option>
                    @php($countries = countryData())
                    @if(is_array($countries))
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" data-countrycode="{{ $country->country_code_1 }}"
                                {{ (old('registration_number')==$country->id) ? 'selected=selected' : '' }}>
                                {{ $country->country_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="client-register-number">{{ __('Registration Number') }}</label>
        <input type="text" name="registration_number" value="{{ old('registration_number') }}" class="form-control" id="client-register-number">
    </div>

    <div class="form-group">
        <label for="client-GSTnumber">{{ __('GST number') }}</label>
        <input type="text" name="gist_number" value="{{ old('gist_number') }}" class="form-control" id="client-GSTnumber">
    </div>

    <div class="form-group">
        <label for="client-mobilePhone">{{ __('Mobile Phone') }} <span class="text-danger">*</span></label>
        <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" class="form-control @error('mobile_number') is-invalid @enderror" id="client-mobilePhone" required="">
        @error('mobile_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

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
        <select name="service" class="custom-select" id="client-service" data-toggle="select2" data-placeholder="Select service" disabled="disabled">
            <option value="1">{{ __('Free') }}</option>
            {{-- <option value="2">{{ __('Business') }}</option>
            <option value="3">{{ __('Unlimited') }}</option> --}}
        </select>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="agree" class="custom-control-input js-accept-checkbox" id="client-aggrement" required="">
            <label class="custom-control-label" for="client-aggrement">
                <p class="text-center text-muted mb-0">
                    By creating an account you agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
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
<footer class="auth-footer">© 2020 MOSAIQUE PVT LTD</footer>
@endsection
