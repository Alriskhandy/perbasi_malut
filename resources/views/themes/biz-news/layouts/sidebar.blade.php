<div class="col-lg-4">
    <!-- Popular News Start -->
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Trending Posts</h4>
        </div>
        <div class="bg-white border border-top-0 p-3">
            @foreach ($trendingPosts as $post)
                <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                    <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2"
                                href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name }}</a>
                            <datetime><small>{{ $post->created_at->format('M d, Y') }}</small></datetime>
                        </div>
                        <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 50, '...') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Popular News End -->

    <!-- Tags Start -->
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Kategori Artikel</h4>
        </div>
        <div class="bg-white border border-top-0 p-3">
            <div class="d-flex flex-wrap m-n1">
                @foreach ($categoriesAll as $item)
                <a href="{{ route('categories.show', $item->slug) }}" class="btn btn-sm btn-outline-secondary m-1">{{ $item->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Tags End -->
</div>