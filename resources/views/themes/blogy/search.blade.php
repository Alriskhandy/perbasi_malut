@extends('themes.blogy.layouts.main')

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container d-flex justify-content-between align-items-center">
                <h2>Hasil Pencarian</h2>
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Search: "{{ $query }}"</li>
                </ol>
            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Search Results Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">

                    <!-- Hasil pencarian -->
                    <div class="col-lg-8 entries">

                        @if ($posts->count() > 0 || $pages->count() > 0)

                            @if ($posts->count() > 0)
                                <div class="section-header mb-4">
                                    <h3>Postingan</h3>
                                </div>

                                @foreach ($posts as $post)
                                    <article class="entry d-flex flex-column">

                                        @if ($post->image)
                                            <div class="entry-img">
                                                <a href="{{ route('posts.show', $post->slug) }}">
                                                    <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                                        class="img-fluid rounded" style="height: 200px; object-fit: cover;">
                                                </a>
                                            </div>
                                        @endif

                                        <h2 class="entry-title mt-3">
                                            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h2>

                                        <div class="entry-content">
                                            <p>{{ Str::limit(strip_tags($post->content), 200) }}</p>
                                        </div>
                                    </article>
                                @endforeach

                                <div class="pagination mt-4">
                                    {{ $posts->appends(['q' => $query])->links() }}
                                </div>
                            @endif

                            @if ($pages->count() > 0)
                                <div class="section-header mt-5 mb-4">
                                    <h3>Halaman</h3>
                                </div>
                                @foreach ($pages as $page)
                                    <article class="entry d-flex flex-column">

                                        @if ($page->image)
                                            <div class="entry-img">
                                                <a href="{{ route('pages.show', $page->slug) }}">
                                                    <img src="{{ $page->image }}" alt="{{ $page->title }}"
                                                        class="img-fluid rounded" style="height: 200px; object-fit: cover;">
                                                </a>
                                            </div>
                                        @endif

                                        <h2 class="entry-title mt-3">
                                            <a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a>
                                        </h2>

                                        <div class="entry-content">
                                            <p>{{ Str::limit(strip_tags($page->content), 200) }}</p>
                                        </div>
                                    </article>
                                @endforeach

                                <div class="pagination mt-4">
                                    {{ $pages->appends(['q' => $query])->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center p-5 bg-light rounded shadow-sm">
                                <h3 class="text-dark mb-3">Tidak ditemukan hasil</h3>
                                <p class="text-muted">Maaf, tidak ada konten yang cocok dengan kata kunci pencarian. Silakan
                                    coba lagi dengan kata kunci yang berbeda.</p>
                            </div>
                        @endif

                    </div><!-- End entries -->

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        @include('themes.blogy.layouts.sidebar')
                    </div><!-- End sidebar -->

                </div>
            </div>
        </section><!-- End Search Results Section -->

    </main><!-- End #main -->
@endsection
