@extends('themes.arsha.layouts.main')
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
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Detail Post</li>
                </ol>
            </nav>
            <h1>Detail Postingan</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container" data-aos="fade-up">

                        <article class="article">

                            <div class="hero-img" data-aos="zoom-in">
                                <img src="{{ $page->image }}" alt="Featured blog image" class="img-fluid"
                                    loading="lazy">
                                <div class="meta-overlay">
                                    <div class="meta-categories">
                                        <a href="{{ route('categories.show', $page->category->slug) }}"
                                            class="category">{{ $page->category->name }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                                <div class="content-header">
                                    <h1 class="title">{{ $page->title }}
                                    </h1>

                                    <div class="author-info">
                                        <div class="author-details">
                                            <div class="info">
                                                <h4>{{ $page->author }}</h4>
                                            </div>
                                        </div>
                                        <div class="post-meta">
                                            <span class="date"><i class="bi bi-calendar3"></i> {{
                                                $page->created_at->format('M d, Y') }}</span>
                                            <span class="divider">•</span>
                                            <span class="comments"><i class="bi bi-chat-text"></i> {{
                                                $page->comments->count(0) }} Comments</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="content">
                                    {!! $page->content !!}
                                </div>

                                <div class="meta-bottom">
                                    <div class="share-section">
                                        <h4>Share</h4>
                                        <div class="social-links">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('posts.show', $page->slug)) }}"
                                                target="_blank" class="facebook" title="Share to Facebook">
                                                <i class="bi bi-facebook"></i>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', $page->slug)) }}&text={{ urlencode($page->title) }}"
                                                target="_blank" class="twitter" title="Share to Twitter">
                                                <i class="bi bi-twitter"></i>
                                            </a>
                                            <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' ' . route('posts.show', $page->slug)) }}"
                                                target="_blank" class="whatsapp" title="Share to WhatsApp">
                                                <i class="bi bi-whatsapp"></i>
                                            </a>
                                            <a href="https://www.instagram.com" target="_blank" class="instagram"
                                                title="Share to Instagram">
                                                <i class="bi bi-instagram"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </article>

                    </div>
                </section><!-- /Blog Details Section -->

                @if ($page->comments_is_active)
                <!-- Blog Comments Section -->
                <section id="blog-comments" class="blog-comments section">

                    <div class="container" data-aos="fade-up" data-aos-delay="100">

                        <div class="blog-comments-4">
                            <div class="comments-header">
                                <h3 class="title">Community Feedback</h3>
                                <div class="comments-stats">
                                    <span class="count">{{ $page->comments->count() }}</span>
                                    <span class="label">Comments</span>
                                </div>
                            </div>

                            <div class="comments-container">
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif

                                @foreach ($comments as $comment)
                                <div class="comment-thread">
                                    <div class="comment-box">
                                        <div class="comment-wrapper">

                                            <div class="comment-content">
                                                <div class="comment-header">
                                                    <div class="user-info">
                                                        <h4>{{ $comment->name }}</h4>
                                                        <span class="time-badge">
                                                            <i class="bi bi-clock"></i>
                                                            {{ $comment->created_at->format('F d, Y h:i A') }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="comment-body">
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>

                    </div>

                </section><!-- /Blog Comments Section -->

                <!-- Blog Comment Form Section -->
                <section id="blog-comment-form" class="blog-comment-form section">

                    <div class="container" data-aos="fade-up" data-aos-delay="100">

                        <form action="{{ route('comments.store') }}" method="POST" role="form">
                            @csrf
                            <div class="form-header">
                                <h3>Tinggalkan Komentar</h3>
                                <p>Alamat email anda tidak akan di publish. Kolom yang wajib di isi bertanda *</p>
                            </div>

                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label for="name">Nama Lengkap *</label>
                                        <input type="text" name="name" id="name" placeholder="Nama lengkap anda"
                                            required="">
                                        <span class="error-text">Tolong isi nama lengkap terlebih dahulu</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label for="email">Alamat Email *</label>
                                        <input type="email" name="email" id="email" placeholder="Alamat email anda"
                                            required="">
                                        <span class="error-text">Tolong isi alamat email yang valid</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-group">
                                        <label for="comment">Komentar Anda *</label>
                                        <textarea name="content" id="comment" rows="5"
                                            placeholder="Tulis komentar disini..." required=""></textarea>
                                        <span class="error-text">Tolong isi komentar anda</span>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    {!! ReCaptcha::htmlScriptTagJsApi() !!}
                                    {!! ReCaptcha::htmlFormSnippet() !!}
                                    @error('g-recaptcha-response')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-12 text-center">
                                    <button type="submit">Kirim Komentar</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </section><!-- /Blog Comment Form Section -->
                @endif
            </div>

            @include('themes.arsha.layouts.sidebar')

        </div>
    </div>

</main>
@endsection