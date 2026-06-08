@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #0c1524 0%, #112040 40%, #0c1524 100%);
        }
        .hero-dot-grid {
            background-image:
                linear-gradient(rgba(100,149,237,0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(100,149,237,0.07) 1px, transparent 1px);
            background-size: 36px 36px;
        }
        .athlete-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .athlete-card:hover {
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
    <main class="mt-20">

        <!-- Page Hero -->
        <div class="hero-bg border-b-4 border-crimson-red overflow-hidden relative">
            <div class="hero-dot-grid absolute inset-0 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 flex items-center pr-margin-desktop select-none pointer-events-none overflow-hidden">
                <span class="font-headline-xl oswald text-white/[0.04] uppercase leading-none text-[clamp(120px,18vw,240px)] tracking-tighter">
                    ATLET
                </span>
            </div>

            <div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-20 md:py-28
                        flex flex-col lg:flex-row lg:items-end gap-12 lg:gap-24">
                <div class="flex-1 anim-fade-up">
                    <p class="font-label-bold text-crimson-red uppercase tracking-widest text-xs mb-4">
                        Resources &rarr; Atlet
                    </p>
                    <h1 class="font-headline-xl text-off-white uppercase leading-none mb-6 text-headline-xl-mobile md:text-headline-xl">
                        DAFTAR<br><span class="text-crimson-red">ATLET</span>
                    </h1>
                    <div class="w-16 h-1 bg-crimson-red mb-6"></div>
                    <p class="font-body-lg text-surface-variant max-w-md leading-relaxed">
                        Daftar atlet bola basket aktif yang terdaftar di bawah naungan PERBASI Maluku Utara.
                    </p>
                </div>

                <div class="flex lg:flex-col gap-8 lg:gap-6 anim-fade-up anim-delay-2">
                    <div class="border-l-2 border-crimson-red pl-6">
                        <span class="font-headline-xl oswald text-off-white leading-none block text-[clamp(40px,6vw,64px)]">
                            {{ $players->total() }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            Atlet Aktif
                        </p>
                    </div>
                    <div class="border-l-2 border-amber-gold pl-6">
                        <span class="font-headline-xl oswald text-amber-gold leading-none block text-[clamp(40px,6vw,64px)]">
                            {{ $teams->count() }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            Klub
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white border-b border-outline-variant sticky top-20 z-30 shadow-sm">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-4">
                <form method="GET" action="{{ route('athletes.index') }}"
                    class="flex flex-wrap gap-3 items-stretch sm:items-center">

                    <div class="relative flex-1 min-w-[180px]">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary text-[18px]">search</span>
                        <input type="search" name="search"
                            value="{{ e(old('search', $search)) }}"
                            maxlength="100" autocomplete="off"
                            class="w-full pl-10 pr-4 py-2.5 border border-outline-variant rounded focus:border-crimson-red focus:ring-1 focus:ring-crimson-red/20 font-body-md text-sm bg-transparent outline-none transition"
                            placeholder="Cari nama atlet..." />
                    </div>

                    <select name="district_id"
                        class="w-full sm:w-44 px-4 py-2.5 border border-outline-variant rounded focus:border-crimson-red focus:ring-1 focus:ring-crimson-red/20 font-body-md text-sm bg-white appearance-none outline-none transition">
                        <option value="">Semua Kab/Kota</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ $districtId == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="team_id"
                        class="w-full sm:w-48 px-4 py-2.5 border border-outline-variant rounded focus:border-crimson-red focus:ring-1 focus:ring-crimson-red/20 font-body-md text-sm bg-white appearance-none outline-none transition">
                        <option value="">Semua Klub</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" {{ $teamId == $team->id ? 'selected' : '' }}>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="gender"
                        class="w-full sm:w-36 px-4 py-2.5 border border-outline-variant rounded focus:border-crimson-red focus:ring-1 focus:ring-crimson-red/20 font-body-md text-sm bg-white appearance-none outline-none transition">
                        <option value="">Semua Gender</option>
                        <option value="L" {{ $gender === 'L' ? 'selected' : '' }}>Putra (L)</option>
                        <option value="P" {{ $gender === 'P' ? 'selected' : '' }}>Putri (P)</option>
                    </select>

                    <button type="submit"
                        class="bg-charcoal text-off-white font-label-bold px-6 py-2.5 rounded hover:bg-crimson-red transition-colors flex items-center justify-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-[16px]">tune</span>
                        FILTER
                    </button>

                    @if ($search || $teamId || $districtId || $gender)
                        <a href="{{ route('athletes.index') }}"
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

            @if ($search || $teamId || $districtId || $gender)
                <div class="flex items-center gap-2 mb-6 text-sm text-secondary font-body-md">
                    <span class="material-symbols-outlined text-[16px]">filter_list</span>
                    Menampilkan <strong class="text-charcoal">{{ $players->total() }}</strong> hasil
                    @if ($search)
                        untuk "<strong class="text-charcoal">{{ e($search) }}</strong>"
                    @endif
                    @if ($districtId && $districts->firstWhere('id', $districtId))
                        &bull; DPD <strong class="text-charcoal">{{ $districts->firstWhere('id', $districtId)->name }}</strong>
                    @endif
                    @if ($teamId && $teams->firstWhere('id', $teamId))
                        dari klub <strong class="text-charcoal">{{ $teams->firstWhere('id', $teamId)->name }}</strong>
                    @endif
                    @if ($gender)
                        &bull; <strong class="text-charcoal">{{ $gender === 'L' ? 'Putra' : 'Putri' }}</strong>
                    @endif
                </div>
            @endif

            @if ($players->isEmpty())
                <div class="text-center py-32">
                    <span class="material-symbols-outlined text-7xl text-outline-variant block mb-4">search_off</span>
                    <p class="font-headline-md text-charcoal text-xl mb-2">Tidak ada atlet ditemukan</p>
                    <p class="font-body-md text-secondary mb-6">Coba ubah kata kunci atau filter.</p>
                    <a href="{{ route('athletes.index') }}"
                        class="inline-flex items-center gap-2 bg-charcoal text-off-white font-label-bold px-6 py-3 rounded hover:bg-crimson-red transition-colors">
                        <span class="material-symbols-outlined text-[16px]">refresh</span>
                        Reset Filter
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
                    @foreach ($players as $player)
                        <a href="{{ route('athletes.detail', \App\Helpers\Hashid::encode($player->id)) }}"
                            class="athlete-card group bg-white border border-charcoal/10 rounded-lg overflow-hidden flex flex-col">

                            <div class="relative aspect-[3/4] bg-surface-container-low overflow-hidden flex items-center justify-center">
                                @if ($player->img_path)
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        src="{{ asset($player->img_path) }}"
                                        alt="{{ $player->name }}" />
                                @else
                                    <span class="material-symbols-outlined text-6xl text-charcoal/15">person</span>
                                @endif
                                <div class="absolute top-2 right-2 bg-charcoal/80 text-off-white font-label-bold text-[10px] px-2 py-0.5 rounded uppercase">
                                    {{ $player->gender === 'L' ? 'Putra' : 'Putri' }}
                                </div>
                            </div>

                            <div class="p-3 flex-1 flex flex-col border-t border-outline-variant/50">
                                @if ($player->team?->district)
                                    <p class="text-amber-gold font-label-bold text-[9px] uppercase tracking-wider mb-0.5 truncate">
                                        DPD {{ $player->team->district->name }}
                                    </p>
                                @endif
                                <p class="text-crimson-red font-label-bold text-[10px] uppercase tracking-wider mb-1 truncate">
                                    {{ $player->team->name ?? '-' }}
                                </p>
                                <h4 class="font-label-bold text-charcoal text-sm leading-snug group-hover:text-crimson-red transition-colors line-clamp-2">
                                    {{ $player->name }}
                                </h4>
                            </div>

                            <div class="h-0.5 w-0 bg-crimson-red group-hover:w-full transition-all duration-300"></div>
                        </a>
                    @endforeach
                </div>

                @if ($players->hasPages())
                    <div class="mt-16 flex justify-center">
                        <nav class="flex items-center gap-1.5">
                            @if ($players->onFirstPage())
                                <span class="w-9 h-9 flex items-center justify-center border border-outline-variant text-secondary/40 rounded cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                                </span>
                            @else
                                <a href="{{ $players->previousPageUrl() }}"
                                    class="w-9 h-9 flex items-center justify-center border border-outline-variant text-secondary rounded hover:bg-surface-variant transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                                </a>
                            @endif

                            @foreach ($players->getUrlRange(max(1, $players->currentPage() - 2), min($players->lastPage(), $players->currentPage() + 2)) as $page => $url)
                                @if ($page == $players->currentPage())
                                    <span class="w-9 h-9 flex items-center justify-center bg-crimson-red text-white font-bold rounded text-sm">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}"
                                        class="w-9 h-9 flex items-center justify-center border border-outline-variant text-charcoal font-bold rounded hover:bg-surface-variant transition-colors text-sm">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            @if ($players->hasMorePages())
                                <a href="{{ $players->nextPageUrl() }}"
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
