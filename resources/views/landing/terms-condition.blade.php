@extends('layouts.landing')

@section('content')
<div class="fh5co-loader"></div>
	
<div id="page">
	@include('includes.header-landing')

    <div id="fh5co-about">
        <div class="container">
            <div class="col-md-12 animate-box">
                <h2>{{ __('Terms and Condition') }}</h2>
                <p>{{ __('Students can cancel their booked lesson within 24 hours before their lesson. If students forgot to cancel their booked lesson, it will be credited as one lesson even if students do not show up and Diversity Eikaiwa will not be able to refund the missed lesson by the students because of the no refund policy. With regards to refund policy, consumable credits don’t have expiration dates which means that the remaining credits must/can be used in case that the student/client want to quit as Diversity Eikaiwa don’t have a refund policy.') }}</p>
                <p>{{ __('In connection to quitting, students can unsubscribe before their subscription date renew the user’s credits. Also, as mentioned in the monthly subscription plan, it will automatically deduct 7,480 yen/13,310 yen depending on the plan that the student had chosen, or they should pay it via convenient stores, or their accounts will be deactivated.') }}</p>
            </div>
        </div>
    </div>

    @include('includes.footer-landing')
</div>
@endsection
