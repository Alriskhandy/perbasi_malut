@extends('themes.biz-news.layouts.main')
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
<!-- News With Sidebar Start -->
<div class="container-fluid mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- News Detail Start -->
                <div class="position-relative mb-3">
                    <img class="img-fluid w-100" src="{{ $page->image }}" style="object-fit: cover;"
                        alt="{{ $page->title }}">
                    <div class="bg-white border border-top-0 p-4">
                        <div class="mb-3">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                href="{{ route('categories.show', $page->category->slug) }}">{{ $page->category->name
                                }}</a>
                            <datetime>Jan 01, 2045</datetime>
                        </div>
                        <h2 class="mb-3 text-secondary font-weight-bold">{{ $page->title }}</h2>
                        {!! $page->content !!}
                    </div>
                    <div class="d-flex justify-content-between bg-white border border-top-0 border-bottom-0 px-4 py-2">
                        <div class="d-flex align-items-center">
                            <span>{{ $page->author }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="ml-3"><i class="far fa-eye mr-2"></i>{{ $page->views }}</span>
                            <span class="ml-3"><i class="far fa-comment mr-2"></i>{{ $page->comments->count() }}</span>
                        </div>
                    </div>

                    <!-- Share Buttons -->
                    <div class="d-flex align-items-center bg-white border border-top-0 px-4 py-3">
                        <strong class="mr-3">Share:</strong>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('posts.show', $page->slug)) }}"
                            target="_blank" class="btn rounded-circle mr-2"
                            style="color: #3b5999; border-color: #3b5999;" title="Share to Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', $page->slug)) }}&text={{ urlencode($page->title) }}"
                            target="_blank" class="btn btn-outline-info rounded-circle mr-2" title="Share to Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' ' . route('posts.show', $page->slug)) }}"
                            target="_blank" class="btn btn-outline-success rounded-circle mr-2"
                            title="Share to WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank"
                            class="btn btn-outline-danger rounded-circle" title="Share to Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    <!-- End Share Buttons -->

                </div>
                <!-- News Detail End -->

                @if ($page->comments_is_active)
                <!-- Comment List Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">{{ $comments->count() }} Comments</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-4">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @foreach ($comments as $comment)
                        <div class="media mb-4">
                            <div class="media-body">
                                <h6><a class="text-secondary font-weight-bold" href="">{{ $comment->name }}</a>
                                    <small><i>{{ $comment->created_at->format('F d, Y h:i A') }}</i></small>
                                </h6>
                                <p>{{ $comment->content }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Leave a comment</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-4">
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Nama *</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nama anda" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email anda" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message">Komentar *</label>
                                <textarea id="message" cols="30" rows="5" class="form-control" name="content"
                                    placeholder="Tulis komentar anda disini.."></textarea>
                            </div>

                            <div class="form-group mb-3">
                                {!! ReCaptcha::htmlScriptTagJsApi() !!}
                                {!! ReCaptcha::htmlFormSnippet() !!}
                                @error('g-recaptcha-response')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <input type="submit" value="Kirim"
                                    class="btn btn-primary font-weight-semi-bold py-2 px-3">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Comment Form End -->
                @endif
            </div>

            @include('themes.biz-news.layouts.sidebar')
        </div>
    </div>
</div>
<!-- News With Sidebar End -->
@endsection