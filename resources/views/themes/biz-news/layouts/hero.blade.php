<!-- Main News Slider Start -->
<div class="container-fluid">
    <div class="row">
        <!-- Main Slider -->
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                @foreach ($banner as $post)
                <div class="position-relative overflow-hidden" style="height: 500px;">
                    <img class="img-fluid h-100" src="{{ $post->image }}" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name
                                }}</a>
                            <datetime class="text-white">{{ $post->created_at->format('M d, Y') }}</datetime>
                        </div>
                        <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                            href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 100, '...') }}</a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        <!-- Berita Utama -->
        <div class="col-lg-5 px-0">
            <div class="row mx-0">
                @foreach ($beritaUtama->take(4) as $post)
                <div class="col-md-6 px-0">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img class="img-fluid w-100 h-100" src="{{ $post->image }}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="{{ route('categories.show', $post->category->slug) }}">{{
                                    $post->category->name }}</a>
                                <datetime class="text-white"><small>{{ $post->created_at->format('M d, Y') }}</small>
                                </datetime>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="{{ route('posts.show',
                                $post->slug) }}">{{ Str::limit($post->title, 100, '...') }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->


<!-- Breaking News Start -->
@if ($pengumumanPosts->count() > 0)

<div class="container-fluid bg-dark py-3 mb-3">
    <div class="container">
        <div class="row align-items-center bg-dark">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">
                        Breaking News</div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                        style="width: calc(100% - 170px); padding-right: 90px;">
                        @foreach ($pengumumanPosts->take(3) as $post)
                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold"
                                href="{{ route('posts.show', $post->slug) }}">{{ Str::limit($post->title, 100, '...')
                                }}</a></div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Breaking News End -->