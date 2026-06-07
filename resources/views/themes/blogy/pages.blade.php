@extends('themes.blogy.layouts.main')

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container d-flex justify-content-between align-items-center">
                <h2>{{ $page->title }}</h2>
            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Page Content Section ======= -->
        <section class="inner-page">
            <div class="container">
                <div class="row gy-4">

                    <!-- Konten utama -->
                    <div class="col-lg-8">
                        <article class="entry entry-single">
                            <div class="entry-content">
                                {!! $page->content !!}
                            </div>
                        </article>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        @include('themes.blogy.layouts.sidebar')
                    </div>

                </div>
            </div>
        </section><!-- End Page Content Section -->

    </main><!-- End #main -->
@endsection
