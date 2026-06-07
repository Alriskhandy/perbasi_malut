@extends('themes.zenblog.layouts.main')
@push('styles')
    <style>
        .agenda-image {
            width: 100%;
            /* Sesuaikan dengan elemen parent */
            height: 200px;
            /* Pastikan tinggi gambar konsisten */
            object-fit: cover;
            /* Memastikan gambar tidak terdistorsi */
            border-radius: 8px;
            /* Opsional: Membuat sudut membulat */
        }

        /* Kartu berita utama */
        .post-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .post-card-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .post-card-link {
            text-decoration: none;
            color: inherit;
        }

        .post-card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            text-align: left;
            transition: background 0.3s ease;
        }

        .post-card-overlay h3 {
            font-size: 16px;
            margin: 0;
            line-height: 1.4;
            color: #fff;
        }

        .post-card:hover .post-card-overlay {
            background: rgba(0, 0, 0, 0.8);
        }

        /* Kartu Agenda */
        .post-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            padding: 15px;
            text-align: center;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .post-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .post-meta {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .post-meta .badge {
            background-color: #ffc107;
            color: #fff;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 4px;
        }

        .post-meta .date {
            display: inline-block;
            margin-left: 10px;
            color: #777;
        }

        .post-title {
            font-size: 16px;
            font-weight: bold;
            margin: 15px 0 0;
            line-height: 1.4;
        }

        .post-title a {
            text-decoration: none;
            color: #333;
        }

        .post-title a:hover {
            color: #ffc107;
        }

        /* Tombol Selengkapnya */
        .btn-primary {
            background-color: #ffc107;
            color: #fff;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            text-decoration: none;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ffc107;
        }

        /* Agenda Card */
        .agenda-card {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            background-color: #fff;
        }

        .agenda-card:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .agenda-date {
            background-color: #ffc107;
            color: #fff;
            text-align: center;
            padding: 15px 10px;
            border-radius: 8px;
            min-width: 80px;
            min-height: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .agenda-day {
            font-size: 24px;
            font-weight: bold;
        }

        .agenda-month {
            font-size: 16px;
            color: #fff;
            text-transform: uppercase;
        }

        .agenda-content {
            flex: 1;
        }

        .agenda-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 8px;
            line-height: 1.5;
        }

        .agenda-title a {
            text-decoration: none;
            color: #333;
        }

        .agenda-title a:hover {
            color: #ffc107;
        }

        .agenda-location {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        /* Button */
        .btn-outline-primary {
            color: #ffc107;
            border: 1px solid #ffc107;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 6px;
            text-decoration: none;
            border: 2px solid #ffc107;
            /* Border kuning pada tombol */
        }

        .btn-outline-primary:hover {
            background-color: #ffc107;
            color: #fff;
            border: 2px solid #fff;
        }

        /* slider */
        /* Swiper Slide */
        .swiper-slide {
            background-size: cover;
            /* Memastikan gambar memenuhi area tanpa distorsi */
            background-position: center center;
            /* Memusatkan gambar */
            height: 100vh;
            /* Tinggi slider */
            border-radius: 8px;
            /* Opsional: Sudut membulat */
            position: relative;
            /* Memungkinkan konten di atas gambar */
        }

        /* Konten di atas gambar */
        .swiper-slide .content {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            /* background: rgba(0, 0, 0, 0.6); */
            /* Latar belakang transparan */
            color: #fff;
            /* Warna teks putih */
            padding: 15px;
            border-radius: 8px;
            /* Opsional: Membulatkan kotak konten */
        }

        .swiper-slide .content h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .swiper-slide .content p {
            font-size: 14px;
            line-height: 1.6;
        }
    </style>
@endpush
@section('main')
    <main class="main">

        <section id="slider" class="slider section dark-background">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper init-swiper">

                    <script type="application/json" class="swiper-config">
                        {
                          "loop": false,
                          "speed": 600,
                          "autoplay": {
                            "delay": 5000
                          },
                          "slidesPerView": "auto",
                          "centeredSlides": true,
                          "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                          },
                          "navigation": {
                            "nextEl": ".swiper-button-next",
                            "prevEl": ".swiper-button-prev"
                          }
                        }
                    </script>

                    <div class="swiper-wrapper">
                        @foreach ($banner as $post)
                            <div class="swiper-slide" style="background-image: url('{{ $post->image }}');">
                                <div class="content">
                                    <h2>
                                        <a
                                            href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 60, '...') }}</a>
                                    </h2>
                                    <p>{{ Str::limit($post->excerpt, 150, '...') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- berita utama --}}
        <section id="berita-utama" class="berita-utama section">
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <div class="section-title-container d-flex align-items-center justify-content-between">
                    <h2>Berita Utama</h2>
                </div>
            </div>
            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-3">
                    @foreach ($beritaUtama->take(4) as $post)
                        <div class="col-lg-3">
                            <div class="post-card utama">
                                <a href="{{ route('posts.show', $post->slug) }}" class="post-card-link">
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                        class="img-fluid post-card-img">
                                    <div class="post-card-overlay">
                                        <h3 class="post-title">
                                            {{ Str::limit($post->title, 25, '...') }}
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
        </section>

        {{-- berita terbaru --}}
        <section id="agenda-category" class="agenda-category section">
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <div class="section-title-container d-flex align-items-center justify-content-between">
                    <h2>Berita Terbaru</h2>
                </div>
            </div>

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-3">
                    @foreach ($posts->take(8) as $post)
                        <div class="col-lg-3 col-md-6">
                            <div class="post-card">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                        class="img-fluid post-card-img">
                                </a>
                                <div class="post-meta">
                                    <span class="badge">Terbaru</span>
                                    <span class="date">{{ $post->created_at->format('d M Y') }}</span>
                                </div>
                                <h3 class="post-title">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        {{ Str::limit($post->title, 25, '...') }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('allPosts') }}" class="btn btn-outline-primary">Selengkapnya</a>
                </div>
            </div>
        </section>

        {{-- berita pengumuman --}}
        @if ($pengumumanPosts->count() > 0)
            <section id="agenda-section" class="agenda-section section">
                <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                    <div class="section-title-container d-flex align-items-center justify-content-between">
                        <h2>Pengumuman</h2>
                    </div>
                </div>

                <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="row g-4">
                        @foreach ($pengumumanPosts->take(6) as $post)
                            <div class="col-lg-4">
                                <div class="agenda-card d-flex align-items-center">
                                    <div class="agenda-date">
                                        <span class="agenda-day">{{ $post->created_at->format('d') }}</span>
                                        <span class="agenda-month">{{ $post->created_at->format('M') }}</span>
                                    </div>
                                    <div class="agenda-content">
                                        <h3 class="agenda-title">
                                            <a
                                                href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 80, '...') }}</a>
                                        </h3>
                                        {{-- <p class="agenda-location">{{ $post->location ?? 'Lokasi Tidak Tersedia' }}</p> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('categories.show', 'pengumuman') }}"
                            class="btn btn-outline-primary">Selengkapnya</a>
                    </div>
                </div>
            </section>
        @endif


    </main>
@endsection
