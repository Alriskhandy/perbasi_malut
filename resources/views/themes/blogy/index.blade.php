@extends('themes.blogy.layouts.main')
{{-- 'featuredPost' => $posts->first(),
    'highlightedPosts' => $posts->skip(1)->take(4),
    'latestPosts' => $latestPosts, // Bisa paginated --}}
@section('main')
    <section id="blog-hero" class="blog-hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="blog-grid">
                <!-- Featured Post -->
                {{-- @if ($beritaUtama)
                    <article class="blog-item featured" data-aos="fade-up">
                        <img src="{{ asset('storage/' . $beritaUtama->image) }}" alt="{{ $beritaUtama->title }}"
                            class="img-fluid" />
                        <div class="blog-content">
                            <div class="post-meta">
                                <span class="date">{{ $beritaUtama->created_at->translatedFormat('M. jS, Y') }}</span>
                                <span class="category">{{ $beritaUtama->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            <h2 class="post-title">
                                <a href="{{ route('posts.show', $beritaUtama->slug) }}" title="{{ $beritaUtama->title }}">
                                    {{ Str::limit($beritaUtama->title, 80) }}
                                </a>
                            </h2>
                        </div>
                    </article>
                    @endif --}}
                @foreach ($banner->take(1) as $post)
                    <article class="blog-item featured" data-aos="fade-up">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid" />
                        <div class="blog-content">
                            <div class="post-meta">
                                <span class="date">{{ $post->created_at->translatedFormat('M. jS, Y') }}</span>
                                <span class="category">{{ $post->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            <h2 class="post-title">
                                <a href="{{ route('posts.show', $post->slug) }}" title="{{ $post->title }}">
                                    {{ Str::limit($post->title, 80) }}
                                </a>
                            </h2>
                        </div>
                    </article>
                @endforeach

                <!-- Other Highlighted Posts -->
                @foreach ($banner->skip(1)->take(1) as $p)
                    <article class="blog-item" data-aos="fade-up" data-aos-delay="{{ ($p->id + 1) * 100 }}">
                        <img src="{{ $p->image }}" alt="{{ $p->title }}" class="img-fluid" />
                        <div class="blog-content">
                            <div class="post-meta">
                                <span class="date">{{ $p->created_at->translatedFormat('M. jS, Y') }}</span>
                                <span class="category">{{ $p->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            <h3 class="post-title">
                                <a href="{{ route('posts.show', $p->slug) }}" title="{{ $p->title }}">
                                    {{ Str::limit($p->title, 70) }}
                                </a>
                            </h3>
                        </div>
                    </article>
                @endforeach

            </div>
        </div>
    </section>

    <!-- berita utama Posts Section -->
    <section id="latest-posts" class="latest-posts section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Featured Posts</h2>
            <div>
                <span>Check Our</span>
                <span class="description-title">Featured Posts</span>
            </div>
        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @foreach ($beritaUtama->take(4) as $utama)
                    <div class="col-lg-4">
                        <article>
                            <div class="post-img">
                                <img src="{{ $utama->image }}" alt="{{ $utama->title }}" class="img-fluid" />
                            </div>

                            <p class="post-category">{{ $utama->category->name ?? 'Uncategorized' }}</p>

                            <h2 class="title">
                                <a href="{{ route('posts.show', $utama->slug) }}">{{ Str::limit($utama->title, 80) }}</a>
                            </h2>

                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-author">Author : {{ $utama->author ?? 'Unknown Author' }}</p>
                                    <p class="post-date">
                                        <time
                                            datetime="{{ $utama->created_at->toDateString() }}">{{ $utama->created_at->translatedFormat('M. jS, Y') }}</time>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- /berita utama Posts Section -->

    <!-- Latest Posts Section -->
    <section id="latest-posts" class="latest-posts section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Latest Posts</h2>
            <div>
                <span>Check Our</span>
                <span class="description-title">Latest Posts</span>
            </div>
        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-lg-4">
                        <article>
                            <div class="post-img">
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid" />
                            </div>

                            <p class="post-category">{{ $post->category->name ?? 'Uncategorized' }}</p>

                            <h2 class="title">
                                <a href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 80) }}</a>
                            </h2>

                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-author">Author : {{ $post->author ?? 'Unknown Author' }}</p>
                                    <p class="post-date">
                                        <time
                                            datetime="{{ $post->created_at->toDateString() }}">{{ $post->created_at->translatedFormat('M. jS, Y') }}</time>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- /Latest Posts Section -->

    @if ($pengumumanPosts->count() > 0)
        <!-- Category Section Section -->
        <section id="category-section" class="category-section section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Announcements</h2>
                <div>
                    <span>Check Our</span>
                    <span class="description-title">Latest Announcements</span>
                </div>
            </div>
            <!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <!-- List Posts -->
                <div class="row">
                    @foreach ($pengumumanPosts->take(6) as $post)
                        <div class="col-xl-4 col-lg-6">
                            <article class="list-post">
                                <!-- Post Image -->
                                <div class="post-img">
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid"
                                        loading="lazy" />
                                </div>

                                <div class="post-content">
                                    <!-- Category Meta -->
                                    <div class="category-meta">
                                        <span class="post-category">{{ $post->category->name ?? 'Uncategorized' }}</span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="title">
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            {{ Str::limit($post->title, 80, '...') }}
                                        </a>
                                    </h3>

                                    <!-- Post Meta (Read time and Date) -->
                                    <div class="post-meta">
                                        <span
                                            class="post-date">{{ $post->created_at->translatedFormat('M. jS, Y') }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- /Category Section Section -->
    @endif
    {{-- <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="cta-content" data-aos="fade-up" data-aos-delay="200">
                        <h2>Subscribe to our newsletter</h2>
                        <p>
                            Proin eget tortor risus. Mauris blandit aliquet elit, eget
                            tincidunt nibh pulvinar a. Curabitur aliquet quam id dui
                            posuere blandit.
                        </p>
                        <form action="forms/newsletter.php" method="post" class="php-email-form cta-form"
                            data-aos="fade-up" data-aos-delay="300">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email address..."
                                    aria-label="Email address" aria-describedby="button-subscribe" />
                                <button class="btn btn-primary" type="submit" id="button-subscribe">
                                    Subscribe
                                </button>
                            </div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">
                                Your subscription request has been sent. Thank you!
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cta-image" data-aos="zoom-out" data-aos-delay="200">
                        <img src="assets/img/cta/cta-1.webp" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Call To Action Section --> --}}
@endsection
