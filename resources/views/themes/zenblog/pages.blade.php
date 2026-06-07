@extends('themes.zenblog.layouts.main')
@section('main')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">{{ $page->title }}</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">{{ $page->title }}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Blog Details Section -->
                    <section id="blog-details" class="blog-details section">
                        <div class="container">

                            <article class="article">


                                <div class="content">
                                    {!! $page->content !!}

                                </div><!-- End post content -->

                            </article>

                        </div>
                    </section><!-- /Blog Details Section -->


                </div>

                @include('themes.zenblog.layouts.sidebar')

            </div>
        </div>

    </main>
@endsection
