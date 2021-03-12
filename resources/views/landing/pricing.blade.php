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
								<h1 class="heading-section">Plan &amp; Pricing</h1>
								<h2>Diversity Eikaiwa</h2>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>

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
	                     <a href="{{ route('page_register') }}" class="pricing__action">Choose plan</a>
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
	                     <a class="pricing__action" disabled>Coming Soon</a>
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
							<span class="pricing__currency">¥</span>13,310
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
	                     <a class="pricing__action" disabled>Coming Soon</a>
                     </div>
                  </div>
               </div>
            </div>
			</div>
		</div>
	</div>

	@include('includes.register-banner')
    @include('includes.footer-landing')
</div>
@endsection
