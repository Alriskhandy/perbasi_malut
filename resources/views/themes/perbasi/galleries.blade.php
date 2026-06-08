@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .album-card:hover .album-overlay {
            opacity: 1;
        }

        .album-card:hover img {
            transform: scale(1.05);
        }
    </style>
@endpush

@section('main')
    <main class="pt-24 min-h-screen">
        <!-- Hero Section -->
        <section
            class="relative bg-charcoal py-section-padding px-margin-mobile md:px-margin-desktop text-center overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div
                    class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-crimson-red via-transparent to-transparent">
                </div>
            </div>
            <div class="relative max-w-4xl mx-auto">
                <h1
                    class="font-headline-xl text-headline-xl text-off-white uppercase mb-4 md:text-headline-xl sm:text-headline-xl-mobile">
                    GALERI MEDIA
                </h1>
                <p class="font-body-lg text-body-lg text-secondary-fixed-dim max-w-2xl mx-auto">
                    Kumpulan momen berharga, semangat kompetisi, dan dedikasi pengembangan basket di Maluku Utara.
                    Telusuri setiap langkah perjalanan kami.
                </p>
            </div>
        </section>

        <!-- Filter Bar -->
        <section
            class="bg-surface-container-lowest py-8 sticky top-[84px] z-40 border-b border-surface-container-highest shadow-sm">
            <div
                class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-wrap items-center justify-center gap-4">
                <button
                    class="filter-btn active px-8 py-2 font-label-bold text-label-bold rounded-full bg-crimson-red text-white shadow-md transition-all">
                    Semua
                </button>
                <button
                    class="filter-btn px-8 py-2 font-label-bold text-label-bold rounded-full bg-surface-container text-on-surface-variant hover:bg-crimson-red hover:text-white transition-all">
                    Kompetisi
                </button>
                <button
                    class="filter-btn px-8 py-2 font-label-bold text-label-bold rounded-full bg-surface-container text-on-surface-variant hover:bg-crimson-red hover:text-white transition-all">
                    Kegiatan
                </button>
                <button
                    class="filter-btn px-8 py-2 font-label-bold text-label-bold rounded-full bg-surface-container text-on-surface-variant hover:bg-crimson-red hover:text-white transition-all">
                    Pelatihan
                </button>
            </div>
        </section>

        <!-- Album Grid -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-padding">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                @foreach ($galleries as $gallery)
                    <a href="{{ route('gallery.detail', $gallery->slug) }}"
                        class="album-card group relative bg-white overflow-hidden rounded-lg border border-surface-container-highest shadow-sm flex flex-col cursor-pointer">
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                src="{{ $gallery->cover_image ?? $gallery->image }}"
                                alt="{{ $gallery->title }}" />
                            <div
                                class="album-overlay absolute inset-0 bg-charcoal/40 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-5xl">visibility</span>
                            </div>
                            @if ($gallery->category)
                                <div
                                    class="absolute top-4 left-4 bg-crimson-red text-white font-label-bold text-label-bold px-3 py-1 rounded uppercase">
                                    {{ $gallery->category }}
                                </div>
                            @endif
                        </div>
                        <div class="p-stack-md flex flex-col flex-grow border-b-4 border-crimson-red">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-secondary text-sm font-label-bold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                                    {{ $gallery->created_at->format('d M Y') }}
                                </span>
                                @if (isset($gallery->images_count))
                                    <span class="text-secondary text-sm font-label-bold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">photo_library</span>
                                        {{ $gallery->images_count }} Foto
                                    </span>
                                @endif
                            </div>
                            <h3
                                class="font-headline-md text-headline-md text-charcoal group-hover:text-crimson-red transition-colors mb-2 uppercase">
                                {{ $gallery->title }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>

           
        </section>

    </main>
@endsection

@push('scripts')
    <script>
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('bg-crimson-red', 'text-white', 'shadow-md');
                    b.classList.add('bg-surface-container', 'text-on-surface-variant');
                });
                btn.classList.add('bg-crimson-red', 'text-white', 'shadow-md');
                btn.classList.remove('bg-surface-container', 'text-on-surface-variant');
                btn.style.transform = 'scale(0.95)';
                setTimeout(() => btn.style.transform = 'scale(1)', 100);
            });
        });

        const cards = document.querySelectorAll('.album-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-4px)';
                card.style.boxShadow = '0 10px 15px -3px rgba(0,0,0,0.1)';
                card.style.transition = 'all 0.3s ease';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = 'none';
            });
        });
    </script>
@endpush
