<div class="col-lg-4 sidebar">

    <div class="widgets-container" data-aos="fade-up" data-aos-delay="200">

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
        <!--/Search Widget -->

        <!-- Recent Posts Widget -->
        <div class="recent-posts-widget widget-item">

            <h3 class="widget-title">Trending Posts</h3>

            @foreach ($trendingPosts as $post)
            <div class="post-item">
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="flex-shrink-0">
                <div>
                    <h4><a href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 50, '...') }}</a></h4>
                    <time datetime="{{ $post->created_at->format('Y-m-d') }}">{{ $post->created_at->format('M d, Y') }}</time>
                </div>
            </div><!-- End recent post item-->
            @endforeach

        </div>
        <!--/Recent Posts Widget -->

        <!-- Categories Widget -->
        <div class="categories-widget widget-item">

            <h3 class="widget-title">Categories</h3>
            <ul class="mt-3">
                @foreach ($categoriesAll as $item)
                <li><a href="{{ route('categories.show', $item->slug) }}">{{ $item->name }}</a></li>
                @endforeach
            </ul>

        </div>
        <!--/Categories Widget -->

    </div>

</div>