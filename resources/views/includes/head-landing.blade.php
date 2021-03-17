<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="robots" content="{{ env('APP_ROBOTS') ? 'index,follow' : 'noindex,nofollow' }}" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ secure_asset('images/favicon.ico') }}">
<title>{{ config('app.name', 'Diversity Eikaiwa') }}</title>

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">

<!-- Animate.css -->
<link rel="stylesheet" href="{{ secure_asset('site/css/animate.css') }}">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="{{ secure_asset('site/css/icomoon.css') }}">
<!-- Bootstrap  -->
<link rel="stylesheet" href="{{ secure_asset('site/css/bootstrap.css') }}">

<!-- Magnific Popup -->
<link rel="stylesheet" href="{{ secure_asset('site/css/magnific-popup.css') }}">

<!-- Owl Carousel  -->
<link rel="stylesheet" href="{{ secure_asset('site/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('site/css/owl.theme.default.min.css') }}">

<!-- Flexslider  -->
<link rel="stylesheet" href="{{ secure_asset('site/css/flexslider.css') }}">

<!-- Pricing -->
<link rel="stylesheet" href="{{ secure_asset('site/css/pricing.css') }}">

<!-- Theme style  -->
<link rel="stylesheet" href="{{ secure_asset('site/css/style.css') }}">

<!-- Modernizr JS -->
<script src="{{ secure_asset('site/js/modernizr-2.6.2.min.js') }}"></script>

<!-- jQuery -->
<script src="{{ secure_asset('site/js/jquery.min.js') }}"></script>
<!-- jQuery Easing -->
<script src="{{ secure_asset('site/js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ secure_asset('site/js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ secure_asset('site/js/jquery.waypoints.min.js') }}"></script>
<!-- Stellar Parallax -->
<script src="{{ secure_asset('site/js/jquery.stellar.min.js') }}"></script>
<!-- Carousel -->
<script src="{{ secure_asset('site/js/owl.carousel.min.js') }}"></script>
<!-- Flexslider -->
<script src="{{ secure_asset('site/js/jquery.flexslider-min.js') }}"></script>
<!-- countTo -->
<script src="{{ secure_asset('site/js/jquery.countTo.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ secure_asset('site/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ secure_asset('site/js/magnific-popup-options.js') }}"></script>
<!-- Count Down -->
<script src="{{ secure_asset('site/js/simplyCountdown.js') }}"></script>
<!-- Main -->
<script src="{{ secure_asset('site/js/main.js') }}"></script>
<script>
var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);

// default example
simplyCountdown('.simply-countdown-one', {
    year: d.getFullYear(),
    month: d.getMonth() + 1,
    day: d.getDate()
});

//jQuery example
$('#simply-countdown-losange').simplyCountdown({
    year: d.getFullYear(),
    month: d.getMonth() + 1,
    day: d.getDate(),
    enableUtc: false
});
</script>
<script src="https://www.google.com/recaptcha/api.js?render={!! env('RECAPTCHA_SITE_KEY') !!}"></script>