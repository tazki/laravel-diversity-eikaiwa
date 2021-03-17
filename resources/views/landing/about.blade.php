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
			   					<h1 class="heading-section">{{ __('About Us') }}</h1>
								<h2>Diversity Eikaiwa</h2>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>

	<div id="fh5co-about">
		<div class="container">
			<div class="col-md-6 animate-box">
				<span>{{ __('About Us') }}</span>
				<h2>{{ __('Welcome to Diversity Eikaiwa') }}</h2>
				<p>{{ __('Diversity Eikaiwa started with a friend who wants to learn the English language and grew because of the positive word of mouth. At Diversity, we are not just teaching English but, we are teaching practical skills that you can use in your everyday life. Also, we are focused on building good relationships and delivering services beyond what is promised by sharing our own personal experiences that would help you to become a better communicator. At Diversity, we are sharing diverse experiences, knowledge, and skills that you can use in a diverse way.') }}</p>
			</div>
			<div class="col-md-6">
				<img class="img-responsive" src="{{ secure_asset('site/images/about-us.jpg') }}" alt="Diversity Eikaiwa">
			</div>
		</div>
	</div>

	<div class="fh5co-company">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-1 animate-box">
					<div class="company-info">
						<h3>{{ __('Company Details') }}</h3>
						<ul>
							<li><strong>{{ __('Company Name') }}:</strong> DiversityEikaiwa</li>
							<li><strong>{{ __('Postal Code') }}:</strong> 103-0023</li>
							<li><strong>{{ __('Address') }}:</strong> {{ __('Level 7, Wakamatsu Building, 3-3-6 Nihonbashi-Honcho, Chuo-Ku, Tokyo 103-0023 Japan') }}</li>
							<li><strong>{{ __('President CEO') }}:</strong> Oliver Rivera</li>
							<li><strong>{{ __('Phone') }}:</strong> <a href="tel://03-6202-7083">03 6202 7083</a></li>
							<li><strong>{{ __('Company URL') }}:</strong> <a href="{{ route('page_home') }}">https://diversityeikaiwa.com</a></li>
							<li><strong>{{ __('Content of Company Business') }}:</strong> {{ __('E-learning') }}</li>
						</ul>
					</div>
				</div>
				<div class="col-md-5 animate-box">
					<div class="company-info">
						<h3>&nbsp;</h3>
						<ul>
							<li><strong>{{ __('Type of Business') }}</strong> {{ __('Education') }}</li>
							<li><strong>{{ __('Number of Employees') }}:</strong> 5</li>
							<li><strong>{{ __('Recent Annual Sales') }}:</strong> 0 yen</li>
							<li><strong>{{ __('Company Foundation Date') }}:</strong> 2021/03/01</li>
							<li><strong>{{ __('Corporation/Sole proprietorship') }}:</strong> {{ __('Sole proprietorship') }}</li>
							<li><strong>{{ __('Japanese Subsidiary Address') }}:</strong> {{ __('2-15-5, mervielle 201') }}</li>
							<li><strong>{{ __('Japanese Subsidiary Phone Number') }}:</strong> 08011281815</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="fh5co-company">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-1 animate-box">
					<div class="company-info">
						<h3>{{ __('Payment Methods') }}</h3>
						<ul>
							<li>{{ __('Bank Transfer') }}</li>
							<li>{{ __('Credit Card') }}</li>
							<li>{{ __('Konbini') }}</li>
							<li>{{ __('Pay Easy') }}</li>
						</ul>
					</div>
				</div>
				<div class="col-md-5 animate-box">
					<div class="company-info">
						<h3>{{ __('Integration') }}</h3>
						<ul>
							<li>{{ __('API') }}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- <div id="fh5co-about">
		<div class="container">
			<div class="col-md-6 animate-box">
				<h2>{{ __('What is Diversity way?') }}</h2>
				<p>{{ __('Diversity way, is a way of learning not just from your teacher but also from your peers such as your classmates. At Diversity, we encourage our students to be more pro-active in sharing their experience and knowledge.') }}</p>
			</div>
			<div class="col-md-6">
				<img class="img-responsive" src="{{ secure_asset('site/images/whychooseus.jpg') }}" alt="Diversity Eikaiwa">
			</div>
		</div>
	</div> --}}

	{{-- <div id="fh5co-gallery" class="fh5co-bg-section">
		<div class="row text-center">
			<h2><span>Instagram Gallery</span></h2>
		</div>
		<div class="row">
			<div class="col-md-3 col-padded">
				<a href="#" class="gallery" style="background-image: url({{ secure_asset('site/images/project-5.jpg') }};"></a>
			</div>
			<div class="col-md-3 col-padded">
				<a href="#" class="gallery" style="background-image: url({{ secure_asset('site/images/project-2.jpg') }};"></a>
			</div>
			<div class="col-md-3 col-padded">
				<a href="#" class="gallery" style="background-image: url({{ secure_asset('site/images/project-3.jpg') }};"></a>
			</div>
			<div class="col-md-3 col-padded">
				<a href="#" class="gallery" style="background-image: url({{ secure_asset('site/images/project-4.jpg') }};"></a>
			</div>
		</div>
	</div> --}}

    @include('includes.footer-landing')
</div>
@endsection
