@extends('themes.biz-news.layouts.main')

@section('main')
<!-- Search Result Start -->
<div class="container-fluid mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h4 class="m-0 text-uppercase font-weight-bold">Search Result</h4>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    @if ($posts->count() > 0 || $pages->count() > 0)

                        <!-- Found Posts Start -->
                        @if ($posts->count() > 0)
                            <div class="col-12">
                                <div class="section-title">
                                    <h4 class="m-0 text-uppercase font-weight-bold">Posts</h4>
                                </div>
                            </div>
                            @foreach ($posts as $post)
                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <div style="height:225px; overflow:hidden;">

                                            <img class="img-fluid w-100 h-100" src="{{ $post->image }}" style="object-fit: cover;"
                                                alt="{{ $post->title }}">
                                        </div>
                                        <div class="bg-white border border-top-0 p-4">
                                            <div class="mb-2">
                                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                                    href="{{ route('categories.show', $post->title) }}">{{ $post->category->name
                                                    }}</a>
                                                <datetime><small>{{ $post->created_at->format('M d, Y') }}</small></datetime>
                                            </div>
                                            <a class="h6 d-block mb-0 text-secondary text-uppercase font-weight-bold"
                                                href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 50, '...')
                                                }}</a>
                                        </div>
                                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                            <div class="d-flex align-items-center">
                                                <small>{{ $post->author }}</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="ml-3"><i class="far fa-eye mr-2"></i>{{ $post->views }}</small>
                                                <small class="ml-3"><i class="far fa-comment mr-2"></i>{{ $post->comments->count()
                                                    }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pagination-container">
                                {{ $posts->appends(['q' => $query])->links() }}
                            </div>
                        @endif
                        <!-- Found Posts End -->
                        
                        <!-- Found Pages Start -->
                        @if ($pages->count() > 0)
                            <div class="col-12">
                                <div class="section-title">
                                    <h4 class="m-0 text-uppercase font-weight-bold">Pages</h4>
                                </div>
                            </div>
                            @foreach ($pages as $page)
                                <div class="col-lg-12 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-justify">
                                            <a href="{{ route('pages.show', $page->slug) }}" class="h4 text-secondary text-uppercase font-weight-bold d-block mb-3">
                                                {{ $page->title }}
                                            </a>
                                            <p class="card-text mb-0">
                                                {{ Str::limit(strip_tags($page->content), 200) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="pagination-container">
                                {{ $pages->appends(['q' => $query])->links() }}
                            </div>
                        @endif    
                        <!-- Found Pages End -->
                    @else
                        <!-- No Result Start -->
                        <div class="position-relative mb-3">
                            <div class="bg-white border border-top-0 p-4">
                                <h3>No results found</h3>
                                <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
                            </div>
                        </div>
                        <!-- No Result End -->
                    @endif
                </div>
            </div>

            @include('themes.biz-news.layouts.sidebar')
        </div>
    </div>
</div>
<!-- Search Result End -->
@endsection