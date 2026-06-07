@extends('themes.medicio.layouts.main')
@section('main')
    <!-- ======= Galleries Section ======= -->
    <section id="galleries" class="galleries">
        <div class="container">
            <div class="section-title">
                <h2>Our Galleries</h2>
                {{-- <nav>
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Galleries</li>
                    </ol>
                </nav> --}}
            </div>

            <div class="row">
                @foreach ($galleries as $item)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-4">
                        <div class="gallery-box">
                            <a href="{{ route('gallery.detail', $item->slug) }}" class="gallery-link">
                                <div class="gallery-img">
                                    <img src="{{ $item->image }}" class="img-fluid" alt="{{ $item->name }}">
                                    <div class="gallery-date">
                                        <span>{{ $item->created_at->format('M Y') }}</span>
                                    </div>
                                </div>
                                <div class="gallery-info">
                                    <h4>{{ $item->name }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Galleries Section -->

    <style>
        .galleries {
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

        .gallery-box {
            border-radius: 5px;
            background: #fff;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            width: 100%;
        }

        .gallery-box:hover {
            transform: translateY(-5px);
        }

        .gallery-img {
            position: relative;
            overflow: hidden;
        }

        .gallery-img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .gallery-date {
            position: absolute;
            right: 10px;
            bottom: 10px;
            padding: 5px 10px;
            background: rgba(25, 119, 204, 0.8);
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
        }

        .gallery-info {
            padding: 20px;
        }

        .gallery-info h4 {
            color: #2c4964;
            font-size: 18px;
            margin-bottom: 0;
            font-weight: 600;
        }

        .gallery-link {
            text-decoration: none;
        }

        .breadcrumb {
            background: transparent;
            margin-bottom: 0;
            padding: 0;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: #2c4964;
        }

        .breadcrumb-item.active {
            color: #1977cc;
        }
    </style>
@endsection
