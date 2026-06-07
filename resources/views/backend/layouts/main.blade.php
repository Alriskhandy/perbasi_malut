<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ @$title != '' ? "$title - " : '' }}{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('backend/assets/img/logo-unkhair.png') }}" type="image/x-icon" />

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
        .notify {
            z-index: 99999999 !important;
            /* Pastikan menggunakan !important jika ada aturan lain yang mempengaruhi */
            position: fixed;
            /* Mengatur posisi menjadi tetap */
            bottom: 20px;
            /* Jarak dari bagian bawah */
            right: 20px;
            /* Jarak dari sisi kanan */
        }

        /* Menetapkan ukuran maksimal untuk logo */
        .navbar-brand {
            max-height: 20px;
            /* Atur tinggi maksimum logo */
            height: auto;
            /* Memastikan proporsional */
            width: auto;
            /* Memastikan proporsional */
            display: block;
            /* Menghindari efek whitespace */
        }

        .form-control,
        .form-check-input,
        .search-input {
            border: 1px solid rgba(116, 115, 115, 0.504) !important;
            /* Example of a bold border */
        }

        .swal2-confirm {
            background-color: #3085d6 !important;
            margin-right: 10px;
        }

        .swal2-cancel {
            background-color: #d33 !important;
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
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
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
                if (data && data.link) {
                    console.log('File URL:', data.link); // Handle the file URL as needed
                    // Example: Show the selected file URL in an alert
                    alert('File URL: ' + data.link);
                }
            }
        }, false);
    </script>
    <x-notify::notify />
    @notifyJs

</body>

</html>
