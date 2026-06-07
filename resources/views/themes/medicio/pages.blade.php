@extends('themes.medicio.layouts.main')
@section('main')
    <!-- ======= Page Details Section ======= -->
    <section id="page-details" class="page-details">
        <div class="container">
            <div class="section-title">
                <h2>{{ $page->title }}</h2>
                {{-- <nav>
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">{{ $page->title }}</li>
                    </ol>
                </nav> --}}
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="page-content">
                        <article class="entry">
                            <div class="entry-content">
                                {!! $page->content !!}
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-4">

                    @include('themes.medicio.layouts.sidebar')
                </div>

            </div>
        </div>
    </section>

    <style>
        .page-details {
            padding: 60px 0;
            background: #f6f9fe;
        }

        .section-title {
            text-align: center;
            padding-bottom: 30px;
        }

        .section-title h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            padding-bottom: 20px;
            position: relative;
            color: #2c4964;
        }

        .section-title h2::before {
            content: "";
            position: absolute;
            display: block;
            width: 120px;
            height: 1px;
            background: #ddd;
            bottom: 1px;
            left: calc(50% - 60px);
        }

        /* .section-title h2::after {
                content: "";
                position: absolute;
                display: block;
                width: 40px;
                height: 3px;
                background: #1977cc;
                bottom: 0;
                left: calc(50% - 20px);
            } */

        .page-content {
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .entry {
            margin-bottom: 30px;
        }

        .entry-content {
            line-height: 1.8;
            color: #444444;
        }

        .entry-content p {
            margin-bottom: 20px;
        }

        .entry-content h1,
        .entry-content h2,
        .entry-content h3,
        .entry-content h4,
        .entry-content h5,
        .entry-content h6 {
            color: #2c4964;
            margin-bottom: 20px;
        }

        .entry-content img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 5px;
        }

        .entry-content a {
            color: #1977cc;
            text-decoration: none;
        }

        .entry-content a:hover {
            text-decoration: underline;
        }

        .breadcrumb {
            background: transparent;
            margin-bottom: 0;
            padding: 0;
            justify-content: center;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: #2c4964;
        }

        .breadcrumb-item.active {
            color: #1977cc;
        }

        @media (max-width: 768px) {
            .page-content {
                padding: 20px;
            }
        }
    </style>
@endsection
