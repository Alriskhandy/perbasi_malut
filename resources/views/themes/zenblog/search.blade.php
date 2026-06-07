@extends('themes.zenblog.layouts.main')

@section('main')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Search Results</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">Search: "{{ $query }}"</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if ($posts->count() > 0 || $pages->count() > 0)
                        @if ($posts->count() > 0)
                            <div class="section-header">
                                <h3 class="mb-4">Posts</h3>
                            </div>
                            @foreach ($posts as $post)
                                <article class="blog-post mb-4 d-flex flex-column flex-md-row align-items-start">
                                    @if ($post->image)
                                        <div class="post-image me-md-3 mb-3 mb-md-0"
                                            style="flex-shrink: 0; max-width: 150px; width: 100%;">
                                            <a href="{{ route('posts.show', $post->slug) }}">
                                                <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                                    class="img-fluid rounded">
                                            </a>
                                        </div>
                                    @endif
                                    <div class="post-content flex-grow-1">
                                        <h3 class="post-title">
                                            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h3>
                                        <div class="post-excerpt">
                                            <p>{{ Str::limit(strip_tags($post->content), 200) }}</p>
                                        </div>
                                    </div>
                                </article>
                            @endforeach

                            <div class="pagination-container">
                                {{ $posts->appends(['q' => $query])->links() }}
                            </div>
                        @endif

                        @if ($pages->count() > 0)
                            <div class="section-header">
                                <h3 class="mb-4">Pages</h3>
                            </div>
                            @foreach ($pages as $page)
                                <article class="blog-post mb-4 d-flex flex-column flex-md-row align-items-start">
                                    @if ($page->image)
                                        <div class="post-image me-md-3 mb-3 mb-md-0"
                                            style="flex-shrink: 0; max-width: 150px; width: 100%;">
                                            <a href="{{ route('pages.show', $page->slug) }}">
                                                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}"
                                                    class="img-fluid rounded">
                                            </a>
                                        </div>
                                    @endif
                                    <div class="post-content flex-grow-1">
                                        <h3 class="post-title">
                                            <a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a>
                                        </h3>
                                        <div class="post-excerpt">
                                            <p>{{ Str::limit(strip_tags($page->content), 200) }}</p>
                                        </div>
                                    </div>
                                </article>
                            @endforeach

                            <div class="pagination-container">
                                {{ $pages->appends(['q' => $query])->links() }}
                            </div>
                        @endif
                    @else
                        <div class="no-results text-center py-5">
                            <h3>No results found</h3>
                            <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
                        </div>
                    @endif
                </div>

                @include('themes.zenblog.layouts.sidebar')
            </div>
        </div>
    </main>

    <style>
        .blog-post {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
        }

        .post-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .post-title a {
            color: #000;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .post-title a:hover {
            color: #9c27b0;
        }

        .post-excerpt {
            color: #666;
            line-height: 1.7;
        }

        .section-header {
            margin-top: 2rem;
            margin-bottom: 1.5rem;
        }

        .section-header h3 {
            color: #000;
            font-weight: 600;
        }

        .no-results {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
        }

        .no-results h3 {
            color: #000;
            margin-bottom: 1rem;
        }

        .no-results p {
            color: #666;
        }

        .pagination-container {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .pagination {
            justify-content: center;
        }
    </style>
@endsection
