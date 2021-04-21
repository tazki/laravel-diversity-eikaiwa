@extends('layouts.auth')

@section('content')
<form method="POST" id="registerForm" action="{{ route('page_register') }}" class="auth-form">
    @csrf
    <div class="confirm-title form-row d-none">
        <div class="col-md-12">
            <div class="form-group">
                <h5>{{ __('Please check the information before proceeding') }}</h5>
            </div>
        </div>
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

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-address">{{ __('Address') }} <span class="text-danger">*</span></label>
                <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" id="client-address" required="">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="client-postal_code">{{ __('Postal Code') }} <span class="text-danger">*</span></label>
                <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control @error('postal_code') is-invalid @enderror" id="client-postal_code" required="">
                @error('postal_code')
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
            <option value="2" {!! (isset($row['service']) && $row['service']==2) ? 'selected="selected"' : '' !!}>{{ __('Plan A') }}</option>
            <option value="3" {!! (isset($row['service']) && $row['service']==3) ? 'selected="selected"' : '' !!}>{{ __('Plan B') }}</option>
        </select>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="agree" value="1" class="custom-control-input js-accept-checkbox @error('agree') is-invalid @enderror" id="client-aggrement" required="">
            <label class="custom-control-label" for="client-aggrement">
                <p class="text-center text-muted mb-0">
                    {{ __('I have read the Terms of Service and order the above service') }} <a href="{{ route('page_terms') }}" target="_blank">({{ __('Terms and Condition') }})</a>
                </p>
            </label>
            @error('agree')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ __('Accept our terms of use and privacy policy') }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-row js-continue-holder">
        <div class="col-md-6">
            <div class="form-group">
                <a href="{{ route('page_home') }}" class="btn btn-lg btn-secondary btn-block">{{ __('Cancel') }}</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block js-form-preview">{{ __('Continue') }}</button>
            </div>
        </div>
    </div>

    {{-- DISPLAY THIS ON CONFIRMATION AFTER SIGNUP --}}
    {{-- ADD class d-none to hide d-block to show --}}
    <div class="form-row d-none js-confirm-holder">
        <div class="col-md-6">
            <div class="form-group">
                <button class="btn btn-lg btn-secondary btn-block js-form-back" type="button">{{ __('Back') }}</button>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <button type="button" class="btn btn-lg btn-primary btn-block" onclick="validateForm();">{{ __('Confirm') }}</button>
            </div>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
    $('.js-form-preview').click(function(e) {
        e.preventDefault();
        var error = false;
        $('.form-control').each(function() {
            if($(this).val() == '') {
                error = true;
                $(this).addClass('is-invalid');
            }
        });

        if(!error) {
            $('.confirm-title').removeClass('d-none');
            $('.form-control').removeClass('is-invalid');
            $('.form-control').siblings('.invalid-feedback').remove();
            $('.js-confirm-holder').removeClass('d-none');
            $('.js-continue-holder').addClass('d-none');

            $('.form-control').attr('readonly', 'readonly');
            $('.form-control').css('background-color', '#f6f7f9');
        }
    });
    $('.js-form-back').click(function(e) {
        e.preventDefault();
        $('.js-confirm-holder').addClass('d-none');
        $('.js-continue-holder').removeClass('d-none');
        $('.confirm-title').addClass('d-none');

    $('.form-control').removeAttr('readonly');
    $('.form-control').css('background-color', '#fff');
    });
});

function validateForm() {
    grecaptcha.ready(function() {
        grecaptcha.execute("{!! env('RECAPTCHA_SITE_KEY') !!}", {action: 'submit'}).then(function(token) {
            $.ajax({
                url: "{{ route('page_recaptcha') }}",
                type: "POST",
                dataType: 'json',
                data : {"_token":"{{ csrf_token() }}", "token":token}
            }).done(function (data) {
                console.log(data);
                if(data.success == true) {
                    document.getElementById("registerForm").submit();
                } else {
                    alert('Robots detected need to reload page');
                    location.reload();
                }
            });
        });
    });
}
</script>
<footer class="auth-footer">© 2021 DIVERSITY EIKAIWA</footer>
@endsection
