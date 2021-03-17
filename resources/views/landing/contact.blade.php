@extends('layouts.landing')

@section('content')
<div class="fh5co-loader"></div>
	
<div id="page">
	@include('includes.header-landing')

	<aside id="fh5co-hero">
		<div class="flexslider">
			<ul class="slides">
		   	<li style="background-image: url({{ secure_asset('site/images/img_bg_4.jpg') }});">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1 class="heading-section">{{ __('Contact Us') }}</h1>
								<h2>Diversity Eikaiwa</h2>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>

	<div id="fh5co-contact">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-1 animate-box">
					<div class="fh5co-contact-info">
						<h3>{{ __('Contact Information') }}</h3>
						<ul>
							<li class="address">{{ __('Level 7, Wakamatsu Building, 3-3-6 Nihonbashi-Honcho, Chuo-Ku, Tokyo 103-0023 Japan') }}</li>
							<li class="phone"><a href="tel://03-6202-7083">03 6202 7083</a></li>
							<li class="email"><a href="mailto:diversityeikaiwa2021@gmail.com">diversityeikaiwa2021@gmail.com</a></li>
							<li class="url"><a href="{{ route('page_home') }}">diversityeikaiwa.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-5 animate-box">
					<h3>{{ __('Get In Touch') }}</h3>
					<form method="POST" id="contactForm" action="{{ route('page_contact') }}" class="auth-form">
						@csrf
						<div class="row form-group">
							<div class="col-md-6">
								<!-- <label for="fname">First Name</label> -->
								<input type="text" name="first_name" value="{{ old('first_name') }}" id="fname" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ __('First Name') }}">
								@error('first_name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-6">
								<!-- <label for="lname">Last Name</label> -->
								<input type="text" name="last_name" value="{{ old('last_name') }}" id="lname" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ __('Last Name') }}">
								@error('last_name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="email">Email</label> -->
								<input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}">
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="subject">Subject</label> -->
								<input type="text" name="subject" value="{{ old('subject') }}" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="{{ __('Subject of this message') }}">
								@error('subject')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="message">Message</label> -->
								<textarea name="message" id="message" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" placeholder="{{ __('Say something about us') }}">{{ old('message') }}</textarea>
								@error('message')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-lg btn-primary btn-block" onclick="validateForm();">{{ __('Send Message') }}</button>
						</div>
					</form>
					<script>
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
										document.getElementById("contactForm").submit();
									} else {
										alert('Robots detected need to reload page');
										location.reload();
									}
								});
							});
						});
					}
					</script>
				</div>
			</div>
		</div>
	</div>
	{{-- <div id="map" class="fh5co-map"></div> --}}

	@include('includes.register-banner')
    @include('includes.footer-landing')
</div>
@endsection
