<footer id="fh5co-footer" role="contentinfo" style="background-image: url({{ secure_asset('site/images/img_bg_4.jpg') }} );">
    <div class="overlay"></div>
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-3 fh5co-widget">
                <h3>About Diversity Eikaiwa</h3>
                <p>At Diversity, we are sharing diverse experiences, knowledge, and skills that you can use in a diverse way.</p>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                <h3>Sitemap</h3>
                <ul class="fh5co-footer-links">
                    <li><a href="{{ route('page_home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('page_teacher') }}">{{ __('Teacher') }}</a></li>
                    <li><a href="{{ route('page_about') }}">{{ __('About Us') }}</a></li>
                    <li><a href="{{ route('page_pricing') }}">{{ __('Pricing') }}</a></li>
                    <li><a href="{{ route('page_contact') }}">{{ __('Contact') }}</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                <h3>Registration</h3>
                <ul class="fh5co-footer-links">
                    <li><a href="{{ route('page_login') }}">{{ __('Login') }}</a></li>
                    <li><a href="{{ route('page_register') }}">{{ __('Sign Up') }}</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget">
                <h3>Legal</h3>
                <ul class="fh5co-footer-links">
                    <li><a href="{{ route('page_terms') }}">Terms and Conditions</a></li>
                </ul>
            </div>
        </div>

        <div class="row copyright">
            <div class="col-md-12 text-center">
                <p>
                    <small class="block">&copy; 2021 Diversity Eikaiwa. All Rights Reserved.</small> 
                </p>
            </div>
        </div>
    </div>
</footer>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>