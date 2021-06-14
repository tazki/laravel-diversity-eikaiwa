@extends('layouts.landing')

@section('content')
<div class="fh5co-loader"></div>
	
<div id="page">
	@include('includes.header-landing')

	<aside id="fh5co-hero">
		<div class="flexslider">
			<ul class="slides">
		   	<li style="background-image: url({{ secure_asset('site/images/img_home_bg_1.jpg') }} );">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1>{{ __('Let\'s talk English online') }}</h1>
								<h2>{{ __('Man to Man lesson') }}</h2>
								<p><a class="btn btn-primary btn-lg" href="{{ route('page_register') }}">{{ __('2x free trial lesson') }}</a></p>
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
				<p>{{ __('At Diversity Eikaiwa, most teachers have years of teaching experience and good track record. We are always giving our best to exceed student’s expectation by giving tailored lesson to them.') }}</p>
				<h4>{{ __('How can we help you?') }}</h4>
				<ul style="padding-left:19px;">
					<li>{{ __('We will provide lessons based on your needs and goals such as increasing your score in TOEIC, TOEFL or want to improve your communication skills in daily or business setting.') }}</li>
					<li>{{ __('We will Provide free consultation through our support if needed by our student(s). (please feel free to message us through our email.)') }}</li>
					<li>{{ __('We will provide exclusive seminars (To be announced through email) that you can use for a lifetime. Examples are presentation, public speaking and other interesting topics will be discussed by experts') }}</li>
				</ul>
			</div>
			<div class="col-md-6">
				<img class="img-responsive" src="{{ secure_asset('site/images/whychooseus_2.png') }}" alt="Diversity Eikaiwa">
			</div>
		</div>
	</div>

	<div class="fh5co-company fh5co-bg-section">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-md-push-1 animate-box">
					<div class="company-info">
						<h3>{{ __('Additional perks of being a Diversity’s student') }}</h3>
						<ul>
							<li>1. {{ __('Free consultation') }}</li>
							<li>2. {!! __('Free exclusive seminars for our students <br>(Students will receive announcements through email)') !!}</li>
							<li>3. {{ __('Lesson materials') }}</li>
							<li>4. {{ __('You can take lessons by using points. There is no expiration date for your points.') }}</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 animate-box">
					<div class="company-info">
						<h3>{{ __('Class flow (May depend on what are the student’s needs and level)') }}</h3>
						<ul>
							<li>1. {{ __('Warm-up') }}</li>
							<li>2. {{ __('Topic discussion') }}</li>
							<li>3. {{ __('Practice') }}</li>
							<li>4. {{ __('Question time/ End of class') }}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="fh5co-company">
		<div class="container">
			<div class="row">
				<div class="col-md-12 animate-box">
					<iframe width="100%" height="415" src="https://www.youtube.com/embed/Dpv0_NVXNdQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>		

	<div class="fh5co-company">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-1 animate-box">
					<div class="company-info">
						<h3>{{ __('How to take a lesson') }}</h3>
						@if(App::isLocale('jp'))
							<img class="img-responsive" src="{{ secure_asset('site/images/how-to-take-lesson-diagram.jpg') }}" alt="Diversity Eikaiwa">
						@else
							<ul>
								<li><strong>{{ __('Step 1') }}</strong><br /> {{ __('Register account.') }}</li>
								<li><strong>{{ __('Step 2') }}</strong><br /> {{ __('Choose a Teacher') }}</li>
								<li><strong>{{ __('Step 3') }}</strong><br /> {{ __('Reserve a class') }}</li>
								<li><strong>{{ __('Step 4') }}</strong><br /> {{ __('Take a class (Skype)') }}</li>
								<li><strong>{{ __('Step 5') }}</strong><br /> {{ __('Choose monthly plan after the lesson') }}</li>
								<li><strong>{{ __('Step 6') }}</strong><br /> {{ __('Register in the monthly plan and take lesson anytime') }}</li>
							</ul>
						@endif
					</div>
				</div>
				<div class="col-md-5 animate-box">
					<div class="company-info">
						<h3>{{ __('What are needed for the lesson?') }}</h3>
						<ul>
							<li>
								{{ __('Phone or Computer') }}
								<br />
								<img class="img-responsive" style="width:40px; display:inline-block;" src="{{ secure_asset('site/images/need_phone.png') }}" alt="Diversity Eikaiwa">
								<img class="img-responsive" style="width:50px; display:inline-block;" src="{{ secure_asset('site/images/need_laptop.png') }}" alt="Diversity Eikaiwa">								
							</li>
							<li>
								{{ __('Internet') }}
								<br />
								<img class="img-responsive" style="width:40px;" src="{{ secure_asset('site/images/need_wifi.png') }}" alt="Diversity Eikaiwa">
							</li>
							<li>
								{{ __('Skype') }}
								<br />
								<img class="img-responsive" style="width:38px;" src="{{ secure_asset('site/images/need_skype.png') }}" alt="Diversity Eikaiwa">
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('includes.pricing-banner')

	@include('includes.register-banner')
    @include('includes.footer-landing')
</div>
@endsection
