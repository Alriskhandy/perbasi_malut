@extends('themes.medicio.layouts.main')

@section('main')
    @include('themes/medicio/layouts/hero')

    <!-- ======= Berita Utama Section ======= -->
    <section id="berita-utama" class="featured-services section-bg">
        <div class="container">
            <div class="section-title">
                <h2>Berita Utama</h2>
            </div>

            <div class="row gy-4">
                @foreach ($beritaUtama->take(4) as $post)
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-img-wrapper">
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        {{ Str::limit($post->title, 40, '...') }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ======= Berita Terbaru Section ======= -->
    <section id="berita-terbaru" class="departments">
        <div class="container">
            <div class="section-title">
                <h2>Berita Terbaru</h2>
            </div>

            <div class="row gy-4">
                @foreach ($posts->take(8) as $post)
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-img-wrapper">
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <div class="post-meta mb-2">
                                    <span class="badge bg-primary">Terbaru</span>
                                    <small class="text-muted">{{ $post->created_at->format('d M Y') }}</small>
                                </div>
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        {{ Str::limit($post->title, 40, '...') }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('allPosts') }}" class="appointment-btn">Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- ======= Pengumuman Section ======= -->
    @if ($pengumumanPosts->count() > 0)
        <section id="pengumuman" class="services section-bg">
            <div class="container">
                <div class="section-title">
                    <h2>Pengumuman</h2>
                </div>

                <div class="row gy-4">
                    @foreach ($pengumumanPosts->take(6) as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body d-flex">
                                    <div class="date-box me-3 text-center">
                                        <span class="day">{{ $post->created_at->format('d') }}</span>
                                        <span class="month">{{ $post->created_at->format('M') }}</span>
                                    </div>
                                    <div class="announcement-content">
                                        <h5 class="card-title">
                                            <a href="{{ route('posts.show', $post->slug) }}">
                                                {{ Str::limit($post->title, 80, '...') }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('categories.show', 'pengumuman') }}" class="appointment-btn">Selengkapnya</a>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('styles')
    <style>
        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Image Wrapper and Hover Effect */
        .card-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        /* Card Content Styles */
        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .card-title a {
            color: #000000;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .card-title a:hover {
            color: #5DB996;
        }

        /* Post Meta Styles */
        .post-meta {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        /* Date Box Styles for Announcements */
        .date-box {
            background: #5DB996;
            color: white;
            padding: 10px;
            border-radius: 5px;
            min-width: 60px;
        }

        .date-box .day {
            display: block;
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1;
        }

        .date-box .month {
            display: block;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        /* Section Spacing */
        .section-bg {
            background-color: #f7f7f7;
        }

        section {
            padding: 60px 0;
        }

        .gy-4 {
            --bs-gutter-y: 2rem;
        }
    </style>
@endpush
