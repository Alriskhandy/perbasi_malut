@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .club-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .club-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(26, 29, 32, 0.15);
        }
        .club-card:hover .club-logo {
            transform: scale(1.05);
            transition: transform 0.4s ease;
        }
        .club-logo {
            transition: transform 0.4s ease;
        }
        .hero-bg {
            background: linear-gradient(135deg, #0d1610 0%, #182a1a 40%, #0d1610 100%);
        }
        .hero-dot-grid {
            background-image:
                linear-gradient(rgba(212,175,55,0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212,175,55,0.08) 1px, transparent 1px),
                linear-gradient(rgba(212,175,55,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212,175,55,0.04) 1px, transparent 1px);
            background-size: 72px 72px, 72px 72px, 18px 18px, 18px 18px;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-fade-up   { animation: fadeUp 0.6s ease both; }
        .anim-delay-1   { animation-delay: 0.1s; }
        .anim-delay-2   { animation-delay: 0.22s; }
        .anim-delay-3   { animation-delay: 0.36s; }
    </style>
@endpush

@section('main')
    <main class="mt-20">

        <!-- Page Hero -->
        <div class="hero-bg border-b-4 border-amber-gold overflow-hidden relative">
            <!-- Dot grid overlay -->
            <div class="hero-dot-grid absolute inset-0 pointer-events-none"></div>
            <!-- Decorative large text -->
            <div class="absolute right-0 top-0 bottom-0 flex items-center pr-margin-desktop select-none pointer-events-none overflow-hidden">
                <span class="font-headline-xl oswald text-white/[0.04] uppercase leading-none text-[clamp(120px,18vw,240px)] tracking-tighter">
                    KLUB
                </span>
            </div>

            <div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-20 md:py-28
                        flex flex-col lg:flex-row lg:items-end gap-12 lg:gap-24">
                <!-- Left: Title block -->
                <div class="flex-1 anim-fade-up">
                    <p class="font-label-bold text-amber-gold uppercase tracking-widest text-xs mb-4">
                        Resources &rarr; Klub
                    </p>
                    <h1 class="font-headline-xl text-off-white uppercase leading-none mb-6 text-headline-xl-mobile md:text-headline-xl">
                        DAFTAR<br><span class="text-amber-gold">KLUB</span>
                    </h1>
                    <div class="w-16 h-1 bg-amber-gold mb-6"></div>
                    <p class="font-body-lg text-surface-variant max-w-md leading-relaxed">
                        Temukan informasi klub bola basket di Maluku Utara, termasuk profil klub, susunan atlet, pelatih dan official serta informasi kontak untuk mempermudah komunikasi dan kolaborasi.
                    </p>
                </div>

                <!-- Right: Stats block -->
                <div class="flex lg:flex-col gap-8 lg:gap-6 anim-fade-up anim-delay-2">
                    <div class="border-l-2 border-amber-gold pl-6">
                        <span class="font-headline-xl oswald text-off-white leading-none block text-[clamp(40px,6vw,64px)]">
                            {{ $teams->total() }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            Klub Aktif
                        </p>
                    </div>
                    <div class="border-l-2 border-off-white/20 pl-6">
                        <span class="font-headline-xl oswald text-off-white leading-none block text-[clamp(40px,6vw,64px)]">
                            {{ $districts->count() }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            Kab / Kota
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white border-b border-outline-variant sticky top-20 z-30 shadow-sm">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-4">
                <form method="GET" action="{{ route('clubs.index') }}"
                    class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">

                    <div class="relative flex-1">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary text-[18px]">search</span>
                        <input type="search" name="search"
                            value="{{ e(old('search', $search)) }}"
                            maxlength="100"
                            autocomplete="off"
                            class="w-full pl-10 pr-4 py-2.5 border border-outline-variant rounded focus:border-amber-gold focus:ring-1 focus:ring-amber-gold/20 font-body-md text-sm bg-transparent outline-none transition"
                            placeholder="Cari nama klub..." />
                    </div>

                    <select name="district_id"
                        class="sm:w-56 px-4 py-2.5 border border-outline-variant rounded focus:border-amber-gold focus:ring-1 focus:ring-amber-gold/20 font-body-md text-sm bg-white appearance-none outline-none transition">
                        <option value="">Semua Kab / Kota</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}"
                                {{ $districtId == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-charcoal text-off-white font-label-bold px-6 py-2.5 rounded hover:bg-amber-gold hover:text-charcoal transition-colors flex items-center justify-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-[16px]">tune</span>
                        FILTER
                    </button>

                    @if ($search || $districtId)
                        <a href="{{ route('clubs.index') }}"
                            class="border border-outline-variant text-secondary font-label-bold px-5 py-2.5 rounded hover:bg-surface-variant transition-colors flex items-center justify-center gap-1 text-sm">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                            RESET
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">

            <!-- Results info -->
            @if ($search || $districtId)
                <div class="flex items-center gap-2 mb-6 text-sm text-secondary font-body-md">
                    <span class="material-symbols-outlined text-[16px]">filter_list</span>
                    Menampilkan <strong class="text-charcoal">{{ $teams->total() }}</strong> hasil
                    @if ($search)
                        untuk "<strong class="text-charcoal">{{ e($search) }}</strong>"
                    @endif
                    @if ($districtId && $districts->firstWhere('id', $districtId))
                        di <strong class="text-charcoal">{{ $districts->firstWhere('id', $districtId)->name }}</strong>
                    @endif
                </div>
            @endif

            @if ($teams->isEmpty())
                <div class="text-center py-32">
                    <span class="material-symbols-outlined text-7xl text-outline-variant block mb-4">search_off</span>
                    <p class="font-headline-md text-charcoal text-xl mb-2">Tidak ada klub ditemukan</p>
                    <p class="font-body-md text-secondary mb-6">Coba ubah kata kunci atau filter.</p>
                    <a href="{{ route('clubs.index') }}" class="inline-flex items-center gap-2 bg-charcoal text-off-white font-label-bold px-6 py-3 rounded hover:bg-amber-gold hover:text-charcoal transition-colors">
                        <span class="material-symbols-outlined text-[16px]">refresh</span>
                        Reset Filter
                    </a>
                </div>
            @else
                <!-- Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
                    @foreach ($teams as $team)
                        <a href="{{ route('clubs.detail', $team->slug) }}"
                            class="club-card group bg-white border border-charcoal/10 rounded-lg overflow-hidden flex flex-col">

                            <!-- Logo 1:1 -->
                            <div class="relative aspect-square bg-surface-container-low overflow-hidden flex items-center justify-center p-4">
                                @if ($team->img_path)
                                    <img class="club-logo w-full h-full object-contain"
                                        src="{{ asset($team->img_path) }}"
                                        alt="Logo {{ $team->name }}" />
                                @else
                                    <span class="material-symbols-outlined text-6xl text-charcoal/15">shield</span>
                                @endif
                                <!-- District badge -->
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-charcoal/60 to-transparent px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <p class="text-off-white font-label-bold text-[10px] uppercase tracking-wider truncate">
                                        {{ $team->district->name ?? '' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="p-4 flex-1 flex flex-col border-t border-outline-variant/50">
                                <p class="text-amber-gold font-label-bold text-[10px] uppercase tracking-wider mb-1 truncate">
                                    {{ $team->district->name ?? '-' }}
                                </p>
                                <h4 class="font-label-bold text-charcoal text-sm leading-snug group-hover:text-amber-gold transition-colors line-clamp-2">
                                    {{ $team->name }}
                                </h4>
                            </div>

                            <!-- Bottom accent -->
                            <div class="h-0.5 w-0 bg-amber-gold group-hover:w-full transition-all duration-300"></div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($teams->hasPages())
                    <div class="mt-16 flex justify-center">
                        <nav class="flex items-center gap-1.5">
                            @if ($teams->onFirstPage())
                                <span class="w-9 h-9 flex items-center justify-center border border-outline-variant text-secondary/40 rounded cursor-not-allowed text-sm">
                                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                                </span>
                            @else
                                <a href="{{ $teams->previousPageUrl() }}"
                                    class="w-9 h-9 flex items-center justify-center border border-outline-variant text-secondary rounded hover:bg-surface-variant transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                                </a>
                            @endif

                            @foreach ($teams->getUrlRange(max(1, $teams->currentPage() - 2), min($teams->lastPage(), $teams->currentPage() + 2)) as $page => $url)
                                @if ($page == $teams->currentPage())
                                    <span class="w-9 h-9 flex items-center justify-center bg-amber-gold text-charcoal font-bold rounded text-sm">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="w-9 h-9 flex items-center justify-center border border-outline-variant text-charcoal font-bold rounded hover:bg-surface-variant transition-colors text-sm">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            @if ($teams->hasMorePages())
                                <a href="{{ $teams->nextPageUrl() }}"
                                    class="w-9 h-9 flex items-center justify-center border border-outline-variant text-secondary rounded hover:bg-surface-variant transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                                </a>
                            @else
                                <span class="w-9 h-9 flex items-center justify-center border border-outline-variant text-secondary/40 rounded cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                                </span>
                            @endif
                        </nav>
                    </div>
                @endif
            @endif
        </div>

    </main>
@endsection
