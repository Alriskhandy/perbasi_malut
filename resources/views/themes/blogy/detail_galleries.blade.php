@extends('themes.blogy.layouts.main')

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container d-flex justify-content-between align-items-center">
                <h2>{{ $gallery->name }}</h2>
            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4 justify-content-center">

                    @foreach ($meta as $related)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ $related->image }}" data-fancybox="gallery"
                                data-caption="{{ $gallery->name }} - {{ $related->description }}">
                                <div class="gallery-item">
                                    <img src="{{ $related->image }}" alt="{{ $gallery->name }}" class="img-fluid"
                                        style="height: 250px; object-fit: cover;">
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section><!-- End Gallery Section -->

    </main><!-- End #main -->

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
