@extends('themes.biz-news.layouts.main')

@section('main')
@include('themes.biz-news.layouts.hero')
<!-- Pengumuman Slider Start -->
@if ($pengumumanPosts->count() > 0)
<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <a href="{{ route('categories.show', 'pengumuman') }}">
                <h4 class="m-0 text-uppercase font-weight-bold">Pengumuman</h4>
            </a>
        </div>
        <div class="owl-carousel news-carousel carousel-item-4 position-relative">
            @foreach ($pengumumanPosts->take(6) as $post)
            <div class="position-relative overflow-hidden" style="height: 300px;">
                <img class="img-fluid h-100" src="{{ $post->image }}" style="object-fit: cover;">
                <div class="overlay">
                    <div class="mb-2">
                        <datetime class="text-white"><small>{{ $post->created_at->format('M d, Y') }}</small>
                        </datetime>
                    </div>
                    <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="{{ route('posts.show',
                                    $post->slug) }}">{{ Str::limit($post->title, 50, '...') }}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- Pengumuman Slider End -->


<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Berita Terbaru</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none"
                                href="{{ route('allPosts') }}">Selengkapnya</a>
                        </div>
                    </div>
                    @foreach ($posts->take(8) as $post)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{ $post->image }}" style="object-fit: cover;"
                                alt="{{ $post->title }}">
                            <div class="bg-white border border-top-0 p-4">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="{{ route('categories.show', $post->category->slug) }}">{{
                                        $post->category->name }}</a>
                                    <datetime class="text-body"><small>{{ $post->created_at->format('M d, Y') }}</small>
                                    </datetime>
                                </div>
                                <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="{{ route('posts.show',
                                    $post->slug) }}">{{ Str::limit($post->title, 60, '...') }}</a>
                                <p class="m-0">{{ Str::limit($post->excerpt, 100, '...') }}</p>
                            </div>
                            <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                                    <small>{{ $post->author }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="ml-3"><i class="far fa-eye mr-2"></i>{{ $post->views }}</small>
                                    <small class="ml-3"><i class="far fa-comment mr-2"></i>{{ $post->comments->count() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            @include('themes.biz-news.layouts.sidebar')
        </div>
    </div>
</div>
<!-- News With Sidebar End -->
@endsection