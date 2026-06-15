@extends('themes.perbasi.layouts.main')

@section('title', $gallery->name . ' - Galeri ' . $site_name->value)

@push('styles')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #0a0f1a 0%, #111827 40%, #0a0f1a 100%);
        }
        .hero-pattern {
            background-image:
                repeating-linear-gradient(0deg, rgba(255,255,255,0.03) 0px, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 36px),
                repeating-linear-gradient(90deg, rgba(255,255,255,0.03) 0px, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 36px);
        }
        .photo-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .photo-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.18); }
        .photo-card:hover .photo-overlay { opacity: 1; }
        .photo-overlay { transition: opacity 0.25s ease; }

        /* Lightbox */
        #lightbox { display: none; }
        #lightbox.open { display: flex; }
        #lb-img { transition: opacity 0.2s ease; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-fade-up  { animation: fadeUp 0.6s ease both; }
        .anim-delay-2  { animation-delay: 0.2s; }
    </style>
@endpush

@section('main')
    <main class="mt-16 md:mt-20">

        <!-- Hero -->
        <div class="hero-bg border-b-4 border-crimson-red overflow-hidden relative">
            <div class="hero-pattern absolute inset-0 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 flex items-center pr-margin-desktop select-none pointer-events-none overflow-hidden">
                <span class="font-headline-xl oswald text-white/[0.03] uppercase leading-none text-[clamp(80px,14vw,200px)] tracking-tighter line-clamp-1">
                    {{ strtoupper($gallery->name) }}
                </span>
            </div>

            <div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16 md:py-24">

                <!-- Breadcrumb -->
                <p class="font-label-bold text-crimson-red uppercase tracking-widest text-xs mb-8 anim-fade-up">
                    <a href="{{ route('galleries.front') }}" class="hover:text-off-white transition-colors">Galeri</a>
                    <span class="text-surface-variant mx-2">/</span>
                    <span class="text-surface-variant">{{ $gallery->name }}</span>
                </p>

                <div class="flex flex-col lg:flex-row lg:items-end gap-10 lg:gap-20">
                    <div class="flex-1 anim-fade-up">
                        <h1 class="font-headline-xl text-off-white uppercase leading-none mb-4 text-headline-xl-mobile md:text-headline-xl">
                            {{ $gallery->name }}
                        </h1>
                        <div class="w-16 h-1 bg-crimson-red mb-4"></div>
                        @if ($gallery->description)
                            <p class="font-body-lg text-surface-variant max-w-xl leading-relaxed">
                                {{ $gallery->description }}
                            </p>
                        @endif
                        @if ($gallery->location)
                            <div class="flex items-center gap-2 mt-4">
                                <span class="material-symbols-outlined text-crimson-red text-[16px]">location_on</span>
                                <span class="font-label-bold text-surface-variant text-xs uppercase tracking-widest">{{ $gallery->location }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex lg:flex-col gap-8 lg:gap-6 anim-fade-up anim-delay-2">
                        <div class="border-l-2 border-crimson-red pl-6">
                            <span class="font-headline-xl oswald text-off-white leading-none block text-[clamp(40px,6vw,64px)]">
                                {{ $meta->count() }}
                            </span>
                            <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">Foto</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Photo Grid -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">

            @if ($meta->isEmpty())
                <div class="text-center py-24 border border-dashed border-outline-variant rounded-lg">
                    <span class="material-symbols-outlined text-6xl text-outline-variant block mb-3">photo_library</span>
                    <p class="font-headline-md text-charcoal text-lg mb-1">Belum ada foto di album ini</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach ($meta as $i => $item)
                        <div class="photo-card group relative bg-surface-container-low overflow-hidden rounded-lg aspect-square cursor-pointer"
                             data-index="{{ $i }}"
                             onclick="openLightbox({{ $i }})">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 src="{{ \App\Helpers\Media::url($item->image) }}"
                                 alt="{{ $item->description ?? $gallery->name }}"
                                 loading="lazy" />
                            <div class="photo-overlay absolute inset-0 bg-charcoal/60 opacity-0 flex flex-col items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-white text-4xl">zoom_in</span>
                                @if ($item->description)
                                    <p class="text-white/80 text-xs font-label-bold px-4 text-center line-clamp-2">{{ $item->description }}</p>
                                @endif
                            </div>
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-crimson-red group-hover:w-full transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Back -->
            <div class="flex justify-center pt-10 mt-4 border-t border-charcoal/10">
                <a href="{{ route('galleries.front') }}"
                   class="flex items-center gap-3 bg-charcoal text-off-white font-label-bold px-8 py-3.5 rounded hover:bg-crimson-red transition-colors uppercase tracking-wider text-sm group">
                    <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                    Kembali ke Galeri
                </a>
            </div>
        </section>

    </main>

    <!-- Lightbox -->
    <div id="lightbox"
         class="fixed inset-0 z-[9999] bg-black/90 items-center justify-center open:flex"
         onclick="closeLightboxOutside(event)">

        <!-- Close -->
        <button onclick="closeLightbox()"
                class="absolute top-4 right-4 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full w-10 h-10 flex items-center justify-center transition-colors z-10">
            <span class="material-symbols-outlined">close</span>
        </button>

        <!-- Prev -->
        <button id="lb-prev" onclick="lbNav(-1)"
                class="absolute left-3 md:left-6 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full w-10 h-10 flex items-center justify-center transition-colors z-10">
            <span class="material-symbols-outlined">chevron_left</span>
        </button>

        <!-- Image container -->
        <div class="flex flex-col items-center max-w-[90vw] max-h-[90vh] px-8 md:px-14">
            <img id="lb-img" src="" alt=""
                 class="max-w-full max-h-[78vh] object-contain rounded shadow-2xl" />
            <div class="flex items-center gap-4 mt-4">
                <p id="lb-caption" class="text-white/60 text-sm font-body-md text-center"></p>
                <a id="lb-download" href="#" download
                   class="flex items-center gap-1.5 bg-crimson-red text-white font-label-bold text-xs px-4 py-2 rounded hover:bg-[#8a1d29] transition-colors uppercase tracking-wider flex-shrink-0">
                    <span class="material-symbols-outlined text-[15px]">download</span>
                    Unduh
                </a>
            </div>
            <p id="lb-counter" class="text-white/30 text-xs font-label-bold mt-2 uppercase tracking-widest"></p>
        </div>

        <!-- Next -->
        <button id="lb-next" onclick="lbNav(1)"
                class="absolute right-3 md:right-6 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full w-10 h-10 flex items-center justify-center transition-colors z-10">
            <span class="material-symbols-outlined">chevron_right</span>
        </button>
    </div>
@endsection

@push('scripts')
    <script>
        const photos = @json($meta->map(fn($m) => ['src' => \App\Helpers\Media::url($m->image), 'caption' => $m->description])->values());
        let currentIndex = 0;

        function openLightbox(index) {
            currentIndex = index;
            renderLightbox();
            document.getElementById('lightbox').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
            document.body.style.overflow = '';
        }

        function closeLightboxOutside(e) {
            if (e.target === document.getElementById('lightbox')) closeLightbox();
        }

        function lbNav(dir) {
            currentIndex = (currentIndex + dir + photos.length) % photos.length;
            renderLightbox();
        }

        function renderLightbox() {
            const photo = photos[currentIndex];
            const img = document.getElementById('lb-img');
            img.style.opacity = '0';
            img.src = photo.src;
            img.onload = () => { img.style.opacity = '1'; };
            document.getElementById('lb-caption').textContent = photo.caption ?? '';
            document.getElementById('lb-counter').textContent = (currentIndex + 1) + ' / ' + photos.length;
            const dl = document.getElementById('lb-download');
            dl.href = photo.src;
            // Extract filename from URL for download attribute
            dl.download = photo.src.split('/').pop() || 'foto';
            // Hide nav if only 1 photo
            document.getElementById('lb-prev').style.display = photos.length > 1 ? '' : 'none';
            document.getElementById('lb-next').style.display = photos.length > 1 ? '' : 'none';
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            const lb = document.getElementById('lightbox');
            if (!lb.classList.contains('open')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') lbNav(-1);
            if (e.key === 'ArrowRight') lbNav(1);
        });
    </script>
@endpush
