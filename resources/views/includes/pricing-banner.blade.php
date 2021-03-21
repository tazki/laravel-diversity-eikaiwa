<div id="fh5co-pricing" class="fh5co-bg-section">
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                <h2>{{ __('Plan & Pricing') }}</h2>
                <p>{{ __('50% off if you register on the same day after trial lesson.') }}</p>
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
                        <li class="pricing__feature" style="height:91px;">{{ __('Free trial Lesson') }}</li>
                     </ul>
                     <a href="{{ route('page_register') }}" class="pricing__action">{{ __('Choose plan') }}</a>
                 </div>
              </div>
                </div>
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
                        <a href="{{ route('page_register').'?service=2' }}" class="pricing__action">{{ __('Choose plan') }}</a>
                    </div>
             </div>
                </div>
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
                     <a href="{{ route('page_register').'?service=3' }}" class="pricing__action">{{ __('Choose plan') }}</a>
                 </div>
              </div>
           </div>
        </div>
        </div>
    </div>
</div>