@extends('layouts.landing')

@section('content')
<div class="fh5co-loader"></div>
	
<div id="page">
	@include('includes.header-landing')

	<aside id="fh5co-hero">
		<div class="flexslider">
			<ul class="slides">
		   	<li style="background-image: url({{ secure_asset('site/images/img_bg_4.jpg') }} );">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1 class="heading-section">{{ __('Our Faculty') }}</h1>
								<h2>Diversity Eikaiwa</h2>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>

	<div id="fh5co-staff">
		<div class="container">
			<div class="row">
				@if(isset($row->id))
                    <div class="col-md-4 col-md-push-1 animate-box">
						<div class="staff">
							@if(isset($row->avatar) && !empty($row->avatar))
								<div class="staff-img" style="background-image: url({{ userFile($row->avatar, '', $row->id) }});"></div>
							@endif
							<h3>{{ $row->name }}</h3>
                        </div>
					</div>
                    <div class="col-md-6 col-md-push-1 animate-box">
                        <div class="company-info">
                            <ul>
                                <li><strong>{{ __('Address') }}</strong><br /> {{ $lang->address }}</li>
                                <li><strong>{{ __('About You') }}</strong><br /> {{ $lang->about_you }}</li>
                                <li><strong>{{ __('Hobbies') }}</strong><br /> {{ $lang->hobbies }}</li>
                                <li><strong>{{ __('Fields of Interest') }}</strong><br /> {{ $lang->fields_of_interest }}</li>
                                <li><strong>{{ __('English Level') }}</strong><br /> {{ $lang->english_level }}</li>
                            </ul>
                        </div>
                    </div>
				@endif
			</div>
		</div>
	</div>

	@include('includes.register-banner')
    @include('includes.footer-landing')
</div>
@endsection
