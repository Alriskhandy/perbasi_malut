@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #091a18 0%, #0e2c28 40%, #091a18 100%);
        }
        .hero-dot-grid {
            background-image: radial-gradient(circle, rgba(212,175,55,0.18) 1.5px, transparent 1.5px);
            background-size: 28px 28px;
        }
        .person-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .person-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(26, 29, 32, 0.15);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-fade-up  { animation: fadeUp 0.6s ease both; }
        .anim-delay-2  { animation-delay: 0.22s; }
    </style>
@endpush

@section('main')
    <main class="mt-16 md:mt-20">

        <!-- Hero -->
        <div class="hero-bg border-b-4 border-amber-gold overflow-hidden relative">
            <div class="hero-dot-grid absolute inset-0 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 hidden md:flex items-center pr-margin-desktop select-none pointer-events-none overflow-hidden">
                <span class="font-headline-xl oswald text-white/[0.04] uppercase leading-none text-[clamp(120px,18vw,240px)] tracking-tighter">
                    WASIT
                </span>
            </div>

            <div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-14 md:py-20 lg:py-28
                        flex flex-col lg:flex-row lg:items-end gap-8 lg:gap-24">
                <div class="flex-1 anim-fade-up">
                    <p class="font-label-bold text-amber-gold uppercase tracking-widest text-xs mb-4">
                        Resources &rarr; Wasit
                    </p>
                    <h1 class="font-headline-xl text-off-white uppercase leading-none mb-6 text-headline-xl-mobile md:text-headline-xl">
                        DAFTAR<br><span class="text-amber-gold">WASIT</span>
                    </h1>
                    <div class="w-16 h-1 bg-amber-gold mb-6"></div>
                    <p class="font-body-lg text-surface-variant max-w-md leading-relaxed">
                        Daftar wasit bola basket yang terdaftar di bawah naungan PERBASI Maluku Utara.
                    </p>
                </div>

                <div class="flex gap-6 sm:gap-8 lg:flex-col lg:gap-6 anim-fade-up anim-delay-2">
                    <div class="border-l-2 border-amber-gold pl-4 md:pl-6">
                        <span class="font-headline-xl oswald text-off-white leading-none block text-[clamp(32px,8vw,64px)]">
                            {{ $referees->total() }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            Wasit
                        </p>
                    </div>
                    <div class="border-l-2 border-amber-gold pl-4 md:pl-6">
                        <span class="font-headline-xl oswald text-amber-gold leading-none block text-[clamp(32px,8vw,64px)]">
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
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-3 md:py-4">
                <form method="GET" action="{{ route('referees.front') }}"
                    class="flex flex-wrap gap-2 md:gap-3 items-stretch sm:items-center">

                    <div class="relative flex-1 min-w-[180px]">
                        <span class="material-symbols-outlined absolute left-2.5 md:left-3 top-1/2 -translate-y-1/2 text-secondary text-[16px] md:text-[18px]">search</span>
                        <input type="search" name="search"
                            value="{{ e(old('search', $search)) }}"
                            maxlength="100" autocomplete="off"
                            class="w-full pl-9 pr-3 py-2 md:py-2.5 border border-outline-variant rounded focus:border-amber-gold focus:ring-1 focus:ring-amber-gold/20 font-body-md text-xs md:text-sm bg-transparent outline-none transition"
                            placeholder="Cari nama wasit..." />
                    </div>

                    <select name="district_id"
                        class="w-full sm:w-48 px-3 md:px-4 py-2 md:py-2.5 border border-outline-variant rounded focus:border-amber-gold focus:ring-1 focus:ring-amber-gold/20 font-body-md text-xs md:text-sm bg-white appearance-none outline-none transition">
                        <option value="">Semua Kab/Kota</option>
                        @foreach ($districts as $district)
                            <option value="{{ \App\Helpers\Hashid::encode($district->id) }}" {{ $districtHash === \App\Helpers\Hashid::encode($district->id) ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-charcoal text-off-white font-label-bold px-4 md:px-6 py-2 md:py-2.5 rounded hover:bg-amber-gold hover:text-charcoal transition-colors flex items-center justify-center gap-2 text-xs md:text-sm">
                        <span class="material-symbols-outlined text-[14px] md:text-[16px]">tune</span>
                        FILTER
                    </button>

                    @if ($search || $districtHash)
                        <a href="{{ route('referees.front') }}"
                            class="border border-outline-variant text-secondary font-label-bold px-4 py-2 md:py-2.5 rounded hover:bg-surface-variant transition-colors flex items-center justify-center gap-1 text-xs md:text-sm">
                            <span class="material-symbols-outlined text-[14px] md:text-[16px]">close</span>
                            RESET
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">

            @if ($search || $districtHash)
                <div class="flex items-center gap-2 mb-6 text-sm text-secondary font-body-md">
                    <span class="material-symbols-outlined text-[16px]">filter_list</span>
                    Menampilkan <strong class="text-charcoal">{{ $referees->total() }}</strong> hasil
                    @if ($search)
                        untuk "<strong class="text-charcoal">{{ e($search) }}</strong>"
                    @endif
                    @php
                        $selectedDistrict = $districtHash ? $districts->first(fn ($d) => \App\Helpers\Hashid::encode($d->id) === $districtHash) : null;
                    @endphp
                    @if ($selectedDistrict)
                        &bull; DPD <strong class="text-charcoal">{{ $selectedDistrict->name }}</strong>
                    @endif
                </div>
            @endif

            @if ($referees->isEmpty())
                <div class="text-center py-32">
                    <span class="material-symbols-outlined text-7xl text-outline-variant block mb-4">search_off</span>
                    <p class="font-headline-md text-charcoal text-xl mb-2">Tidak ada wasit ditemukan</p>
                    <p class="font-body-md text-secondary mb-6">Coba ubah kata kunci atau filter.</p>
                    <a href="{{ route('referees.front') }}"
                        class="inline-flex items-center gap-2 bg-charcoal text-off-white font-label-bold px-6 py-3 rounded hover:bg-amber-gold hover:text-charcoal transition-colors">
                        <span class="material-symbols-outlined text-[16px]">refresh</span>
                        Reset Filter
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
                    @foreach ($referees as $referee)
                        <div class="person-card group bg-white border border-charcoal/10 rounded-lg overflow-hidden flex flex-col">

                            <div class="relative aspect-[3/4] bg-surface-container-low overflow-hidden flex items-center justify-center">
                                @if ($referee->img_path)
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        src="{{ \App\Helpers\Media::url($referee->img_path) }}"
                                        alt="{{ $referee->name }}" />
                                @else
                                    <span class="material-symbols-outlined text-6xl text-charcoal/15">person</span>
                                @endif
                                <div class="absolute top-2 right-2 bg-charcoal/80 text-off-white font-label-bold text-[10px] px-2 py-0.5 rounded uppercase">
                                    Wasit
                                </div>
                            </div>

                            <div class="p-3 flex-1 flex flex-col border-t border-outline-variant/50">
                                @if ($referee->district)
                                    <p class="text-amber-gold font-label-bold text-[9px] uppercase tracking-wider mb-0.5 truncate">
                                        DPD {{ $referee->district->name }}
                                    </p>
                                @endif
                                <h4 class="font-label-bold text-charcoal text-sm leading-snug group-hover:text-amber-gold transition-colors line-clamp-2">
                                    {{ $referee->name }}
                                </h4>
                            </div>

                            <div class="h-0.5 w-0 bg-amber-gold group-hover:w-full transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>

                @if ($referees->hasPages())
                    <div class="mt-16 flex justify-center">
                        <nav class="flex items-center gap-1.5">
                            @if ($referees->onFirstPage())
                                <span class="w-9 h-9 flex items-center justify-center border border-outline-variant text-secondary/40 rounded cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                                </span>
                            @else
                                <a href="{{ $referees->previousPageUrl() }}"
                                    class="w-9 h-9 flex items-center justify-center border border-outline-variant text-secondary rounded hover:bg-surface-variant transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                                </a>
                            @endif

                            @foreach ($referees->getUrlRange(max(1, $referees->currentPage() - 2), min($referees->lastPage(), $referees->currentPage() + 2)) as $page => $url)
                                @if ($page == $referees->currentPage())
                                    <span class="w-9 h-9 flex items-center justify-center bg-amber-gold text-charcoal font-bold rounded text-sm">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}"
                                        class="w-9 h-9 flex items-center justify-center border border-outline-variant text-charcoal font-bold rounded hover:bg-surface-variant transition-colors text-sm">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            @if ($referees->hasMorePages())
                                <a href="{{ $referees->nextPageUrl() }}"
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
