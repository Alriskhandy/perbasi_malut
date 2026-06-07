@extends('themes.medicio.layouts.main')

@push('styles')
    <style>
        /* Card and Post Entry Styles */
        .post-entry {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            height: 100%;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .post-entry:hover {
            transform: translateY(-5px);
        }

        .post-entry img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .post-entry:hover img {
            transform: scale(1.1);
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Post Meta Styles */
        .post-meta {
            font-size: 14px;
            color: #777;
            margin-bottom: 10px;
        }

        /* Title Styles */
        .card-title {
            font-size: 1.1rem;
            margin-bottom: 0;
        }

        .card-title a {
            color: #2c4964;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .card-title a:hover {
            color: #5DB996;
        }

        /* Trending Section Styles */
        .trending {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .trending h3 {
            font-size: 20px;
            font-weight: bold;
            color: #2c4964;
            margin-bottom: 20px;
        }

        .trending-post li {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .trending-post li:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .trending-post .number {
            font-size: 24px;
            font-weight: bold;
            color: #5DB996;
            min-width: 30px;
        }

        .trending-post h4 {
            font-size: 16px;
            margin: 0;
        }

        .trending-post a {
            color: #2c4964;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .trending-post a:hover {
            color: #5DB996;
        }

        /* Pagination Styles */
        .pagination {
            margin-top: 30px;
            justify-content: center;
        }

        .pagination .page-item .page-link {
            color: #2c4964;
            border: none;
            margin: 0 3px;
            border-radius: 5px;
            padding: 8px 16px;
        }

        .pagination .page-item.active .page-link {
            background-color: #5DB996;
            border-color: #5DB996;
            color: #fff;
        }

        .pagination .page-link:hover {
            background-color: #eee;
            color: #3fbbc0;
        }
    </style>
@endpush

@section('main')
    <main id="main">
        <!-- Breadcrumbs Section -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    @php
                        $category = $category ?? null;
                    @endphp
                    <h2>{{ $category ? $category->name : 'All Posts' }}</h2>
                    {{-- <ol>
                        <li><a href="/">Home</a></li>
                        <li>{{ $category ? $category->name : 'Posts' }}</li>
                    </ol> --}}
                </div>
            </div>
        </section>

        <!-- Posts Section -->
        <section class="inner-page">
            <div class="container">
                <div class="row g-5">
                    <!-- Main Content Posts -->
                    <div class="col-lg-8">
                        <div class="row g-4">
                            @foreach ($posts as $post)
                                <div class="col-lg-6 col-md-6">
                                    <div class="post-entry">
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            <img src="{{ $post->image }}" alt="{{ $post->title }}">
                                        </a>
                                        <div class="card-body">
                                            <div class="post-meta">
                                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                                <span class="mx-1">•</span>
                                                <span>Views: {{ $post->views }}</span>
                                            </div>
                                            <h5 class="card-title">
                                                <a href="{{ route('posts.show', $post->slug) }}">
                                                    {{ Str::limit($post->title, 50) }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="pagination">
                            {{ $posts->links() }}
                        </div>
                    </div>

                    <!-- Trending Section -->
                    <div class="col-lg-4">
                        @include('themes.medicio.layouts.sidebar')
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
