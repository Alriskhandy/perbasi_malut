<style>
    .sidebar {
        position: sticky;
        top: 20px;
    }

    .widget-item {
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    /* Widget Title */
    .widget-title {
        color: #333;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #5DB996;
    }

    /* Search Widget */
    .search-widget form {
        display: flex;
        gap: 10px;
    }

    .search-widget input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        outline: none;
        transition: all 0.3s ease;
    }

    .search-widget input:focus {
        border-color: #5DB996;
        box-shadow: 0 0 0 0.2rem rgba(255, 157, 35, 0.25);
    }

    .search-widget button {
        background: #5DB996;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .search-widget button:hover {
        background: #5db9968f;
    }

    /* Trending Posts Widget */
    .post-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .post-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .post-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }

    .post-item h4 {
        font-size: 15px;
        margin-bottom: 8px;
    }

    .post-item h4 a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .post-item h4 a:hover {
        color: #5DB996;
    }

    .post-item time {
        font-size: 13px;
        color: #777;
    }

    /* Categories Widget */
    .tags-widget ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tags-widget li {
        margin-bottom: 10px;
    }

    .tags-widget li:last-child {
        margin-bottom: 0;
    }

    .tags-widget a {
        display: block;
        color: #333;
        text-decoration: none;
        padding: 8px 15px;
        background: #f8f9fa;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .tags-widget a:hover {
        background: #5DB996;
        color: white;
    }
</style>

<div class="sidebar">
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
                    <img src="{{ $post->image }}" alt="{{ $post->title }}">
                    <div>
                        <h4>
                            <a href="{{ route('posts.show', $post->slug) }}">
                                {{ Str::limit($post->title, 50) }}
                            </a>
                        </h4>
                        <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                            {{ $post->created_at->format('M d, Y') }}
                        </time>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Categories Widget -->
        <div class="tags-widget widget-item">
            <h3 class="widget-title">Kategori Artikel</h3>
            <ul>
                @foreach ($categoriesAll as $item)
                    <li>
                        <a href="{{ route('categories.show', $item->slug) }}">
                            {{ $item->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
