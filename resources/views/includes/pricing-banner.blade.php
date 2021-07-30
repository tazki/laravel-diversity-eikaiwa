<div id="fh5co-pricing" class="fh5co-bg-section">
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                <h2>{{ __('Plan & Pricing') }}</h2>
                <p>{{ __('Monthly Subscription') }}</p>
                <h3 style="font-weight:bold; color:#ff0000;">{{ __('August campaign') }}</h3>
                <h4 style="font-weight:bold; color:#ff0000;">{{ __('Register now and get 50% off on your plan for the first month.') }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="pricing pricing--rabten">
                <div class="col-md-4 animate-box">
                    <div class="pricing__item">
                        <div class="wrap-price">
                            <!-- <div class="icon icon-user2"></div> -->
                             <h3 class="pricing__title">{{ __('Trial') }}</h3>
                             <!-- <p class="pricing__sentence">Single user license</p> -->
                        </div>
                 <div class="pricing__price">
                    <span class="pricing__anim pricing__anim--1">
                        <span class="pricing__currency">¥</span>0
                    </span>
                    <span class="pricing__anim pricing__anim--2">
                            <span class="pricing__period">{{ __('Free Trial') }}</span>
                    </span>
                 </div>
                 <div class="wrap-price">
                     <ul class="pricing__feature-list">
                        <li class="pricing__feature" style="height:247px;">{{ __('2x free trial lesson') }}</li>
                        {{-- <li class="pricing__feature">{{ __('Free trial Lesson') }}</li> --}}
                        {{-- <li class="pricing__feature">{{ __('1 point = 1 lesson') }}</li> --}}
                     </ul>
                     <a href="{{ route('page_register') }}" class="pricing__action">{{ __('Choose plan') }}</a>
                 </div>
              </div>
            </div>
            {{-- <div class="col-md-4 animate-box">
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
                            <li class="pricing__feature" style="text-decoration:line-through;">{{ __('7,480円') }}</li>
                            <li class="pricing__feature">{{ __('4x lesson 5,799円') }}</li>
                            <li class="pricing__feature">{{ __('1 lesson 1,450円') }}</li>
                            <li class="pricing__feature">{{ __('Register now and only pay ¥5,799 every month!') }}</li>
                        </ul>
                        <a href="{{ route('page_register').'?service=4' }}" class="pricing__action">{{ __('Choose plan') }}</a>
                    </div>
                </div>
            </div> --}}
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
                            <li class="pricing__feature">{{ __('4 lessons a month') }}</li>
                            <li class="pricing__feature">{{ __('Regular price ¥ 7,480 (tax included)') }}</li>
                            <li class="pricing__feature">{{ __('Campaign price ¥ 3,740 (tax included)') }}</li>
                            <li class="pricing__feature">{{ __('Note: price will go back to full price from second month onwards.') }}</li>
                        </ul>
                        <a href="{{ route('page_register').'?service=2' }}" class="pricing__action">{{ __('Choose plan') }}</a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4 animate-box">
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
                            <li class="pricing__feature" style="height:91px;">{{ __('Register now and pay only 8,899円 every month!') }}</li>
                        </ul>
                        <a href="{{ route('page_register').'?service=5' }}" class="pricing__action">{{ __('Choose plan') }}</a>
                    </div>
                </div>
            </div> --}}
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
                        <li class="pricing__feature">{{ __('8 lessons a month') }}</li>
                        <li class="pricing__feature">{{ __('Regular price ¥ 13,310 (tax included)') }}</li>
                        <li class="pricing__feature">{{ __('Campaign price ¥ 6,655 (tax included)') }}</li>
                        <li class="pricing__feature">{{ __('Note: price will go back to full price from second month onwards.') }}</li>
                     </ul>
                     <a href="{{ route('page_register').'?service=3' }}" class="pricing__action">{{ __('Choose plan') }}</a>
                 </div>
              </div>
           </div>
        </div>
        </div>
    </div>
</div>