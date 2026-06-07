@extends('themes.zenblog.layouts.main')
@push('styles')
    <style>
        /* Trending Section */
        .trending h3 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .trending-post li {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .trending-post li .number {
            font-size: 24px;
            font-weight: bold;
            color: #ffc107;
            /* Warna kuning untuk angka */
        }

        .trending-post h4 {
            font-size: 16px;
            margin: 0;
        }

        .trending-post a {
            text-decoration: none;
            color: #333;
        }

        .trending-post a:hover {
            color: #007bff;
        }

        .trending-post .author {
            font-size: 14px;
            color: #777;
        }

        /* Container untuk gambar */
        .post-entry {
            position: relative;
            /* Pastikan elemen dalam kontainer dapat diatur layer-nya */
            overflow: hidden;
            /* Membatasi zoom hanya pada area gambar */
            border-radius: 8px;
            /* Membulatkan sudut */
            width: 100%;
            height: 200px;
            /* Ukuran seragam untuk semua gambar */
        }

        /* Gambar di dalam post-entry */
        /* Container untuk gambar */
        .post-entry {
            position: relative;
            /* Untuk mengatur layer elemen di dalamnya */
            overflow: hidden;
            /* Membatasi zoom hanya pada gambar */
            border-radius: 8px;
            /* Membulatkan sudut */
            width: 100%;
            height: auto;
            /* Biarkan kontainer menyesuaikan tinggi elemen di dalamnya */
            background-color: #f9f9f9;
            /* Tambahkan warna latar untuk debug jika diperlukan */
        }

        /* Gambar di dalam post-entry */
        .post-entry img {
            width: 100%;
            height: 200px;
            /* Ukuran tetap untuk gambar */
            object-fit: cover;
            /* Memastikan gambar memenuhi area tanpa distorsi */
            transition: transform 0.3s ease;
            /* Efek transisi untuk zoom-in */
            position: relative;
            /* Pastikan gambar tidak menutupi elemen lainnya */
            z-index: 1;
            /* Gambar di bawah elemen judul */
        }

        /* Efek zoom-in pada gambar saat hover */
        .post-entry:hover img {
            transform: scale(1.1);
            /* Zoom-in */
        }

        /* Meta informasi dan judul */
        .post-meta {
            margin-top: 10px;
            font-size: 14px;
            color: #777;
            /* Warna teks meta */
            z-index: 2;
            position: relative;
        }

        /* Container untuk gambar */
        .post-entry {
            position: relative;
            /* Untuk mengatur layer elemen di dalamnya */
            overflow: hidden;
            /* Membatasi zoom hanya pada gambar */
            border-radius: 8px;
            /* Membulatkan sudut */
            width: 100%;
            height: auto;
            /* Biarkan kontainer menyesuaikan tinggi elemen di dalamnya */
            background-color: #f9f9f9;
            /* Tambahkan warna latar untuk debug jika diperlukan */
        }

        /* Gambar di dalam post-entry */
        .post-entry img {
            width: 100%;
            height: 200px;
            /* Ukuran tetap untuk gambar */
            object-fit: cover;
            /* Memastikan gambar memenuhi area tanpa distorsi */
            transition: transform 0.3s ease;
            /* Efek transisi untuk zoom-in */
            position: relative;
            /* Pastikan gambar tidak menutupi elemen lainnya */
            z-index: 1;
            /* Gambar di bawah elemen judul */
        }

        /* Efek zoom-in pada gambar saat hover */
        .post-entry:hover img {
            transform: scale(1.1);
            /* Zoom-in */
        }

        /* Meta informasi dan judul */
        .post-meta {
            margin-top: 10px;
            font-size: 14px;
            color: #777;
            /* Warna teks meta */
            z-index: 2;
            position: relative;
        }

        /* Elemen judul */
        h2 a:hover {
            color: #ffc107 !important;
        }

        h4 a:hover {
            color: #ffc107 !important;
        }

        /* paginate */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            margin: 1px 5px;
            display: block;
            padding: 8px 12px;
            color: #000000;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination a:hover {
            /* background-color: #ffc107; */
            color: #ffc107;
        }

        .pagination .active span {
            background-color: #ffc107;
            color: white;
            border-color: #ffc107;
        }
    </style>
@endpush

@section('main')
    <main class="main">
        <!-- Trending Category Section -->
        <section id="trending-category" class="trending-category section">
            <!-- Section Title -->
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <div class="section-title-container d-flex align-items-center justify-content-between">
                    @php
                        $category = $category ?? null;
                    @endphp
                    <h2>{{ $category ? $category->name : 'All Posts' }}</h2>
                </div>
            </div><!-- End Section Title -->

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-5">
                    <!-- Main Content Posts -->
                    <div class="col-lg-8">
                        <div class="row g-5">
                            @foreach ($posts as $post)
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <!-- Menambahkan margin bawah agar ada jarak antar kartu -->
                                    <div class="post-entry card h-100 shadow-sm border-0">
                                        <!-- Menggunakan card untuk membuat tampilan lebih terstruktur -->
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                                class="card-img-top img-fluid rounded">
                                        </a>
                                        <div class="card-body">
                                            <div class="post-meta mb-2">
                                                <span class="text-muted">{{ $post->created_at->format('M d, Y') }}</span>
                                                <span class="mx-1">•</span>
                                                <span>Views: {{ $post->views }}</span>
                                            </div>
                                            <h5 class="card-title">
                                                <a class="text-dark" href="{{ route('posts.show', $post->slug) }}">
                                                    {{ Str::limit($post->title, 50) }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="pagination mt-4">
                            {{ $posts->links() }}
                        </div>
                    </div>

                    <!-- Trending Section -->
                    @include('themes.zenblog.layouts.sidebar')

                </div>
            </div>

        </section>
    </main>
@endsection
