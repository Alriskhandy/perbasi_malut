@extends('themes.arsha.layouts.main')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Search: "{{ $query }}"</li>
                </ol>
            </nav>
            <h1>Search Results</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-8">
                @if ($posts->count() > 0 || $pages->count() > 0)
                    @if ($posts->count() > 0)
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

                                <!-- Pagination -->
                                <div class="pagination mt-4 d-flex justify-content-center">
                                    {{ $posts->appends(['q' => $query])->links() }}
                                </div>
                            </div>
                        </section>
                        <!-- /Blog Posts Section -->
                    @endif

                    @if ($pages->count() > 0)
                        <!-- Pages Section -->
                        <section id="blog-posts" class="blog-posts section">
                            <div class="container" data-aos="fade-up" data-aos-delay="100">
                                <div class="row gy-4">

                                    @foreach ($pages as $page)
                                    <div class="col">
                                        <article>

                                            @if ($page->image)
                                            <div class="post-img" style="height: 400px;">
                                                <img src="{{ $page->image }}" alt="{{ $page->title }}" class="img-fluid"
                                                    style="object-fit: cover;">
                                            </div>
                                            @endif

                                            <h2 class="title">
                                                <a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a>
                                            </h2>

                                            <div class="content">
                                                <p>{{ Str::limit(strip_tags($page->content), 200) }}</p>

                                                <div class="read-more">
                                                    <a href="{{ route('pages.show', $page->title) }}">Lihat</a>
                                                </div>
                                            </div>

                                        </article>
                                    </div><!-- End post list item -->
                                    @endforeach

                                </div><!-- End blog posts list -->
                                
                                <!-- Pagination -->
                                <div class="pagination mt-4 d-flex justify-content-center">
                                    {{ $pages->appends(['q' => $query])->links() }}
                                </div>
                            </div>
                        </section>
                        <!-- /Pages Section -->
                    @endif
                @else
                <div class="no-results text-center py-5 mt-3">
                    <h3>No results found</h3>
                    <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
                </div>
                @endif

            </div>

            @include('themes.arsha.layouts.sidebar')

        </div>
    </div>

</main>
@endsection