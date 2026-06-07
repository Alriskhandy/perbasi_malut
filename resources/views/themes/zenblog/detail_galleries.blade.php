@extends('themes.zenblog.layouts.main')

@section('main')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">{{ $gallery->name }}</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/galleries') }}">Galleries</a></li>
                        <li class="current">{{ $gallery->name }}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Galeri lain yang terhubung -->
                    <section id="related-gallery" class="related-gallery mt-5">
                        <div class="container">
                            <div class="row gy-4">
                                @foreach ($meta as $related)
                                    <div class="col-lg-4 col-md-6">
                                        <!-- Fancybox implementation -->
                                        <a href="{{ $related->image }}" data-fancybox="gallery"
                                            data-caption="{{ $gallery->name }} - {{ $related->description }}">
                                            <div class="post-img position-relative overflow-hidden">
                                                <img src="{{ $related->image }}" class="img-fluid"
                                                    alt="{{ $gallery->name }}">
                                            </div>
                                        </a>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section><!-- End Related Gallery Section -->
                </div><!-- End Gallery Section -->
            </div>
        </div>

    </main>

    @push('styles')
        <!-- Fancybox CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    @endpush

    @push('scripts')
        <!-- Fancybox JS -->
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script>
            // Optional Fancybox customizations
            Fancybox.bind('[data-fancybox="gallery"]', {
                infinite: true, // Enables infinite navigation
                buttons: ["zoom", "slideShow", "close"], // Adds navigation buttons
            });
        </script>
    @endpush
@endsection
