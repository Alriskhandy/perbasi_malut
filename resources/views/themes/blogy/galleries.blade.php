@extends('themes.blogy.layouts.main')

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container d-flex justify-content-between align-items-center">
                <h2>Galleries</h2>
            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4 posts-list">

                    @foreach ($galleries as $item)
                        <div class="col-lg-4">
                            <article class="d-flex flex-column">
                                <div class="post-img">
                                    <a href="{{ route('gallery.detail', $item->slug) }}">
                                        <img src="{{ $item->image }}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <h2 class="title mt-3">
                                    <a href="{{ route('gallery.detail', $item->slug) }}">{{ $item->name }}</a>
                                </h2>
                                <div class="meta-top">
                                    <i class="bi bi-clock"></i> <time
                                        datetime="{{ $item->created_at->toDateString() }}">{{ $item->created_at->format('M Y') }}</time>
                                </div>
                            </article>
                        </div><!-- End post list item -->
                    @endforeach

                </div><!-- End row -->
            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->

    <style>
        .post-img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }
    </style>
@endsection
