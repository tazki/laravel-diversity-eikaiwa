@extends('layouts.landing')

@section('content')
<div class="fh5co-loader"></div>
	
<div id="page">
	@include('includes.header-landing')

	<div id="fh5co-pricing" class="fh5co-bg-section">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                    <h2>{{ __('Payment') }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="pricing pricing--rabten">
                    @if($row['service_id'] == 2)
                    <div class="col-md-4 animate-box">
                        <div class="pricing__item">
                            <div class="wrap-price">
                                <!-- <div class="icon icon-store"></div> -->
                                 <h3 class="pricing__title">{{ __('Plan A') }}</h3>
                                 <!-- <p class="pricing__sentence">Up to 5 users</p> -->
                            </div>
                            <div class="pricing__price">
                                <span class="pricing__anim pricing__anim--1">
                                    <span class="pricing__currency">¥</span>7,480
                                </span>
                                <span class="pricing__anim pricing__anim--2">
                                    <span class="pricing__period">{{ __('Tax Included') }}</span>
                                </span>
                            </div>
                            <div class="wrap-price">
                                <ul class="pricing__feature-list">
                                    <li class="pricing__feature">{{ __('4 lessons per month (Max of 2 students)') }}</li>
                                    <li class="pricing__feature">{{ __('45 minutes lesson 4x 7,480 yen') }}</li>
                                </ul>
        
                                <form id="planAForm" action="{!! route('page_subscribe') !!}">
                                    <input type="hidden" name="komojuToken"/>
                                    <input type="hidden" name="id" value="{{ $row['id'] }}" />
                                    <button id="planAFormButton" class="pricing__action">{{ __('Pay') }}</button>
                                </form>                        
                                <script>
                                var payForm = document.getElementById("planAForm")
                                var handler = Komoju.multipay.configure({
                                    key: "{!! env('KOMOJU_PUBLISHABLE_KEY') !!}",
                                    token: function(token) {
                                        payForm.komojuToken.value = token.id;
                                        payForm.submit();
                                    }
                                });
                                document.getElementById("planAFormButton").addEventListener("click", function(e) {
                                    handler.open({
                                        amount:       7480,
                                        endpoint:     "https://komoju.com",
                                        locale:       "ja",
                                        currency:     "JPY",
                                        title:        "{!! __('Plan A') !!}",
                                        description:  "{!! __('45 minutes lesson 4x 7,480 yen') !!}",
                                        methods: [
                                            "credit_card"//,"konbini","bank_transfer","pay_easy"
                                        ]
                                    });
        
                                    e.preventDefault();
                                });
                                </script>
                                {{-- <a href="{{ route('page_register').'?service=2' }}" class="pricing__action">{{ __('Choose plan') }}</a> --}}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($row['service_id'] == 3)
                    <div class="col-md-4 animate-box">
                        <div class="pricing__item">
                            <div class="wrap-price">
                                <!-- <div class="icon icon-home2"></div> -->
                                <h3 class="pricing__title">{{ __('Plan B') }}</h3>
                                <!-- <p class="pricing__sentence">Unlimited users</p> -->
                            </div>
                            <div class="pricing__price">
                                <span class="pricing__anim pricing__anim--1">
                                    <span class="pricing__currency">¥</span>13,310
                                </span>
                                <span class="pricing__anim pricing__anim--2">
                                    <span class="pricing__period">{{ __('Tax Included') }}</span>
                                </span>
                            </div>
                            <div class="wrap-price">
                                <ul class="pricing__feature-list">
                                    <li class="pricing__feature">{{ __('8 lessons per month (Max of 2 students)') }}</li>
                                    <li class="pricing__feature">{{ __('45 minutes lesson 8x 13,310 yen') }}</li>
                                </ul>
            
                                <form id="planBForm" action="{!! route('page_subscribe') !!}">
                                    <input type="hidden" name="komojuToken"/>
                                    <input type="hidden" name="id" value="{{ $row['id'] }}" />
                                    <button id="planBFormButton" class="pricing__action">{{ __('Pay') }}</button>
                                </form>                    
                                <script>
                                var payForm = document.getElementById("planBForm")                    
                                var handler = Komoju.multipay.configure({
                                    key: "{!! env('KOMOJU_PUBLISHABLE_KEY') !!}",
                                    token: function(token) {
                                        payForm.komojuToken.value = token.id;
                                        payForm.submit();
                                    }
                                });
                                document.getElementById("planBFormButton").addEventListener("click", function(e) {
                                    handler.open({
                                        amount:       13310,
                                        endpoint:     "https://komoju.com",
                                        locale:       "ja",
                                        currency:     "JPY",
                                        title:        "{!! __('Plan B') !!}",
                                        description:  "{!! __('45 minutes lesson 8x 13,310 yen') !!}",
                                        methods: [
                                            "credit_card"//,"konbini","bank_transfer","pay_easy"
                                        ]
                                    });
            
                                    e.preventDefault();
                                });
                                </script>
                                {{-- <a href="{{ route('page_register').'?service=3' }}" class="pricing__action">{{ __('Choose plan') }}</a> --}}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer-landing')
</div>
@endsection
