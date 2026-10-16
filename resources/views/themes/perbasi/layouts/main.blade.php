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

    @else
        <title>@yield('title', $site_name->value)</title>
        <meta name="description" content="{{ $seo_description }}">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ url()->current() }}">
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('themes/perbasi/favicon/favicon.ico') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('themes/perbasi/favicon/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('themes/perbasi/favicon/favicon-16x16.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('themes/perbasi/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('themes/perbasi/favicon/site.webmanifest') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Oswald:wght@400;600;700&display=swap"
        rel="stylesheet" />
    {{-- Hanya ikon yang dipakai tema. Tambah ikon baru? Masukkan namanya (urut abjad) ke icon_names. --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0..1&icon_names=arrow_back,arrow_forward,article,calendar_today,call,chevron_left,chevron_right,close,download,expand_more,filter_list,groups,home,language,location_on,mail,menu,person,phone,photo_library,refresh,search,search_off,shield,sports,sports_basketball,sports_cricket,tune,visibility,zoom_in&display=block"
        rel="stylesheet" />
    {{-- CSS hasil build: npm run build:perbasi --}}
    <link rel="stylesheet"
        href="{{ asset('themes/perbasi/css/app.css') }}?v={{ filemtime(public_path('themes/perbasi/css/app.css')) }}" />
    @stack('styles')
</head>

<body class="bg-off-white text-on-surface font-body-md overflow-x-hidden">
    @include('themes.perbasi.layouts.header')

    @yield('main')

    <!-- Footer -->
    <footer class="bg-charcoal text-off-white border-t border-crimson-red/30 py-section-padding w-full px-margin-mobile md:px-margin-desktop">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-start max-w-container-max mx-auto">
            <!-- Kiri: Logo -->
            <div class="flex flex-col items-center gap-2">
                <img alt="PERBASI Logo" class="h-32 md:h-48 w-auto" width="400" height="400" loading="lazy" decoding="async"
                    src="{{ asset('themes/perbasi/img/logo-vertikal.webp') }}" />
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
                    Gang Al-Qomar, Jalan Falajawa II,<br />
                    Kel. Bastiong Karance, Kec. Ternate Selatan,<br />
                    Kota Ternate, Maluku Utara
                </p>
                <div class="flex flex-col gap-2">
                    <a href="mailto:perbasi.malut@gmail.com"
                        class="text-amber-gold font-semibold text-sm hover:text-off-white transition-colors">
                        perbasi.malut@gmail.com
                    </a>
                    <a href="tel:+6282291585234"
                        class="text-amber-gold font-semibold text-sm hover:text-off-white transition-colors">
                        +62 822 9158 5234 
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-10 md:mt-12 text-center">
            <img alt="Tag Malut Bisa, Mallut Juara" class="h-24 md:h-40 w-auto mx-auto" width="1200" height="336" loading="lazy" decoding="async"
                src="{{ asset('themes/perbasi/img/tag-malut-bisa-red.webp') }}" />
        </div>

        <div class="mt-4 md:mt-6 pt-8 border-t border-white/5 text-center text-surface-variant text-[10px] max-w-container-max mx-auto uppercase tracking-widest">
            © {{ date('Y') }} PERBASI Maluku Utara. All Rights Reserved.
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
