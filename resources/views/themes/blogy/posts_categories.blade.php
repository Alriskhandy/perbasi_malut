@extends('themes.blogy.layouts.main')

@push('styles')
    <style>
        .post-card img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .post-card:hover img {
            transform: scale(1.05);
        }

        .post-meta {
            font-size: 14px;
            color: #6c757d;
        }

        .post-meta span {
            margin-right: 10px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination a,
        .pagination span {
            margin: 0 4px;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            border: 1px solid #dee2e6;
            color: #333;
            transition: all 0.2s;
        }

        .pagination a:hover {
            color: #ffc107;
        }

        .pagination .active span {
            background-color: #ffc107;
            color: white;
            border-color: #ffc107;
        }

        .card-title a:hover {
            color: #ffc107;
        }
    </style>
@endpush

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container d-flex justify-content-between align-items-center">
                @php
                    $category = $category ?? null;
                @endphp
                <h2>{{ $category ? $category->name : 'All Posts' }}</h2>
            </div>
        </section><!-- End Breadcrumbs -->

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4 posts-list">

                    <!-- Post List -->
                    <div class="col-lg-8">
                        <div class="row gy-4">

                            @forelse ($posts as $post)
                                <div class="col-md-6">
                                    <article class="card post-card h-100 border-0 shadow-sm">
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            <img src="{{ $post->image }}" class="card-img-top" alt="{{ $post->title }}">
                                        </a>
                                        <div class="card-body">
                                            <div class="post-meta mb-2">
                                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                                <span>•</span>
                                                <span>Views: {{ $post->views }}</span>
                                            </div>
                                            <h5 class="card-title">
                                                <a href="{{ route('posts.show', $post->slug) }}" class="text-dark">
                                                    {{ Str::limit($post->title, 50) }}
                                                </a>
                                            </h5>
                                        </div>
                                    </article>
                                </div>
                            @empty
                                <p>Tidak ada postingan.</p>
                            @endforelse

                        </div>

                        <!-- Pagination -->
                        <div class="pagination">
                            {{ $posts->links() }}
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        @include('themes.blogy.layouts.sidebar')
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
