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
			   					<h1 class="heading-section">About Us</h1>
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
				<span>About Our University</span>
				<h2>Welcome to Diversity Eikaiwa</h2>
				<p>Diversity Eikaiwa started with a friend who wants to learn the English language and grew because of the positive word of mouth. At Diversity, we are not just teaching English but, we are teaching practical skills that you can use in your everyday life.</p>
				<p>Also, we are focused on building good relationships and delivering services beyond what is promised by sharing our own personal experiences that would help you to become a better communicator.</p>
				<p>At Diversity, we are sharing diverse experiences, knowledge, and skills that you can use in a diverse way.</p>
			</div>
			<div class="col-md-6">
				<img class="img-responsive" src="{{ secure_asset('site/images/about-us.jpg') }}" alt="Diversity Eikaiwa">
			</div>
		</div>
	</div>

	<div id="fh5co-gallery" class="fh5co-bg-section">
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
	</div>

    @include('includes.footer-landing')
</div>
@endsection
