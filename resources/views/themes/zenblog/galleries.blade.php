@extends('themes.zenblog.layouts.main')
@section('main')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Galleries</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Galleries</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">

                <div class="col-lg-12">

                    <!-- Blog Posts Section -->
                    <section id="blog-posts" class="blog-posts section">

                        <div class="container">
                            <div class="row gy-4">

                                @foreach ($galleries as $item)
                                    <div class="col-lg-4">
                                        <a href="{{ route('gallery.detail', $item->slug) }}">
                                            <article class="position-relative h-100">
                                                <div class="post-img position-relative overflow-hidden">
                                                    <img src="{{ $item->image }}" class="img-fluid" alt="">
                                                    <span class="post-date">{{ $item->created_at->format('M Y') }}</span>
                                                </div>
                                                <div class="post-content d-flex flex-column">
                                                    <h3 class="post-title">{{ $item->name }}</h3>
                                                </div>
                                            </article>
                                        </a>
                                    </div><!-- End post list item -->
                                @endforeach


                            </div>
                        </div>

                    </section><!-- End Blog Posts Section -->

                </div><!-- End Blog Section -->



            </div>
        </div>

    </main>
    <style>
        .post-img img {
            width: 100%;
            /* Gambar mengikuti lebar penuh dari container */
            height: 250px;
            /* Atur tinggi sesuai kebutuhan */
            object-fit: cover;
            /* Pastikan gambar tetap proporsional dan memenuhi container */
            display: block;
            /* Menghilangkan spasi bawah bawaan gambar */
        }
    </style>
@endsection
