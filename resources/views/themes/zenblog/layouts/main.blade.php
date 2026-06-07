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
        {{-- <title>{{ $site_name->value }}</title> --}}
        {{-- <meta name="title" content="{{ $site_name->value }}">
        <meta name="description"
            content="{{ $seo_description }} Memiliki 8 fakultas dengan 40+ program studi dalam bidang sains, teknologi, sosial & humaniora.">
        <meta name="keywords"
            content="universitas khairun, unkhair, kampus ternate, universitas negeri ternate, ptn ternate, kuliah di ternate, fakultas unkhair, pendaftaran unkhair, beasiswa unkhair, biaya kuliah unkhair, pmb unkhair, jalur masuk unkhair, akreditasi unkhair, jurusan unkhair, program studi unkhair"> --}}
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

    <!-- Microsoft Tiles -->
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('favicon/mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('favicon/mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ asset('favicon/mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ asset('favicon/mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('favicon/mstile-310x310.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('themes/zenblog/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/zenblog/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/zenblog/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/zenblog/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Add Head Stack -->
    @stack('head')

    <!-- Other Styles -->
    @stack('styles')

    <!-- Main CSS File -->
    <link href="{{ asset('themes/zenblog/css/main.css') }}" rel="stylesheet">
    <style>
        /* Default Dropdown Menu Style */
        ul.dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        li.dropdown:hover>ul.dropdown-menu {
            display: block;
        }

        /* Mobile Devices */
        @media (max-width: 768px) {
            .dropdown-menu {
                position: static;
                /* Make it position as part of the flow */
                display: none;
            }

            .dropdown.show>.dropdown-menu {
                display: block;
                /* Show the menu when the parent is active */
            }

            .toggle-dropdown {
                cursor: pointer;
            }
        }

        .navbar {
            border-top: 6px solid #FFB200 !important;
            border-bottom: 1px solid #FFB200 !important;
        }

        /* Ubah warna teks dan latar belakang saat diblok */
        ::selection {
            background-color: #FFB200;
            /* Warna latar belakang */
            color: black;
            /* Warna teks */
        }

        /* Untuk kompatibilitas dengan Firefox */
        ::-moz-selection {
            background-color: #FFB200;
            color: black;
        }

        .post-img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .post-img img:hover {
            transform: scale(1.05);
            /* Efek zoom saat hover */
        }

        .post-title {
            text-align: center;
            margin-top: 10px;
            font-size: 24px;
            font-weight: bold;
        }

        .gallery-meta ul {
            list-style: none;
            padding: 0;
        }

        .gallery-meta ul li {
            margin-bottom: 8px;
            font-size: 16px;
        }

        .related-gallery h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Warna dot yang tidak aktif */
        .swiper-pagination-bullet {
            background-color: #f6ff00 !important;
            /* Ganti dengan warna yang diinginkan */
        }

        /* Warna dot yang aktif */
        .swiper-pagination-bullet-active {
            background-color: #FFB200 !important;
            /* Ganti dengan warna yang diinginkan */
        }

        @media (max-width: 991px) {
            .navmenu.navbar-mobile {
                position: fixed;
                overflow: hidden;
                top: 0;
                right: 0;
                left: 0;
                bottom: 0;
                background: #fff;
                transition: 0.3s;
                z-index: 999;
                padding: 15px;
            }

            .navmenu.navbar-mobile ul {
                display: block;
                position: absolute;
                top: 55px;
                right: 15px;
                bottom: 45px;
                left: 15px;
                padding: 10px 0;
                overflow-y: auto;
                transition: 0.3s;
                background: #fff;
            }

            .dropdown-menu {
                display: none;
                padding-left: 15px;
            }

            .dropdown-menu.dropdown-active {
                display: block;
            }

            .navmenu.navbar-mobile ul li {
                padding: 0;
            }

            .navmenu.navbar-mobile .dropdown ul {
                position: static;
                display: none;
                margin: 10px 20px;
                padding: 10px 0;
                z-index: 99;
                opacity: 1;
                visibility: visible;
                background: transparent;
                box-shadow: none;
            }

            .navmenu.navbar-mobile .dropdown ul.dropdown-active {
                display: block;
            }
        }
    </style>
</head>

<body class="index-page">
    @include('themes.zenblog.layouts.header')

    @yield('main')

    <footer id="footer" class="footer dark-background">

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ $site_name->value }}</strong> <span>All
                    Rights
                    Reserved</span>
            </p>

        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('themes/zenblog/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/zenblog/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('themes/zenblog/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('themes/zenblog/vendor/swiper/swiper-bundle.min.js') }}"></script>
    @stack('scripts')
    <!-- Main JS File -->
    <script src="{{ asset('themes/zenblog/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth < 992) {
                const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
                const navMenu = document.querySelector('.navmenu');

                // Toggle untuk menu utama mobile
                if (mobileNavToggle) {
                    mobileNavToggle.addEventListener('click', function(e) {
                        navMenu.classList.toggle('navbar-mobile');
                        this.classList.toggle('bi-x');
                    });
                }

                // Handler untuk dropdown level 1
                document.querySelectorAll('.navmenu .dropdown').forEach(function(dropdown) {
                    const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
                    const dropdownMenu = dropdown.querySelector('.dropdown-menu');

                    dropdownToggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        dropdownMenu.classList.toggle('dropdown-active');
                    });
                });

                // Handler untuk dropdown level 2 dan 3
                document.querySelectorAll('.dropdown-menu .dropdown').forEach(function(dropdown) {
                    const link = dropdown.querySelector('a');
                    const subMenu = dropdown.querySelector('ul');

                    if (link && subMenu) {
                        link.addEventListener('click', function(e) {
                            if (this.classList.contains('dropdown-toggle')) {
                                e.preventDefault();
                                e.stopPropagation();
                                subMenu.classList.toggle('dropdown-active');
                            }
                        });
                    }
                });
            }
        });

        grecaptcha.ready(function() {
            grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {
                action: 'submit'
            }).then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;
            });
        });
    </script>
    {{-- {!! ReCaptcha::htmlScriptTagJsApi() !!} --}}
</body>

</html>
