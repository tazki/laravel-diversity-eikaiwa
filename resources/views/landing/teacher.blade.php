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
				@if(isset($rows) && is_object($rows))
					@foreach($rows as $item)
					<div class="col-md-3 text-center">
						<div class="staff">
							@if(isset($item->avatar) && !empty($item->avatar))
								<div class="staff-img" style="background-image: url({{ userFile($item->avatar, '', $item->id) }});"></div>
							@endif
							<span>{{ __('English Teacher') }}</span>
							<h3>{{ $item->name }}</h3>
							{{-- <h3><a href="#">{{ $item->name }}</a></h3> --}}
							{{-- <p>{{ __('Hello! Welcome to Diversity! Learning English doesn’t need to be stiff and strict. Talking and communicating with a teacher on a relax and enjoyable environment helps you learn English on a natural way. That being said, as a person who learned English as an official second language, I can give you advices and tips that are useful not just academically but in daily lives. As a teacher with 5 years teaching experience and current English teacher in Junior High School, I’m confident that I will be able to assist and support you in your learning.') }}</p> --}}
						</div>
					</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>

	@include('includes.register-banner')
    @include('includes.footer-landing')
</div>
@endsection
