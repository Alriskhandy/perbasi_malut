@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        .image-card:hover img {
            transform: scale(1.03);
        }

        .breadcrumb-separator::after {
            content: "/";
            margin: 0 8px;
            color: #5c5f62;
        }
    </style>
@endpush

@section('main')
    <main class="pt-32 pb-section-padding px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <!-- Breadcrumb -->
        <nav class="mb-stack-lg">
            <ol class="flex items-center font-label-bold text-label-bold text-secondary">
                <li class="breadcrumb-separator hover:text-crimson-red transition-colors cursor-pointer">
                    <a href="/">Beranda</a>
                </li>
                <li class="breadcrumb-separator hover:text-crimson-red transition-colors cursor-pointer">
                    <a href="{{ route('galleries.front') }}">Galeri</a>
                </li>
                <li class="text-crimson-red">{{ $gallery->title }}</li>
            </ol>
        </nav>

        <!-- Album Header -->
        <section class="mb-section-padding border-l-8 border-crimson-red pl-8">
            <h1 class="font-headline-xl text-headline-xl uppercase tracking-tighter mb-stack-sm text-charcoal">
                {{ $gallery->title }}
            </h1>
            <div class="flex flex-wrap items-center gap-6 text-secondary mb-stack-md font-label-bold text-label-bold">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-crimson-red">calendar_today</span>
                    <span>{{ strtoupper($gallery->created_at->format('d F Y')) }}</span>
                </div>
                @if ($gallery->location)
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-crimson-red">location_on</span>
                        <span>{{ strtoupper($gallery->location) }}</span>
                    </div>
                @endif
            </div>
            @if ($gallery->description)
                <p class="font-body-lg text-body-lg text-secondary max-w-3xl">
                    {{ $gallery->description }}
                </p>
            @endif
        </section>

        <!-- Gallery Grid -->
        <section class="gallery-grid mb-section-padding">
            @foreach ($gallery->images ?? [] as $image)
                <div class="image-card group relative overflow-hidden bg-white border border-charcoal/10 shadow-sm cursor-pointer">
                    <img class="w-full h-64 object-cover transition-transform duration-500"
                        src="{{ $image->url ?? $image }}" alt="{{ $gallery->title }}" />
                    <div
                        class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-3xl">zoom_in</span>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-crimson-red"></div>
                </div>
            @endforeach
        </section>

        <!-- Navigation Footer -->
        <div class="flex justify-center pt-8 border-t border-charcoal/10">
            <a href="{{ route('galleries.front') }}"
                class="flex items-center gap-3 bg-charcoal text-white px-10 py-4 font-headline-md text-stats-display uppercase tracking-wider hover:bg-crimson-red transition-all group">
                <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                KEMBALI KE GALERI
            </a>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.image-card').forEach(card => {
            card.addEventListener('click', () => {
                card.style.opacity = '0.5';
                setTimeout(() => card.style.opacity = '1', 150);
            });
        });

        document.querySelectorAll('.breadcrumb-separator').forEach(link => {
            link.addEventListener('mouseenter', () => link.classList.add('text-crimson-red'));
            link.addEventListener('mouseleave', () => link.classList.remove('text-crimson-red'));
        });
    </script>
@endpush
