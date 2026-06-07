@extends('themes.medicio.layouts.main')

@section('main')
    <section id="search-results" class="search-results">
        <div class="container">
            <div class="section-title">
                <h2>Search Results</h2>
                <p>Search results for: "{{ $query }}"</p>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    @if ($posts->count() > 0 || $pages->count() > 0)
                        @if ($posts->count() > 0)
                            <h3>Posts</h3>
                            @foreach ($posts as $post)
                                <div class="search-item">
                                    <h4><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h4>
                                    <p>{{ Str::limit(strip_tags($post->content), 200) }}</p>
                                </div>
                            @endforeach
                            {{ $posts->appends(['q' => $query])->links() }}
                        @endif

                        @if ($pages->count() > 0)
                            <h3>Pages</h3>
                            @foreach ($pages as $page)
                                <div class="search-item">
                                    <h4><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></h4>
                                    <p>{{ Str::limit(strip_tags($page->content), 200) }}</p>
                                </div>
                            @endforeach
                            {{ $pages->appends(['q' => $query])->links() }}
                        @endif
                    @else
                        <div class="no-results">
                            <h3>No results found</h3>
                            <p>Sorry, but nothing matched your search terms. Please try again with some different keywords.
                            </p>
                        </div>
                    @endif
                </div>

                <div class="col-4">
                    @include('themes.medicio.layouts.sidebar')
                </div>
            </div>
        </div>
    </section>

    <style>
        .search-results {
            padding: 60px 0;
            background: #f6f9fe;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            color: #2c4964;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .search-item {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .search-item h4 {
            margin-bottom: 10px;
        }

        .search-item h4 a {
            color: #2c4964;
            text-decoration: none;
        }

        .search-item h4 a:hover {
            color: #1977cc;
        }

        .search-item p {
            color: #666;
            margin-bottom: 0;
        }

        .no-results {
            background: #fff;
            padding: 30px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .no-results h3 {
            color: #2c4964;
            margin-bottom: 15px;
        }

        .pagination {
            margin-top: 20px;
            justify-content: center;
        }
    </style>
@endsection
