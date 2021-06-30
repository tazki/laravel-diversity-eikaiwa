@extends('layouts.landing')

@section('content')
<div class="fh5co-loader"></div>
    
<div id="page">
    @include('includes.header-landing')

    <style>
        .StripeElement {
            background-color: white;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
        .stripe-logo{
            width: 30%;
            text-align: center;
        }

        .subscription-section #subscribe-form{margin:49px 20px;}
        .subscription-section #subscribe-form .form-control{
            background-color: #ffffff;
            background-clip: padding-box;
            border: 1px solid #c6c9d5;
            border-radius: 0.25rem;
            box-shadow:inset 0 1px 0 0 rgb(34 34 48 / 5%);
        }
        .subscription-section #subscribe-form #card-button{
            border-radius:0.3rem;
        }
    </style>

    <div id="fh5co-pricing" class="fh5co-bg-section subscription-section">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                    <h2>{{ __('Payment') }}</h2>
                    <img src="{{ secure_asset('site/images/stripe_logo_sm.png') }}" class="stripe-logo" />
                </div>
            </div>
            <div class="row">
                <div class="pricing pricing--rabten">
                    @if($service_id == 5)
                    <div class="col-md-4 animate-box">
                        <div class="pricing__item">
                            <div class="wrap-price" style="padding-bottom:0;">
                                <h3 class="pricing__title">{{ __('Special Plan') }}</h3>
                                <p class="pricing__sentence" style="margin-bottom:0;">{{ __('(Until June 30)') }}</p>
                            </div>
                            <div class="pricing__price">
                                <span class="pricing__anim pricing__anim--1">
                                    <span class="pricing__currency">¥</span>8,899
                                </span>
                                <span class="pricing__anim pricing__anim--2">
                                    <span class="pricing__period">{{ __('Tax Included') }}</span>
                                </span>
                            </div>
                            <div class="wrap-price">
                                <ul class="pricing__feature-list">
                                    <li class="pricing__feature">{{ __('1,112円 per lesson') }}</li>
                                    <li class="pricing__feature">{{ __('Register now and pay only 8,899円 every month!') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($service_id == 4)
                    <div class="col-md-4 animate-box">
                        <div class="pricing__item">
                            <div class="wrap-price" style="padding-bottom:0;">
                                <h3 class="pricing__title">{{ __('Summer plan') }}</h3>
                                <p class="pricing__sentence" style="margin-bottom:0;">{{ __('(Until July 23rd)') }}</p>
                            </div>
                            <div class="pricing__price">
                                <span class="pricing__anim pricing__anim--1">
                                    <span class="pricing__currency">¥</span>5,799
                                </span>
                                <span class="pricing__anim pricing__anim--2">
                                    <span class="pricing__period">{{ __('Tax Included') }}</span>
                                </span>
                            </div>
                            <div class="wrap-price">
                                <ul class="pricing__feature-list">
                                    <li class="pricing__feature">{{ __('4x lesson 5,799円') }}</li>
                                    <li class="pricing__feature">{{ __('1 lesson 1,450円') }}</li>
                                    <li class="pricing__feature">{{ __('Register now and only pay ¥5,799 every month!') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($service_id == 2)
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
                                    <li class="pricing__feature">{{ __('45 minutes lesson 4x 7,480 yen') }}</li>
                                    <li class="pricing__feature">{{ __('7,480 1 lesson 1,870') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($service_id == 3)
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
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="col-md-6 animate-box" style="background:#fff;">
                        <form action="/s/subscription" method="POST" id="subscribe-form">
                            @csrf
                            <input type="hidden" name="service_id" value="{{$service_id}}" />
                            <div class="form-group" style="display:none;">
                                <div class="row">
                                    @foreach($plans as $plan)
                                        @if(isset($plan->product->metadata) && isset($plan->product->metadata->service_id))
                                        <div class="col-md-4">
                                            <div class="subscription-option">
                                                <input type="radio" id="plan-silver" name="plan" value='{{$plan->id}}' {!! ($plan->product->metadata->service_id == $service_id) ? 'checked="checked"' : '' !!}>
                                                <label for="plan-silver">
                                                    <span class="plan-price">{{$plan->currency}}{{$plan->amount}}<small> / {{$plan->interval}}</small></span>
                                                    <span class="plan-name">{{$plan->product->name}}</span>
                                                </label>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="card-holder-name">{{ __('Card Holder Name') }}</label>
                                <input id="card-holder-name" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="card-element">{{ __('Credit or debit card') }}</label>
                                <div id="card-element" class="form-control"></div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <div class="stripe-errors"></div>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group text-center">
                                <button  id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-success btn-block">{{ __('SUBMIT') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var card = elements.create('card', {hidePostalCode: true,
            style: style});
        card.mount('#card-element');
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            console.log("attempting");
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: { name: cardHolderName.value }
                    }
                }
                );
            if (error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                paymentMethodHandler(setupIntent.payment_method);
            }
        });
        function paymentMethodHandler(payment_method) {
            var form = document.getElementById('subscribe-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', payment_method);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>

    @include('includes.footer-landing')
</div>
@endsection