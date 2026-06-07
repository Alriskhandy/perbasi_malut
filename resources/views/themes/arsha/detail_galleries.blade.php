@extends('themes.arsha.layouts.main')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Galleries</li>
                    <li class="current">{{ $gallery->name }}</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Galleries Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ $gallery->name }}</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($meta as $related)
                    <div class="col-md-4 mb-3 portfolio-item isotope-item">
                        <!-- Fancybox implementation -->
                        <a href="{{ $related->image }}" data-fancybox="gallery"
                            data-caption="{{ $gallery->name }} - {{ $related->description }}">
                            <div class="post-img position-relative overflow-hidden" style="height: 225px;">
                                <img src="{{ $related->image }}" class="img-fluid w-100 h-100"
                                    alt="{{ $gallery->name }}" style="object-fit: cover;">
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div><!-- End Galleries Container -->

            </div>
        </div>
    </section><!-- /Galleries Section -->

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