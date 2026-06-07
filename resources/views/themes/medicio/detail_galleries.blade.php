@extends('themes.medicio.layouts.main')

@section('main')
    <!-- ======= Gallery Detail Section ======= -->
    <section id="gallery-detail" class="gallery-detail">
        <div class="container">
            <div class="section-title">
                <h2>{{ $gallery->name }}</h2>
                {{-- <nav>
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/galleries') }}">Galleries</a></li>
                        <li class="breadcrumb-item active">{{ $gallery->name }}</li>
                    </ol>
                </nav> --}}
            </div>

            <div class="row gallery-container">
                @foreach ($meta as $related)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="gallery-item">
                            <a href="{{ $related->image }}" data-fancybox="gallery"
                                data-caption="{{ $gallery->name }} - {{ $related->description }}">
                                <div class="gallery-wrap">
                                    <img src="{{ $related->image }}" class="img-fluid" alt="{{ $gallery->name }}">
                                    <div class="gallery-info">
                                        <div class="gallery-links">
                                            <i class="fas fa-search-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('styles')
        <!-- Fancybox CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
        <style>
            .gallery-detail {
                padding: 60px 0;
                background: #f6f9fe;
            }

            .section-title {
                text-align: center;
                padding-bottom: 30px;
            }

            .section-title h2 {
                font-size: 32px;
                font-weight: bold;
                margin-bottom: 20px;
                padding-bottom: 20px;
                position: relative;
                color: #2c4964;
            }

            .section-title h2::before {
                content: "";
                position: absolute;
                display: block;
                width: 120px;
                height: 1px;
                background: #ddd;
                bottom: 1px;
                left: calc(50% - 60px);
            }

            /* .section-title h2::after {
                                                content: "";
                                                position: absolute;
                                                display: block;
                                                width: 40px;
                                                height: 3px;
                                                background: #1977cc;
                                                bottom: 0;
                                                left: calc(50% - 20px);
                                            } */

            .gallery-item {
                overflow: hidden;
                border-radius: 5px;
                background: #fff;
                box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
            }

            .gallery-wrap {
                position: relative;
                overflow: hidden;
            }

            .gallery-wrap img {
                transition: all 0.3s ease-in-out;
                width: 100%;
                height: 250px;
                object-fit: cover;
            }

            .gallery-info {
                opacity: 0;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                text-align: center;
                background: rgba(25, 119, 204, 0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease-in-out;
            }

            .gallery-info .gallery-links {
                color: #fff;
                font-size: 24px;
            }

            .gallery-wrap:hover img {
                transform: scale(1.1);
            }

            .gallery-wrap:hover .gallery-info {
                opacity: 1;
            }
        </style>
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
