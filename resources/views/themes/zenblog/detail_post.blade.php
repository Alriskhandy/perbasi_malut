@extends('themes.zenblog.layouts.main')
@push('head')
    <!-- SEO Meta Tags -->
    <meta name="title" content="{{ $page->title }}">
    <meta name="description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta name="keywords" content="{{ implode(',', $page->tags ?? ['blog', 'post']) }}">
    <meta name="author" content="{{ $page->author ?? 'Admin' }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta property="og:image" content="{{ $page->image }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="Your Website Name">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta name="twitter:image" content="{{ $page->image }}">
@endpush

@section('main')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">{{ $page->title }}</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">{{ $page->title }}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Blog Details Section -->
                    <section id="blog-details" class="blog-details section">
                        <div class="container">

                            <article class="article">
                                <img src="{{ $page->image }}" alt="{{ $page->title }}" class="img-fluid ">

                                <div class="content">
                                    {!! $page->content !!}

                                </div><!-- End post content -->

                                <div class="share-buttons mt-4">

                                    <span>Share:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', $page->slug) }}"
                                        target="_blank" class="btn btn-social-icon btn-facebook">
                                        <img src="{{ asset('assets/facebook.svg') }}" alt="" width="40">
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ route('posts.show', $page->slug) }}"
                                        target="_blank" class="btn btn-social-icon btn-twitter">
                                        <img src="{{ asset('assets/x.svg') }}" alt="" width="40">
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ route('posts.show', $page->slug) }}"
                                        target="_blank" class="btn btn-social-icon btn-whatsapp">
                                        <img src="{{ asset('assets/whatsapp.svg') }}" alt="" width="30">
                                    </a>
                                    <a href="https://www.instagram.com" target="_blank"
                                        class="btn btn-social-icon btn-instagram">
                                        <img src="{{ asset('assets/instagram.svg') }}" alt="" width="30">
                                    </a>

                                </div> <!-- End Share Buttons -->
                            </article>
                            @if ($page->comments_is_active)
                                <!-- Comments Section -->
                                <section id="comments" class="comments section mt-5">
                                    <h3 class="mb-4">Comments ({{ $comments->count() }})</h3>

                                    <!-- Tampilkan Pesan Sukses jika ada -->
                                    {{-- <div class="alert alert-success">
                                    Berhasil
                                </div> --}}
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <!-- Comments List -->
                                    <ul class="list-unstyled">
                                        @foreach ($comments as $comment)
                                            <li class="mb-4">
                                                <div class="comment">
                                                    <strong>{{ $comment->name }}</strong>
                                                    <span class="text-muted d-block small">
                                                        {{ $comment->created_at->format('F d, Y h:i A') }}
                                                    </span>
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Add Comment Form -->
                                    <h4 class="mt-5">Leave a Comment</h4>
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $page->id }}">
                                        <!-- Input Name -->
                                        <div class="form-group mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Your Name" required>
                                        </div>

                                        <!-- Input Email -->
                                        <div class="form-group mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Your Email" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <textarea name="content" class="form-control" rows="4" placeholder="Write your comment here..." required></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            {!! ReCaptcha::htmlScriptTagJsApi() !!}
                                            {!! ReCaptcha::htmlFormSnippet() !!}
                                            @error('g-recaptcha-response')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-outline-warning mt-3">Kirim</button>
                                    </form>
                                </section><!-- /Comments Section -->
                            @endif
                        </div>
                    </section><!-- /Blog Details Section -->

                </div>

                @include('themes.zenblog.layouts.sidebar')

            </div>
        </div>

    </main>
@endsection
