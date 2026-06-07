@extends('themes.arsha.layouts.main')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            @php
            $category = $category ?? null;
            @endphp
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">{{ $category ? $category->name :
                        'All Posts' }}</li>
                </ol>
            </nav>
            <h1>Category: {{ $category ? $category->name :
                'All Posts' }}</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Posts Section -->
                <section id="blog-posts" class="blog-posts section">

                    <div class="container" data-aos="fade-up" data-aos-delay="100">

                        <div class="row gy-4">

                            @foreach ($posts as $post)
                            <div class="col-lg-6">
                                <article>

                                    <div class="post-img" style="height: 225px;">
                                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid"
                                            style="object-fit: cover;">
                                    </div>

                                    <h2 class="title">
                                        <a href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 50,
                                            '...') }}</a>
                                    </h2>

                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> {{
                                                $post->author }}</li>
                                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                    href="blog-details.html"><time datetime="2022-01-01">{{
                                                        $post->created_at->format('M d, Y') }}</time></a></li>
                                        </ul>
                                    </div>

                                    <div class="content">
                                        <p>{{ $post->excerpt }}</p>

                                        <div class="read-more">
                                            <a href="{{ route('posts.show', $post->title) }}">Baca</a>
                                        </div>
                                    </div>

                                </article>
                            </div><!-- End post list item -->
                            @endforeach

                        </div><!-- End blog posts list -->

                    </div>

                </section><!-- /Blog Posts Section -->


                <!-- Pagination -->
                <div class="pagination mt-4 d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>

            </div>

            @include('themes.arsha.layouts.sidebar')

        </div>
    </div>

</main>
@endsection