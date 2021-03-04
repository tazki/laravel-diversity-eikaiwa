<nav class="fh5co-nav" role="navigation">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-right">
                    <p class="site">www.diversityeikaiwa.com</p>
                    <p class="num">Call: +01 123 456 7890</p>
                    <ul class="fh5co-social">
                        <li><a href="#"><i class="icon-facebook2"></i></a></li>
                        <li><a href="#"><i class="icon-twitter2"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble2"></i></a></li>
                        <li><a href="#"><i class="icon-github"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-4">
                    <div id="fh5co-logo">
                        <a href="{{ route('page_home') }}">
                            <img src="{{ secure_asset('site/images/logo.png') }}" alt="img" style="height: 55px; display: inline-block; margin-top: -10px;">
                            <span>Diversity Eikaiwa</span>
                        </a>
                    </div>
                </div>
                <div class="col-xs-8 text-right menu-1">
                    <ul>
                        <li><a href="{{ route('page_home') }}">Home</a></li>
                        <li {{ (request()->is('teacher')) ? 'class="active"' : '' }}><a href="{{ route('page_teacher') }}">Teacher</a></li>
                        <li {{ (request()->is('about-us')) ? 'class="active"' : '' }}><a href="{{ route('page_about') }}">About</a></li>
                        <li {{ (request()->is('pricing')) ? 'class="active"' : '' }}><a href="{{ route('page_pricing') }}">Pricing</a></li>
                        <!-- <li class="has-dropdown">
                            <a href="blog.html">Blog</a>
                            <ul class="dropdown">
                                <li><a href="#">Web Design</a></li>
                                <li><a href="#">eCommerce</a></li>
                                <li><a href="#">Branding</a></li>
                                <li><a href="#">API</a></li>
                            </ul>
                        </li> -->
                        <li {{ (request()->is('contact')) ? 'class="active"' : '' }}><a href="{{ route('page_contact') }}">Contact</a></li>
                        <li class="btn-cta"><a href="#"><span>Login</span></a></li>
                        <li class="btn-cta"><a href="#"><span>Sign Up</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>