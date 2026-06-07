@extends('themes.biz-news.layouts.main')

@section('main')
<!-- Galleries Start -->
<div class="container-fluid mt-5 pt-3">
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="section-title">
                    <h4 class="m-0 text-uppercase font-weight-bold">{{ $gallery->name }}</h4>
                </div>
            </div>
            
            <!-- Related Gallery Start -->
            <section id="related-gallery" class="related-gallery mt-5">
                <div class="container">
                    <div class="row">
                        @foreach ($meta as $related)
                            <div class="col-lg-4 col-md-6 mb-3">
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
                    </div>
                </div>
            </section>
            <!-- Related Gallery End -->

        </div>
    </div>
</div>
<!-- Galleries End -->

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