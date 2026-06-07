<!-- Hero Section -->
<section id="hero" class="hero section">
    <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        @foreach ($banner as $post)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ $post->image }}" alt="{{ $post->title }}">
                <div class="container">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ Str::limit($post->excerpt, 150, '...') }}</p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="btn-get-started">Read More</a>
                </div>
            </div>
        @endforeach

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>
    </div>
</section>
<!-- /Hero Section -->
