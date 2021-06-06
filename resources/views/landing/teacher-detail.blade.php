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
                                @if(!empty($lang->address))
                                    <li><strong>{{ __('Address') }}</strong><br /> {{ $lang->address }}</li>
                                @endif
                                @if(!empty($lang->about_you))
                                    <li><strong>{{ __('About You') }}</strong><br /> {{ $lang->about_you }}</li>
                                @endif
                                @if(!empty($lang->hobbies))
                                    <li><strong>{{ __('Hobbies') }}</strong><br /> {{ $lang->hobbies }}</li>
                                @endif
                                @if(!empty($lang->fields_of_interest))
                                    <li><strong>{{ __('Availability') }}</strong><br /> {{ $lang->fields_of_interest }}</li>
                                @endif
                                @if(!empty($lang->english_level))
                                    <li><strong>{{ __('English Level') }}</strong><br /> {{ $lang->english_level }}</li>
                                @endif
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
