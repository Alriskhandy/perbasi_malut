@extends('themes.blogy.layouts.main')

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
    <main id="main">
        <!-- ======= Blog Details Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">

                    <div class="col-lg-8 entries">
                        <article class="entry entry-single">

                            <div class="entry-img">
                                <img src="{{ $page->image }}" alt="{{ $page->title }}" class="img-fluid">
                            </div>

                            <h2 class="entry-title">{{ $page->title }}</h2>

                            <div class="entry-content">
                                {!! $page->content !!}
                            </div>


                            <div class="entry-footer mt-4">
                                <strong>Bagikan:</strong>
                                <div class="d-flex align-items-center gap-2 mt-2">

                                    <!-- Facebook -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', $page->slug) }}"
                                        target="_blank" rel="noopener noreferrer" class="social-icon facebook"
                                        aria-label="Bagikan ke Facebook">
                                        <img src="{{ asset('assets/facebook.svg') }}" alt="Facebook">
                                    </a>

                                    <!-- Twitter -->
                                    <a href="https://twitter.com/intent/tweet?url={{ route('posts.show', $page->slug) }}"
                                        target="_blank" rel="noopener noreferrer" class="social-icon twitter"
                                        aria-label="Bagikan ke Twitter">
                                        <img src="{{ asset('assets/x.svg') }}" alt="Twitter">
                                    </a>

                                    <!-- WhatsApp -->
                                    <a href="https://api.whatsapp.com/send?text={{ route('posts.show', $page->slug) }}"
                                        target="_blank" rel="noopener noreferrer" class="social-icon whatsapp"
                                        aria-label="Bagikan ke WhatsApp">
                                        <img src="{{ asset('assets/whatsapp.svg') }}" alt="WhatsApp">
                                    </a>

                                    <!-- Instagram -->
                                    <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"
                                        class="social-icon instagram" aria-label="Instagram">
                                        <img src="{{ asset('assets/instagram.svg') }}" alt="Instagram">
                                    </a>

                                </div>
                            </div>

                        </article><!-- End blog entry -->

                        @if ($page->comments_is_active)
                            <div class="blog-comments mt-5">
                                <h4 class="comments-count">Comments ({{ $comments->count() }})</h4>

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <ul class="comments">
                                    @foreach ($comments as $comment)
                                        <li class="comment">
                                            <div>
                                                <h5>{{ $comment->name }}</h5>
                                                <time
                                                    datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('F d, Y h:i A') }}</time>
                                                <p>{{ $comment->content }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="reply-form">
                                    <h4>Leave a Comment</h4>
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $page->id }}">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <input name="name" type="text" class="form-control"
                                                    placeholder="Your Name" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input name="email" type="email" class="form-control"
                                                    placeholder="Your Email" required>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <textarea name="content" class="form-control" rows="4" placeholder="Write your comment here..." required></textarea>
                                        </div>
                                        <div class="form-group mt-3">
                                            {!! ReCaptcha::htmlScriptTagJsApi() !!}
                                            {!! ReCaptcha::htmlFormSnippet() !!}
                                            @error('g-recaptcha-response')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary mt-3">Kirim</button>
                                    </form>
                                </div>
                            </div><!-- End blog comments -->
                        @endif
                    </div><!-- End blog entries list -->

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        @include('themes.blogy.layouts.sidebar')
                    </div><!-- End sidebar -->

                </div><!-- End row -->
            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
