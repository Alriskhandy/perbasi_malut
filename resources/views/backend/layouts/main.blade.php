<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ @$title != '' ? "$title - " : '' }}{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('backend/assets/img/logo-unkhair.png') }}" type="image/x-icon" />

    <!-- Google Fonts: Montserrat (heading) + Inter (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Fonts and icons -->
    <script src="{{ asset('backend/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('backend/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- SweetAlert2 CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" /> --}}

    {{-- summernote --}}


    @notifyCss
    <style>
        /* ===================================================
           PERBASI MALUKU UTARA — Light Mode Theme
           Primary : #A92333 (Crimson)
           Dark    : #1A1D20 (Charcoal)
           BG      : #F8F9FA (Off-White)
           Accent  : #D4AF37 (Gold)
        =================================================== */

        :root {
            --perbasi-primary   : #A92333;
            --perbasi-dark      : #1A1D20;
            --perbasi-bg        : #F8F9FA;
            --perbasi-gold      : #D4AF37;
            --perbasi-primary-hover: #8a1c28;
        }

        /* --- Typography --- */
        body {
            font-family: 'Inter', 'Public Sans', sans-serif !important;
            background-color: var(--perbasi-bg) !important;
            color: var(--perbasi-dark) !important;
        }

        h1, h2, h3, h4, h5, h6,
        .fw-bold, .fs-3, .fs-4, .fs-5 {
            font-family: 'Montserrat', 'Public Sans', sans-serif !important;
            color: var(--perbasi-dark) !important;
        }

        /* --- Sidebar Light --- */
        #perbasi-sidebar,
        #perbasi-sidebar .logo-header,
        .sidebar[data-background-color="white"],
        .sidebar[data-background-color="white"] .logo-header {
            background-color: #ffffff !important;
            border-right: 1px solid #e8e8e8 !important;
        }

        /* Sidebar brand area */
        #perbasi-sidebar .logo-header {
            border-bottom: 2px solid var(--perbasi-primary) !important;
        }

        #perbasi-sidebar h5 {
            color: var(--perbasi-dark) !important;
        }

        /* Sidebar nav section labels */
        .sidebar .nav-section .text-section {
            color: #999 !important;
            font-size: 0.7rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.08em !important;
            text-transform: uppercase !important;
        }

        /* Sidebar nav links — default state */
        .sidebar .nav.nav-secondary > li.nav-item > a {
            color: #4a4a4a !important;
            transition: all 0.2s ease !important;
        }
        .sidebar .nav.nav-secondary > li.nav-item > a p {
            color: #4a4a4a !important;
            transition: color 0.2s ease !important;
        }
        .sidebar .nav.nav-secondary > li.nav-item > a i {
            color: #888 !important;
            transition: color 0.2s ease !important;
        }

        /* Sidebar nav links — hover */
        .sidebar .nav.nav-secondary > li.nav-item > a:hover {
            background-color: rgba(169, 35, 51, 0.07) !important;
        }
        .sidebar .nav.nav-secondary > li.nav-item > a:hover p,
        .sidebar .nav.nav-secondary > li.nav-item > a:hover .caret {
            color: var(--perbasi-primary) !important;
        }
        .sidebar .nav.nav-secondary > li.nav-item > a:hover i {
            color: var(--perbasi-primary) !important;
        }

        /* Active nav item — override Kaiadmin blue */
        .sidebar .nav.nav-secondary > li.nav-item.active > a,
        .sidebar .nav.nav-secondary > li.nav-item.submenu.active > a {
            background-color: rgba(169, 35, 51, 0.09) !important;
            border-left: 3px solid var(--perbasi-primary) !important;
            border-left-color: var(--perbasi-primary) !important;
        }
        .sidebar .nav.nav-secondary > li.nav-item.active > a p,
        .sidebar .nav.nav-secondary > li.nav-item.submenu.active > a p,
        .sidebar .nav.nav-secondary > li.nav-item.active > a .caret,
        .sidebar .nav.nav-secondary > li.nav-item.submenu.active > a .caret {
            color: var(--perbasi-primary) !important;
            font-weight: 600 !important;
        }
        .sidebar .nav.nav-secondary > li.nav-item.active > a i,
        .sidebar .nav.nav-secondary > li.nav-item.submenu.active > a i {
            color: var(--perbasi-primary) !important;
        }
        /* Kaiadmin sometimes uses ::before for the active border — nuke it */
        .sidebar .nav.nav-secondary > li.nav-item.active > a::before,
        .sidebar .nav.nav-secondary > li.nav-item.submenu.active > a::before {
            background-color: var(--perbasi-primary) !important;
            border-color: var(--perbasi-primary) !important;
        }

        /* Submenu collapse items */
        .sidebar .nav.nav-collapse a .sub-item {
            color: #666 !important;
        }
        .sidebar .nav.nav-collapse li:hover a .sub-item,
        .sidebar .nav.nav-collapse li.active a .sub-item {
            color: var(--perbasi-primary) !important;
        }
        .sidebar .nav.nav-collapse li.active a {
            background-color: rgba(169, 35, 51, 0.06) !important;
        }

        /* Sidebar scrollbar wrapper */
        .sidebar .sidebar-wrapper {
            background-color: #ffffff !important;
        }

        /* Toggle buttons on sidebar */
        .sidebar .btn-toggle i,
        .sidebar .topbar-toggler i {
            color: var(--perbasi-dark) !important;
        }

        /* Force all FA icons (fas, fab, far, fal) in active items to crimson */
        .sidebar .nav.nav-secondary li.nav-item.active > a [class*="fa-"],
        .sidebar .nav.nav-secondary li.nav-item.submenu.active > a [class*="fa-"] {
            color: var(--perbasi-primary) !important;
        }

        /* --- Header / Top Navbar --- */
        .main-header {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e8e8e8 !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06) !important;
        }

        .main-header .logo-header {
            background-color: #ffffff !important;
            border-bottom: none !important;
        }

        .navbar.navbar-header {
            background-color: #ffffff !important;
        }

        /* Logo text in header */
        .main-header .logo-header a.logo,
        .main-header .logo-header h5 {
            color: var(--perbasi-dark) !important;
        }

        /* Toggle buttons in header */
        .main-header .btn-toggle i,
        .main-header .topbar-toggler i {
            color: var(--perbasi-dark) !important;
        }

        /* Profile username */
        .profile-username span {
            color: var(--perbasi-dark) !important;
        }

        /* Visit Website button */
        .navbar .btn.btn-primary,
        .btn-primary {
            background-color: var(--perbasi-primary) !important;
            border-color: var(--perbasi-primary) !important;
            color: #fff !important;
        }

        .navbar .btn.btn-primary:hover,
        .btn-primary:hover {
            background-color: var(--perbasi-primary-hover) !important;
            border-color: var(--perbasi-primary-hover) !important;
        }

        /* Label-info button (Tambah) */
        .btn-label-info {
            background-color: rgba(169, 35, 51, 0.1) !important;
            border: 1px solid var(--perbasi-primary) !important;
            color: var(--perbasi-primary) !important;
        }

        .btn-label-info:hover {
            background-color: var(--perbasi-primary) !important;
            color: #fff !important;
        }

        /* --- Main Panel & Cards --- */
        .main-panel {
            background-color: var(--perbasi-bg) !important;
        }

        .card {
            border: none !important;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07) !important;
            border-radius: 10px !important;
        }

        .card-header,
        .card .card-header {
            background-color: #ffffff !important;
            border-bottom: 2px solid var(--perbasi-primary) !important;
        }

        /* --- Table --- */
        table.table thead th,
        table.dataTable thead th,
        table.dataTable thead td {
            background-color: var(--perbasi-primary) !important;
            color: #ffffff !important;
            font-family: 'Montserrat', 'Inter', sans-serif !important;
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.06em !important;
            text-transform: uppercase !important;
            border: none !important;
            padding: 12px 16px !important;
        }

        /* DataTable sort icons — make visible on dark header */
        table.dataTable thead th.sorting::before,
        table.dataTable thead th.sorting::after,
        table.dataTable thead th.sorting_asc::before,
        table.dataTable thead th.sorting_asc::after,
        table.dataTable thead th.sorting_desc::before,
        table.dataTable thead th.sorting_desc::after {
            color: rgba(255,255,255,0.5) !important;
        }
        table.dataTable thead th.sorting_asc::before,
        table.dataTable thead th.sorting_desc::after {
            color: #ffffff !important;
        }

        /* Table body rows */
        table.table tbody tr td,
        table.dataTable tbody tr td {
            vertical-align: middle !important;
            border-bottom: 1px solid #f0f0f0 !important;
            color: var(--perbasi-dark) !important;
            font-size: 0.88rem !important;
        }

        table.table tbody tr,
        table.dataTable tbody tr {
            background-color: #ffffff !important;
            transition: background-color 0.15s ease !important;
        }

        table.table tbody tr:nth-child(even),
        table.dataTable tbody tr.odd {
            background-color: #fafafa !important;
        }

        table.table tbody tr:hover,
        table.dataTable tbody tr:hover {
            background-color: rgba(169, 35, 51, 0.05) !important;
        }

        /* DataTable wrapper */
        .dataTables_wrapper {
            padding: 0 !important;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_info {
            color: #666 !important;
            font-size: 0.85rem !important;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid rgba(116,115,115,0.35) !important;
            border-radius: 6px !important;
            padding: 4px 8px !important;
            font-size: 0.85rem !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--perbasi-primary) !important;
            outline: none !important;
            box-shadow: 0 0 0 0.15rem rgba(169,35,51,0.15) !important;
        }

        /* --- Badges --- */
        .badge-success {
            background-color: #1d8a4e !important;
            color: #fff !important;
        }

        .badge-danger {
            background-color: var(--perbasi-primary) !important;
            color: #fff !important;
        }

        .badge-info {
            background-color: #0d6ea8 !important;
            color: #fff !important;
        }

        /* Gold accent badge */
        .badge-gold {
            background-color: var(--perbasi-gold) !important;
            color: var(--perbasi-dark) !important;
        }

        /* --- Form Controls --- */
        .form-control,
        .form-select,
        .form-check-input,
        .search-input {
            border: 1px solid rgba(116, 115, 115, 0.4) !important;
            border-radius: 6px !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--perbasi-primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(169, 35, 51, 0.15) !important;
        }

        .form-label {
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            color: var(--perbasi-dark) !important;
        }

        /* --- Page header line accent --- */
        .page-inner .fw-bold.fs-3 {
            border-left: 4px solid var(--perbasi-primary);
            padding-left: 10px;
        }

        /* --- Footer --- */
        .footer {
            background-color: #ffffff !important;
            border-top: 1px solid #e8e8e8 !important;
            color: #6c757d !important;
        }

        /* --- SweetAlert buttons --- */
        .swal2-confirm {
            background-color: #3085d6 !important;
            margin-right: 10px;
        }

        .swal2-cancel {
            background-color: var(--perbasi-primary) !important;
        }

        /* --- Notify --- */
        .notify {
            z-index: 99999999 !important;
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        /* --- Navbar brand logo --- */
        .navbar-brand {
            max-height: 36px;
            height: auto;
            width: auto;
            display: block;
        }

        /* --- DataTable search & length wrapper --- */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid rgba(116,115,115,0.4) !important;
            border-radius: 6px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--perbasi-primary) !important;
            border-color: var(--perbasi-primary) !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(169, 35, 51, 0.1) !important;
            border-color: var(--perbasi-primary) !important;
            color: var(--perbasi-primary) !important;
        }
    </style>
    @stack('css')
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/lfm.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/dropzone.min.css') }}">
</head>

