@extends('layouts.landing')

@section('content')
<div class="fh5co-loader"></div>
	
<div id="page">
	@include('includes.header-landing')

	<aside id="fh5co-hero">
		<div class="flexslider">
			<ul class="slides">
		   	<li style="background-image: url({{ secure_asset('site/images/img_bg_1.jpg') }} );">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1>{{ __('At Diversity Eikaiwa, we prioritize our Teachers and Students') }}</h1>
								{{-- <h2>Brought to you by <a href="" target="_blank">diversity eikaiwa</a></h2> --}}
								<p><a class="btn btn-primary btn-lg" href="{{ route('page_register') }}">{{ __('Start Learning Now!') }}</a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		   	{{-- <li style="background-image: url({{ secure_asset('site/images/img_bg_2.jpg') }} );">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1>The Great Aim of Education is not Knowledge, But Action</h1>
									<h2>Brought to you by <a href="" target="_blank">diversity eikaiwa</a></h2>
									<p><a class="btn btn-primary btn-lg btn-learn" href="#">Start Learning Now!</a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li> --}}
		  	</ul>
	  	</div>
	</aside>

	{{-- <div id="fh5co-course">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2>Our Course</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 animate-box">
					<div class="course">
						<a href="#" class="course-img" style="background-image: url({{ secure_asset('site/images/project-1.jpg') }} );">
						</a>
						<div class="desc">
							<h3><a href="#">Web Master</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
							<span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>
						</div>
					</div>
				</div>
				<div class="col-md-6 animate-box">
					<div class="course">
						<a href="#" class="course-img" style="background-image: url({{ secure_asset('site/images/project-2.jpg') }} );">
						</a>
						<div class="desc">
							<h3><a href="#">Business &amp; Accounting</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
							<span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>
						</div>
					</div>
				</div>
				<div class="col-md-6 animate-box">
					<div class="course">
						<a href="#" class="course-img" style="background-image: url({{ secure_asset('site/images/project-3.jpg') }} );">
						</a>
						<div class="desc">
							<h3><a href="#">Science &amp; Technology</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
							<span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>
						</div>
					</div>
				</div>
				<div class="col-md-6 animate-box">
					<div class="course">
						<a href="#" class="course-img" style="background-image: url({{ secure_asset('site/images/project-4.jpg') }} );">
						</a>
						<div class="desc">
							<h3><a href="#">Health &amp; Psychology</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
							<span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}

	<div id="fh5co-about">
		<div class="container">
			<div class="col-md-6 animate-box">
				<h2>{{ __('Why choose us?') }}</h2>
				<p>{{ __('At Diversity, we are focusing on developing our teachers, materials and understanding our students needs which is the foundation of our teaching method. One of the advantages of Diversity is that all teachers are living in Japan or had lived in Japan which makes them understand the culture and how they can teach English to the Japanese people.') }}</p>
				<p>{{ __('In addition, we will provide exclusive seminars for our students which other English service provider don’t give. These seminars will focus on building your confidence and other skills that you can use for a lifetime.') }}</p>
			</div>
			<div class="col-md-6">
				<img class="img-responsive" src="{{ secure_asset('site/images/whychooseus.jpg') }}" alt="Diversity Eikaiwa">
			</div>
		</div>
	</div>

	@include('includes.pricing-banner')

	<div class="fh5co-company">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-1 animate-box">
					<div class="company-info">
						<h3>{{ __('What are needed for the lesson?') }}</h3>
						<ul>
							<li>{{ __('Phone or Computer') }}</li>
							<li>{{ __('Internet') }}</li>
							<li>{{ __('Skype') }}</li>
						</ul>
					</div>
				</div>
				<div class="col-md-5 animate-box">
					<div class="company-info">
						<h3>{{ __('How to take a lesson?') }}</h3>
						<ul>
							<li><strong>{{ __('First') }}</strong><br /> {{ __('Download Skype.') }}</li>
							<li><strong>{{ __('Second') }}</strong><br /> {{ __('Register an account.') }}</li>
							<li><strong>{{ __('Third') }}</strong><br /> {{ __('Choose your teacher, time and date.') }}</li>
							<li><strong>{{ __('Fourth') }}</strong><br /> {{ __('Take class on the day and time you booked.') }}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('includes.register-banner')
    @include('includes.footer-landing')
</div>
@endsection
