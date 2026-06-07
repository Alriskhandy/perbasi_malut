<div class="col-lg-4 sidebar">

    <div class="widgets-container">

        <!-- Search Widget -->
        <div class="search-widget widget-item">
            <h3 class="widget-title">Search</h3>
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}">
                <button type="submit" title="Search">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <!-- Trending Posts Widget -->
        <div class="recent-posts-widget widget-item">
            <h3 class="widget-title">Trendings Posts</h3>

            @foreach ($trendingPosts as $post)
                <div class="post-item">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="flex-shrink-0">
                    <div>
                        <h4><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h4>
                        <time
                            datetime="{{ $post->created_at->format('Y-m-d') }}">{{ $post->created_at->format('M d, Y') }}</time>
                    </div>
                </div><!-- End post item-->
            @endforeach

        </div><!--/Trending Posts Widget -->

        <!-- Tags Widget -->
        <div class="tags-widget widget-item">
            <h3 class="widget-title">Kategori Artikel</h3>
            <ul>
                @foreach ($categoriesAll as $item)
                    <li><a href="{{ route('categories.show', $item->slug) }}">{{ $item->name }}</a></li>
                @endforeach
            </ul>
        </div><!--/Tags Widget -->

    </div>

</div>
