<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
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
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('themes/blogy/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/blogy/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/blogy/vendor/aos/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/blogy/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/blogy/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="{{ asset('themes/blogy/css/main.css') }}" rel="stylesheet" />

    <style>
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .social-icon img {
            width: 20px;
            height: 20px;
        }

        .social-icon:hover {
            opacity: 0.85;
        }

        .facebook {
            background-color: #3b5998;
        }

        .twitter {
            background-color: #1da1f2;
        }

        .whatsapp {
            background-color: #25D366;
        }

        .instagram {
            background-color: #E1306C;
        }
    </style>
</head>

<body class="index-page">
    {{-- header-  --}}
    @include('themes.blogy.layouts.header')
    <main class="main">
        @yield('main')
    </main>

    {{-- footer --}}
    <footer id="footer" class="footer">
        {{-- <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                        <span class="sitename">Universitas Khairun</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Bandara Babullah, Akehuda</p>
                        <p>Ternate, Maluku Utara 97719</p>
                        <p class="mt-3">
                            <strong>Telepon:</strong> <span>(0921) 3125254</span>
                        </p>
                        <p><strong>Email:</strong> <span>info@unkhair.ac.id</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href="https://twitter.com/unkhair" target="_blank"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://facebook.com/unkhair" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="https://instagram.com/unkhair" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="https://linkedin.com/school/universitas-khairun/" target="_blank"><i
                                class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Profil</a></li>
                        <li><a href="#">Fakultas</a></li>
                        <li><a href="#">Berita</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Akademik</h4>
                    <ul>
                        <li><a href="#">Pendaftaran</a></li>
                        <li><a href="#">Kalender Akademik</a></li>
                        <li><a href="#">Beasiswa</a></li>
                        <li><a href="#">E-Learning</a></li>
                        <li><a href="#">Perpustakaan</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="#">SIAKAD</a></li>
                        <li><a href="#">LPPM</a></li>
                        <li><a href="#">LP3M</a></li>
                        <li><a href="#">Humas</a></li>
                        <li><a href="#">Kerjasama</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Informasi Lain</h4>
                    <ul>
                        <li><a href="#">Alumni</a></li>
                        <li><a href="#">Lowongan</a></li>
                        <li><a href="#">Agenda</a></li>
                        <li><a href="#">Pengumuman</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>

            </div>
        </div> --}}

        <div class="container copyright text-center mt-4">
            <p>
                © {{ date('Y') }} <strong class="px-1 sitename">{{ $site_name->value }}</strong>. Semua Hak
                Dilindungi.
            </p>
            <div class="credits">
                Developed by <a href="https://unkhair.ac.id" target="_blank">UPATIK Universitas Khairun</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('themes/blogy/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/blogy/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('themes/blogy/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('themes/blogy/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('themes/blogy/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('themes/blogy/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('themes/blogy/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
