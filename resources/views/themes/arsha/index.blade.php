@extends('themes.arsha.layouts.main')

@push('styles')
<style>
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

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
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
                    <div class="swiper-slide position-relative"
                        style="background: url('{{ $post->image }}') center center / cover no-repeat; min-height: 600px;">

                        <!-- Fullscreen overlay content, centered -->
                        <div class="content text-white d-flex flex-column justify-content-end align-items-center position-absolute top-0 start-0 w-100 h-100"
                            style="background: rgba(0, 0, 0, 0.4); padding: 30px; text-align: center;">

                            <h2 class="text-white">
                                <a href="{{ route('posts.show', $post->slug) }}"
                                    class="text-white text-decoration-none">
                                    {{ Str::limit($post->title, 60, '...') }}
                                </a>
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
    <!-- /Hero Section -->

    <!-- Berita Utama Section -->
    <section id="recent-blog-postst" class="recent-blog-postst section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Berita Utama</h2>
        </div><!-- End Section Title -->

        <div class="container-fluid px-5">

            <div class="row gy-5">

                @foreach ($beritaUtama->take(4) as $post)
                <!-- Start post item -->
                <div class="col-xl-3 col-md-4">
                    <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                        <div class="post-img position-relative overflow-hidden" style="height: 200px;">
                            <img src="{{ $post->image }}" class="img-fluid" alt="{{ $post->title }}"
                                style="object-fit: cover;">
                            <span class="post-date">{{ $post->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">{{ Str::limit($post->title, 50, '...') }}</h3>

                            <div class="meta d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person"></i> <span class="ps-2">{{ $post->author }}</span>
                                </div>
                                <span class="px-3 text-black-50">/</span>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder2"></i> <span class="ps-2">{{ $post->category->name }}</span>
                                </div>
                            </div>

                            <hr>

                            <a href="{{ route('posts.show', $post->slug) }}" class="readmore stretched-link"><span>Baca
                                    Selengkapnya</span><i class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div>
                <!-- End post item -->
                @endforeach

            </div>

        </div>

    </section>
    <!-- /Berita Utama Section -->

    <!-- Berita Terbaru Section -->
    <section id="recent-blog-postst" class="recent-blog-postst section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Berita Terbaru</h2>
        </div><!-- End Section Title -->

        <div class="container-fluid px-5">

            <div class="row gy-5">

                @foreach ($posts->take(8) as $post)
                <!-- Start post item -->
                <div class="col-xl-3 col-md-4">
                    <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                        <div class="post-img position-relative overflow-hidden" style="height: 200px;">
                            <img src="{{ $post->image }}" class="img-fluid" alt="{{ $post->title }}"
                                style="object-fit: cover;">
                            <span class="post-date">{{ $post->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">{{ Str::limit($post->title, 50, '...') }}</h3>

                            <div class="meta d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person"></i> <span class="ps-2">{{ $post->author }}</span>
                                </div>
                                <span class="px-3 text-black-50">/</span>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder2"></i> <span class="ps-2">{{ $post->category->name }}</span>
                                </div>
                            </div>

                            <hr>

                            <a href="{{ route('posts.show', $post->slug) }}" class="readmore stretched-link"><span>Baca
                                    Selengkapnya</span><i class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div>
                <!-- End post item -->
                @endforeach

            </div>
            
            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('allPosts') }}" class="btn btn-outline-primary">Selengkapnya</a>
            </div>

        </div>

    </section>
    <!-- /Berita Terbaru Section -->

    <!-- Pengumuman Section -->
    @if ($pengumumanPosts->count() > 0)
    <section id="recent-blog-postst" class="recent-blog-postst section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Pengumuman</h2>
        </div><!-- End Section Title -->

        <div class="container-fluid px-5">

            <div class="row gy-5">

                @foreach ($pengumumanPosts->take(4) as $post)
                <!-- Start post item -->
                <div class="col-xl-3 col-md-4">
                    <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">{{ Str::limit($post->title, 50, '...') }}</h3>


                            <hr>

                            <a href="{{ route('posts.show', $post->slug) }}" class="readmore stretched-link"><span>Baca
                                    Selengkapnya</span><i class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div>
                <!-- End post item -->
                @endforeach

            </div>

            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('categories.show', 'pengumuman') }}" class="btn btn-outline-primary">Selengkapnya</a>
            </div>
        </div>

    </section>
    @endif
    <!-- /Pengumuman Section -->

</main>
@endsection