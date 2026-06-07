@extends('themes.arsha.layouts.main')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">{{ $page->title}}</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Page Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container" data-aos="fade-up">

                        <article class="article">

                            <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                                <div class="content-header">
                                    <h1 class="title">{{ $page->title }}
                                    </h1>
                                </div>

                                <div class="content">
                                    {!! $page->content !!}
                                </div>
                            </div>

                        </article>

                    </div>
                </section>
                <!-- /Page Details Section -->
            </div>

            @include('themes.arsha.layouts.sidebar')

        </div>
    </div>

</main>
@endsection