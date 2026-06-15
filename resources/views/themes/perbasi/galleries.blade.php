@extends('themes.perbasi.layouts.main')

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
        .album-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .album-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.15);
        }
        .album-card:hover .album-overlay {
            opacity: 1;
        }
        .album-card:hover img {
            transform: scale(1.06);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-fade-up { animation: fadeUp 0.6s ease both; }
        .anim-delay-2 { animation-delay: 0.2s; }
    </style>
@endpush

@section('main')
    <main class="mt-16 md:mt-20">

        <!-- Hero -->
        <div class="hero-bg border-b-4 border-crimson-red overflow-hidden relative">
            <div class="hero-pattern absolute inset-0 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 flex items-center pr-margin-desktop select-none pointer-events-none overflow-hidden">
                <span class="font-headline-xl oswald text-white/[0.04] uppercase leading-none text-[clamp(100px,16vw,220px)] tracking-tighter">
                    GALERI
                </span>
            </div>

            <div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-20 md:py-28
                        flex flex-col lg:flex-row lg:items-end gap-12 lg:gap-24">
                <div class="flex-1 anim-fade-up">
                    <p class="font-label-bold text-crimson-red uppercase tracking-widest text-xs mb-4">
                        Galeri Foto
                    </p>
                    <h1 class="font-headline-xl text-off-white uppercase leading-none mb-6 text-headline-xl-mobile md:text-headline-xl">
                        GALERI<br><span class="text-crimson-red">PERBASI MALUT</span>
                    </h1>
                    <div class="w-16 h-1 bg-crimson-red mb-6"></div>
                    <p class="font-body-lg text-surface-variant max-w-md leading-relaxed">
                        Kumpulan momen berharga, semangat kompetisi, dan dedikasi pengembangan basket di Maluku Utara.
                    </p>
                </div>

                <div class="flex lg:flex-col gap-8 lg:gap-6 anim-fade-up anim-delay-2">
                    <div class="border-l-2 border-crimson-red pl-6">
                        <span class="font-headline-xl oswald text-off-white leading-none block text-[clamp(40px,6vw,64px)]">
                            {{ $galleries->count() }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            Album
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Album Grid -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                @foreach ($galleries as $gallery)
                    <a href="{{ route('gallery.detail', $gallery->slug) }}"
                        class="album-card group relative bg-white overflow-hidden rounded-lg border border-charcoal/10 flex flex-col cursor-pointer">

                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img class="w-full h-full object-cover transition-transform duration-500"
                                src="{{ \App\Helpers\Media::url($gallery->cover_image ?? $gallery->image) }}"
                                alt="{{ $gallery->name }}" />
                            <div class="album-overlay absolute inset-0 bg-charcoal/50 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-5xl">visibility</span>
                            </div>
                            @if ($gallery->category)
                                <div class="absolute top-3 left-3 bg-crimson-red text-white font-label-bold text-[10px] px-2.5 py-1 rounded uppercase tracking-wider">
                                    {{ $gallery->category }}
                                </div>
                            @endif
                            @if (isset($gallery->images_count))
                                <div class="absolute bottom-3 right-3 bg-charcoal/70 text-white font-label-bold text-[10px] px-2.5 py-1 rounded flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[13px]">photo_library</span>
                                    {{ $gallery->images_count }} Foto
                                </div>
                            @endif
                        </div>

                        <div class="p-4 flex-1 flex flex-col border-b-4 border-crimson-red">
                            <h3 class="font-headline-md text-charcoal group-hover:text-crimson-red transition-colors uppercase leading-snug">
                                {{ $gallery->name }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

    </main>
@endsection
