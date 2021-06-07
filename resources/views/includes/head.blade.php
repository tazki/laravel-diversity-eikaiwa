<meta charset="utf-8">
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Diversity Eikaiwa') }}</title>
<link rel="apple-touch-icon" sizes="144x144" href="{{ secure_asset('images/apple-touch-icon.png') }}">
<link rel="shortcut icon" href="{{ secure_asset('images/favicon.ico') }}">
<meta name="theme-color" content="#3063A0">
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
<link rel="stylesheet" href="{{ secure_asset('vendor/open-iconic/font/css/open-iconic-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/aos/aos.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/dropzone/dropzone.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/dropzone/basic.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/emojionearea/emojionearea.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('vendor/swiper/swiper.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('css/theme.css') }}" data-skin="default">
<link rel="stylesheet" href="{{ secure_asset('css/theme-dark.css') }}" data-skin="dark">
<link rel="stylesheet" href="{{ secure_asset('css/custom.css?v=1594600308') }}">
<script>
    var skin = localStorage.getItem('skin') || 'default';
    var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
    var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
    disabledSkinStylesheet.setAttribute('rel', '');
    disabledSkinStylesheet.setAttribute('disabled', true);
    if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
</script>
<script src="{{ secure_asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ secure_asset('vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ secure_asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ secure_asset('vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
<script src="{{ secure_asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ secure_asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ secure_asset('vendor/readmore/readmore.min.js') }}"></script>
<script src="{{ secure_asset('vendor/dropzone/dropzone.js') }}"></script>
<script src="{{ secure_asset('vendor/emojionearea/emojionearea.min.js') }}"></script>
<script src="{{ secure_asset('vendor/swiper/swiper.min.js') }}"></script>
<script src="{{ secure_asset('js/theme.js') }}"></script>
<script src="{{ secure_asset('vendor/aos/aos.js') }}"></script>
<script src="{{ secure_asset('js/app.js?v=1595329619') }}"></script>
