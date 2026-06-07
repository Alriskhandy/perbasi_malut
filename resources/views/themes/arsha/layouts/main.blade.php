<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @if (Request::is('/'))
    <!-- Primary Meta Tags -->
    <title>{{ $seo_title }}</title>
    <meta name="description" content="{{ $seo_description }}">
    <meta name="keywords" content="{{ $seo_keywords }}">
    <!-- Other head elements -->
    {{-- <title>{{ $site_name->value }}</title>
    <meta name="title" content="{{ $site_name->value }}">
    <meta name="description"
        content="{{ $seo_description }} Memiliki 8 fakultas dengan 40+ program studi dalam bidang sains, teknologi, sosial & humaniora.">
    <meta name="keywords"
        content="universitas khairun, unkhair, kampus ternate, universitas negeri ternate, ptn ternate, kuliah di ternate, fakultas unkhair, pendaftaran unkhair, beasiswa unkhair, biaya kuliah unkhair, pmb unkhair, jalur masuk unkhair, akreditasi unkhair, jurusan unkhair, program studi unkhair">
    --}}
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesia">
    <meta name="author" content="Universitas Khairun">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('') }}">
    <meta property="og:title" content="{{ $site_name->value }}">
    <meta property="og:description" content="{{ $seo_description }}">
    <meta property="og:image" content="{{ asset('storage/' . $site_logo->value) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('') }}">
    <meta property="twitter:title" content="{{ $site_name->value }}">
    <meta property="twitter:description" content="{{ $seo_description }}">
    <meta property="twitter:image" content="{{ asset('storage/' . $site_logo->value) }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url('') }}">

    <!-- Additional Meta Tags -->
    <meta name="geo.region" content="ID-MA" />
    <meta name="geo.placename" content="Ternate" />
    <meta name="geo.position" content="0.7714;127.3771" />
    <meta name="ICBM" content="0.7714, 127.3771" />

    <!-- Cache Control -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    @endif

    @stack('styles')
    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('favicon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="{{ asset('favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('favicon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="{{ asset('favicon/apple-touch-icon-152x152.png') }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-128.png') }}" sizes="128x128" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('themes/arsha/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/arsha/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/arsha/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/arsha/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/arsha/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('themes/arsha/css/main.css') }}" rel="stylesheet">

</head>

<body class="{{ request()->is('') ? 'index-page' : '' }}">

    @include('themes.arsha.layouts.header')

    @yield('main')

    <footer id="footer" class="footer">

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ $site_name->value }}</strong> <span>All Rights Reserved</span>
            </p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    {{-- <div id="preloader"></div> --}}

    <!-- Vendor JS Files -->
    <script src="{{ asset('themes/arsha/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/arsha/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('themes/arsha/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('themes/arsha/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('themes/arsha/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('themes/arsha/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('themes/arsha/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('themes/arsha/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    @stack('scripts')

    <!-- Main JS File -->
    <script src="{{ asset('themes/arsha/js/main.js') }}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {
                action: 'submit'
            }).then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;
            });
        });
    </script>
</body>

</html>