<body>
    @include('sweetalert::alert')
    <div class="wrapper">
        {{-- sidebar --}}
        @include('backend.layouts.sidebar')

        <div class="main-panel">
            {{-- header --}}
            @include('backend.layouts.header')

            @yield('body')

            {{-- footer --}}
            @include('backend.layouts.footer')
        </div>
    </div>

    {{-- <!-- Custom Loader -->
    <div id="loader" class="loader-overlay">
        <div class="custom-loader">
            <img src="{{ asset('backend\assets\img\logo-unkhair.png') }}" alt="Universitas Khairun Logo"
                class="loader-logo">
            <div class="spinner-border text-primary mt-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div> --}}



    <!--   Core JS Files   -->
    <script src="{{ asset('backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('backend/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('backend/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('backend/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('backend/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('backend/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('backend/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('backend/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Google Maps Plugin -->
    <script src="{{ asset('backend/assets/js/plugin/gmaps/gmaps.js') }}"></script>

    <!-- Sweet Alert -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ asset('backend/assets/js/kaiadmin.min.js') }}"></script>

    <script>
        var CRIMSON    = '#A92333';
        var CRIMSON_BG = 'rgba(169,35,51,0.09)';

        // ── Step 1: MutationObserver — intercept every <style> Kaiadmin injects
        //    and replace its blue (#1572E8 / #1a73e8 / etc.) with our crimson.
        var kaiadminBluePattern = /#(1572[Ee]8|1a73e8|4d7cfe|5c6bc0|007bff|0d6efd)/gi;

        function replaceKaiadminColors(styleNode) {
            if (styleNode.id === 'perbasi-override') return;
            var original = styleNode.innerHTML;
            var replaced = original.replace(kaiadminBluePattern, CRIMSON);
            if (replaced !== original) {
                styleNode.innerHTML = replaced;
            }
        }

        // Watch <head> for new <style> tags
        var headObserver = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                mutation.addedNodes.forEach(function (node) {
                    if (node.nodeType === 1 && node.tagName === 'STYLE') {
                        replaceKaiadminColors(node);
                    }
                });
            });
        });
        headObserver.observe(document.head, { childList: true });

        // Also patch any <style> tags already in <head> at this point
        document.head.querySelectorAll('style').forEach(replaceKaiadminColors);

        // ── Step 2: After DOM ready, inject our own override <style> last in <head>
        $(document).ready(function () {
            $("#basic-datatables").DataTable({});

            // Inject override style (appended last = highest cascade position)
            if (!document.getElementById('perbasi-override')) {
                var el = document.createElement('style');
                el.id  = 'perbasi-override';
                el.innerHTML =
                    /* active link */
                    '.sidebar .nav.nav-secondary li.nav-item.active > a,' +
                    '.sidebar .nav.nav-secondary li.nav-item.submenu.active > a {' +
                    '    background-color:' + CRIMSON_BG + ' !important;' +
                    '    border-left:3px solid ' + CRIMSON + ' !important;' +
                    '}' +

                    /* active ::before accent strip */
                    '.sidebar .nav.nav-secondary li.nav-item.active > a::before,' +
                    '.sidebar .nav.nav-secondary li.nav-item.submenu.active > a::before {' +
                    '    background:' + CRIMSON + ' !important;' +
                    '    background-color:' + CRIMSON + ' !important;' +
                    '    border-color:' + CRIMSON + ' !important;' +
                    '}' +

                    /* active icon + text + caret */
                    '.sidebar .nav.nav-secondary li.nav-item.active > a i,' +
                    '.sidebar .nav.nav-secondary li.nav-item.submenu.active > a i,' +
                    '.sidebar .nav.nav-secondary li.nav-item.active > a p,' +
                    '.sidebar .nav.nav-secondary li.nav-item.submenu.active > a p,' +
                    '.sidebar .nav.nav-secondary li.nav-item.active > a .caret,' +
                    '.sidebar .nav.nav-secondary li.nav-item.submenu.active > a .caret {' +
                    '    color:' + CRIMSON + ' !important;' +
                    '}' +

                    /* hover */
                    '.sidebar .nav.nav-secondary li.nav-item:not(.active) > a:hover {' +
                    '    background-color:rgba(169,35,51,0.06) !important;' +
                    '}' +
                    '.sidebar .nav.nav-secondary li.nav-item:not(.active) > a:hover i,' +
                    '.sidebar .nav.nav-secondary li.nav-item:not(.active) > a:hover p,' +
                    '.sidebar .nav.nav-secondary li.nav-item:not(.active) > a:hover .caret {' +
                    '    color:' + CRIMSON + ' !important;' +
                    '}' +

                    /* submenu active */
                    '.sidebar .nav.nav-collapse li.active a .sub-item {' +
                    '    color:' + CRIMSON + ' !important;' +
                    '}';

                document.head.appendChild(el);
            }

            // ── Step 3: Strip inline styles Kaiadmin puts directly on DOM elements
            function stripInline() {
                var activeLinks =
                    '.sidebar .nav.nav-secondary li.nav-item.active > a,' +
                    '.sidebar .nav.nav-secondary li.nav-item.submenu.active > a';

                $(activeLinks).each(function () {
                    this.style.removeProperty('border-left-color');
                    this.style.removeProperty('color');
                    this.style.setProperty('border-left', '3px solid ' + CRIMSON, 'important');
                    this.style.setProperty('background-color', CRIMSON_BG, 'important');
                });

                $(activeLinks + ' i,' + activeLinks + ' p,' + activeLinks + ' .caret')
                    .each(function () {
                        this.style.removeProperty('color');
                        this.style.setProperty('color', CRIMSON, 'important');
                    });
            }

            stripInline();
            setTimeout(stripInline, 100);
            setTimeout(stripInline, 350);
            setTimeout(stripInline, 700);
        });
    </script>


    @stack('scripts')
    <!-- Include Laravel File Manager's script -->
    <script src="{{ asset('vendor/laravel-filemanager/js/filemanager.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/dropzone.min.js') }}"></script>
    <script>
        // sweetalert

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {

                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        // Handle file selection
        window.addEventListener('message', function(event) {
            if (event.origin === "{{ url('/') }}") {
                var data = event.data;
                // if (data && data.link) {
                //     console.log('File URL:', data.link); // Handle the file URL as needed
                //     // Example: Show the selected file URL in an alert
                //     alert('File URL: ' + data.link);
                // }
            }
        }, false);
    </script>
    <x-notify::notify />
    @notifyJs

</body>

</html>
