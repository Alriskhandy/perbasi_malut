<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
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
        <meta name="author" content="Perbasi Maluku Utara">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('') }}">
        <meta property="og:title" content="{{ $site_name->value }}">
        <meta property="og:description" content="{{ $seo_description }}">
        <meta property="og:image" content="{{ \App\Helpers\Media::url($site_logo->value) }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url('') }}">
        <meta property="twitter:title" content="{{ $site_name->value }}">
        <meta property="twitter:description" content="{{ $seo_description }}">
        <meta property="twitter:image" content="{{ \App\Helpers\Media::url($site_logo->value) }}">

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

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('themes/perbasi/favicon/favicon.ico') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('themes/perbasi/favicon/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('themes/perbasi/favicon/favicon-16x16.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('themes/perbasi/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('themes/perbasi/favicon/site.webmanifest') }}" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Oswald:wght@400;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "off-white": "#F8F9FA",
                        "primary": "#87021e",
                        "crimson-red": "#A92333",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#e9c349",
                        "amber-gold": "#D4AF37",
                        "primary-fixed-dim": "#ffb3b3",
                        "tertiary-container": "#cba72f",
                        "charcoal": "#1A1D20",
                        "surface-container-high": "#e7e8e9",
                        "inverse-primary": "#ffb3b3",
                        "surface-container-lowest": "#ffffff",
                        "surface-container": "#edeeef",
                        "on-tertiary-fixed-variant": "#574500",
                        "on-primary-fixed": "#400009",
                        "surface-variant": "#e1e3e4",
                        "secondary-fixed-dim": "#c5c6ca",
                        "primary-container": "#a92333",
                        "on-secondary-fixed": "#191c1f",
                        "secondary-fixed": "#e1e2e6",
                        "on-surface": "#191c1d",
                        "inverse-surface": "#2e3132",
                        "surface-tint": "#b12938",
                        "surface": "#f8f9fa",
                        "primary-fixed": "#ffdad9",
                        "outline-variant": "#e0bfbe",
                        "on-secondary-container": "#606366",
                        "on-surface-variant": "#594140",
                        "error": "#ba1a1a",
                        "inverse-on-surface": "#f0f1f2",
                        "tertiary-fixed": "#ffe088",
                        "surface-container-highest": "#e1e3e4",
                        "on-error-container": "#93000a",
                        "on-primary-container": "#ffc0bf",
                        "on-primary-fixed-variant": "#8f0c23",
                        "error-container": "#ffdad6",
                        "on-background": "#191c1d",
                        "surface-bright": "#f8f9fa",
                        "surface-container-low": "#f3f4f5",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#4e3d00",
                        "surface-dim": "#d9dadb",
                        "background": "#f8f9fa",
                        "tertiary": "#735c00",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#dee0e4",
                        "secondary": "#5c5f62",
                        "on-tertiary-fixed": "#241a00",
                        "outline": "#8d7070",
                        "on-secondary-fixed-variant": "#44474a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "stack-lg": "32px",
                        "margin-mobile": "20px",
                        "stack-md": "16px",
                        "stack-sm": "8px",
                        "container-max": "1280px",
                        "section-padding": "80px",
                        "margin-desktop": "64px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "label-bold": ["Inter"],
                        "headline-xl-mobile": ["Oswald"],
                        "headline-md": ["Oswald"],
                        "headline-lg": ["Oswald"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "stats-display": ["Oswald"],
                        "headline-xl": ["Oswald"]
                    },
                    "fontSize": {
                        "label-bold": ["14px", {
                            "lineHeight": "20px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "700"
                        }],
                        "headline-xl-mobile": ["40px", {
                            "lineHeight": "44px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "700"
                        }],
                        "headline-md": ["32px", {
                            "lineHeight": "40px",
                            "fontWeight": "600"
                        }],
                        "headline-lg": ["48px", {
                            "lineHeight": "56px",
                            "letterSpacing": "0em",
                            "fontWeight": "600"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "stats-display": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }],
                        "headline-xl": ["64px", {
                            "lineHeight": "72px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-off-white text-on-surface font-body-md overflow-x-hidden">
    @include('themes.perbasi.layouts.header')

    @yield('main')

    <!-- Footer -->
    <footer class="bg-charcoal text-off-white border-t border-crimson-red/30 py-section-padding w-full px-margin-desktop">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-start max-w-container-max mx-auto">
            <!-- Kiri: Logo -->
            <div class="flex flex-col items-center gap-2">
                <img alt="PERBASI Logo" class="h-48 w-auto"
                    src="{{ asset('backend/assets/img/logo-vertikal.png') }}" />
            </div>

            <!-- Tengah: Deskripsi -->
            <div class="flex flex-col gap-2">
                <h4 class="font-label-bold text-crimson-red uppercase tracking-widest text-[12px]">Tentang Kami</h4>
                <p class="text-surface-variant font-body-md text-sm leading-relaxed">
                    Pengurus Provinsi Persatuan Bola Basket Seluruh Indonesia Maluku Utara. Membangun masa depan basket
                    di Bumi Moloku Kie Raha melalui prestasi dan sportivitas.
                </p>
                <div class="flex flex-wrap gap-x-4 gap-y-2 mt-2">
                    @foreach ($menus ?? [] as $menu)
                        <a href="{{ $menu->url }}"
                            class="text-surface-variant hover:text-crimson-red font-label-bold text-xs uppercase tracking-wider transition-colors">
                            {{ $menu->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Kanan: Kontak -->
            <div class="flex flex-col gap-2">
                <h4 class="font-label-bold text-crimson-red uppercase tracking-widest text-[12px]">Informasi Kontak</h4>
                <p class="text-surface-variant text-sm leading-loose">
                    Jl. Pahlawan Revolusi No. 12<br />
                    Ternate, Maluku Utara
                </p>
                <div class="flex flex-col gap-2">
                    <a href="mailto:info@perbasimalut.id"
                        class="text-amber-gold font-semibold text-sm hover:text-off-white transition-colors">
                        info@perbasimalut.id
                    </a>
                    <a href="tel:+6281234567890"
                        class="text-amber-gold font-semibold text-sm hover:text-off-white transition-colors">
                        +62 812 3456 7890
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-16 pt-8 border-t border-white/5 text-center text-surface-variant text-[10px] max-w-container-max mx-auto uppercase tracking-widest">
            © {{ date('Y') }} PERBASI Maluku Utara. All Rights Reserved.
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
