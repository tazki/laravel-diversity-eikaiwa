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
			   					<h1>The Roots of Education are Bitter, But the Fruit is Sweet</h1>
									<h2>Brought to you by <a href="" target="_blank">diversity eikaiwa</a></h2>
									<p><a class="btn btn-primary btn-lg" href="#">Start Learning Now!</a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url({{ secure_asset('site/images/img_bg_2.jpg') }} );">
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
		   	</li>
		   	<li style="background-image: url({{ secure_asset('site/images/img_bg_3.jpg') }} );">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1>We Help You to Learn New Things</h1>
									<h2>Brought to you by <a href="" target="_blank">diversity eikaiwa</a></h2>
									<p><a class="btn btn-primary btn-lg btn-learn" href="#">Start Learning Now!</a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>		   	
		  	</ul>
	  	</div>
	</aside>

	<div id="fh5co-course">
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
	</div>

	<div id="fh5co-pricing" class="fh5co-bg-section">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2>Plan &amp; Pricing</h2>
					<p>50% off if you register on the same day after trial lesson.</p>
				</div>
			</div>
			<div class="row">
				<div class="pricing pricing--rabten">
					<div class="col-md-4 animate-box">
						<div class="pricing__item">
							<div class="wrap-price">
								 <!-- <div class="icon icon-user2"></div> -->
	                     <h3 class="pricing__title">Trial</h3>
	                     <!-- <p class="pricing__sentence">Single user license</p> -->
							</div>
                     <div class="pricing__price">
                        <span class="pricing__anim pricing__anim--1">
							<span class="pricing__currency">¥</span>0
                        </span>
                        <span class="pricing__anim pricing__anim--2">
								<span class="pricing__period">Free Trial</span>
                        </span>
                     </div>
                     <div class="wrap-price">
                     	<ul class="pricing__feature-list">
	                        <li class="pricing__feature">1 lesson</li>
	                        <li class="pricing__feature">Max of 1 student</li>
	                        <li class="pricing__feature">45 minutes duration</li>
	                     </ul>
	                     <button class="pricing__action">Choose plan</button>
                     </div>
                  </div>
					</div>
					<div class="col-md-4 animate-box">
						<div class="pricing__item">
							<div class="wrap-price">
								<!-- <div class="icon icon-store"></div> -->
	                     <h3 class="pricing__title">Silver</h3>
	                     <!-- <p class="pricing__sentence">Up to 5 users</p> -->
							</div>
                     <div class="pricing__price">
                        <span class="pricing__anim pricing__anim--1">
							<span class="pricing__currency">¥</span>7,480
                        </span>
                        <span class="pricing__anim pricing__anim--2">
							<span class="pricing__period">Tax Included</span>
                        </span>
                     </div>
                     <div class="wrap-price">
                     	<ul class="pricing__feature-list">
	                        <li class="pricing__feature">4 lessons per month</li>
	                        <li class="pricing__feature">Max of 2 students</li>
	                        <li class="pricing__feature">45 minutes per lesson</li>
	                     </ul>
	                     <button class="pricing__action">Choose plan</button>
                     </div>
                 </div>
					</div>
					<div class="col-md-4 animate-box">
                  <div class="pricing__item">
                  	<div class="wrap-price">
                  		<!-- <div class="icon icon-home2"></div> -->
	                     <h3 class="pricing__title">Gold</h3>
	                     <!-- <p class="pricing__sentence">Unlimited users</p> -->
							</div>
                     <div class="pricing__price">
                        <span class="pricing__anim pricing__anim--1">
							<span class="pricing__currency">¥</span>13,3310
                        </span>
                        <span class="pricing__anim pricing__anim--2">
							<span class="pricing__period">Tax Included</span>
                        </span>
                     </div>
                     <div class="wrap-price">
                     	<ul class="pricing__feature-list">
	                        <li class="pricing__feature">8 lessons per month</li>
	                        <li class="pricing__feature">Max of 2 students</li>
	                        <li class="pricing__feature">45 minutes per lesson</li>
	                     </ul>
	                     <button class="pricing__action">Choose plan</button>
                     </div>
                  </div>
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
