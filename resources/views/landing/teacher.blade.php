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
			   					<h1 class="heading-section">Our Faculty</h1>
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
				<div class="col-md-3 text-center">
					<div class="staff">
						<div class="staff-img" style="background-image: url({{ secure_asset('site/images/staff-1.jpg') }} );">
							<!-- <ul class="fh5co-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-dribbble2"></i></a></li>
								<li><a href="#"><i class="icon-github"></i></a></li>
							</ul> -->
						</div>
						<span>English Teacher</span>
						<h3><a href="#">Rossel Sensei</a></h3>
						<p>A teacher with 5 years teaching experience and current English teacher in Junior High School, I’m confident that I will be able to assist and support you in your learning.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-register" style="background-image: url({{ secure_asset('site/images/img_bg_2.jpg') }} );">
		<div class="overlay"></div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2 animate-box">
				<div class="date-counter text-center">
					<h2>Register now and have a free trial lesson</h2>
					<!-- <h3>By Mike Smith</h3> -->
					<div class="simply-countdown simply-countdown-one"></div>
					<p><strong>Limited Offer, Hurry Up!</strong></p>
					<p><a href="#" class="btn btn-primary btn-lg btn-reg">Register Now!</a></p>
				</div>
			</div>
		</div>
	</div>

    @include('includes.footer-landing')
</div>
@endsection
