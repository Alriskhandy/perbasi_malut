@extends('themes.biz-news.layouts.main')

@section('main')
<!-- Post Categories Start -->
<div class="container-fluid mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            @php
                            $category = $category ?? null;
                            @endphp
                            <h4 class="m-0 text-uppercase font-weight-bold">Category: {{ $category ? $category->name :
                                'All Posts' }}</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="{{ route('allPosts') }}">Lihat Semua</a>
                        </div>
                    </div>
                    @foreach ($posts as $post)
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <div style="height:225px; overflow:hidden;">

                                    <img class="img-fluid w-100 h-100" src="{{ $post->image }}" style="object-fit: cover;" alt="{{ $post->title }}">
                                </div>
                                <div class="bg-white border border-top-0 p-4">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                            href="{{ route('categories.show', $post->title) }}">{{ $post->category->name }}</a>
                                        <datetime><small>{{ $post->created_at->format('M d, Y') }}</small></datetime>
                                    </div>
                                    <a class="h6 d-block mb-0 text-secondary text-uppercase font-weight-bold" href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 50, '...') }}</a>
                                </div>
                                <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                    <div class="d-flex align-items-center">
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

                <!-- Pagination -->
                <div class="pagination mt-4">
                    {{ $posts->links() }}
                </div>
            </div>

            @include('themes.biz-news.layouts.sidebar')
        </div>
    </div>
</div>
<!-- Post Categories End -->
@endsection