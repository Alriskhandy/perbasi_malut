@extends('themes.perbasi.layouts.main')

@section('title', 'DPD - ' . $site_name->value)

@push('styles')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #130e24 0%, #251640 40%, #130e24 100%);
        }
        .hero-dot-grid {
            background-image: radial-gradient(circle, rgba(139,92,246,0.2) 1.5px, transparent 1.5px);
            background-size: 28px 28px;
        }
        .dpd-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dpd-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(19, 14, 36, 0.18);
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
        <div class="hero-bg border-b-4 border-crimson-red overflow-hidden relative">
            <div class="hero-dot-grid absolute inset-0 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 hidden md:flex items-center pr-margin-desktop select-none pointer-events-none overflow-hidden">
                <span class="font-headline-xl oswald text-white/[0.04] uppercase leading-none text-[clamp(100px,16vw,220px)] tracking-tighter">
                    DPD
                </span>
            </div>

            <div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-14 md:py-20 lg:py-28
                        flex flex-col lg:flex-row lg:items-end gap-8 lg:gap-24">
                <div class="flex-1 anim-fade-up">
                    <p class="font-label-bold text-crimson-red uppercase tracking-widest text-xs mb-4">
                        Resources &rarr; DPD
                    </p>
                    <h1 class="font-headline-xl text-off-white uppercase leading-none mb-6 text-headline-xl-mobile md:text-headline-xl">
                        PERBASI<br><span class="text-crimson-red">DPD KAB/KOTA</span>
                    </h1>
                    <div class="w-16 h-1 bg-crimson-red mb-6"></div>
                    <p class="font-body-lg text-surface-variant max-w-md leading-relaxed">
                        Daftar Pengurus Daerah (DPD) PERBASI tingkat Kabupaten / Kota di wilayah Maluku Utara.
                    </p>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-1 gap-4 sm:gap-6 lg:gap-6 anim-fade-up anim-delay-2">
                    <div class="border-l-2 border-crimson-red pl-4 md:pl-6">
                        <span class="font-headline-xl oswald text-off-white leading-none block text-[clamp(32px,5vw,56px)]">
                            {{ $districts->count() }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            DPD Aktif
                        </p>
                    </div>
                    <div class="border-l-2 border-amber-gold pl-4 md:pl-6">
                        <span class="font-headline-xl oswald text-amber-gold leading-none block text-[clamp(32px,5vw,56px)]">
                            {{ $districts->sum('teams_count') }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            Total Klub
                        </p>
                    </div>
                    <div class="border-l-2 border-[#3b82f6] pl-4 md:pl-6">
                        <span class="font-headline-xl oswald text-[#3b82f6] leading-none block text-[clamp(32px,5vw,56px)]">
                            {{ $districts->sum('players_count') }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            Total Atlet
                        </p>
                    </div>
                    <div class="border-l-2 border-[#10b981] pl-4 md:pl-6">
                        <span class="font-headline-xl oswald text-[#10b981] leading-none block text-[clamp(32px,5vw,56px)]">
                            {{ $districts->sum('coaches_count') }}
                        </span>
                        <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">
                            Total Pelatih
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white border-b border-outline-variant sticky top-20 z-30 shadow-sm">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-3 md:py-4">
                <form method="GET" action="{{ route('dpd.index') }}"
                    class="flex flex-wrap gap-2 md:gap-3 items-stretch sm:items-center">

                    <div class="relative flex-1 min-w-[180px]">
                        <span class="material-symbols-outlined absolute left-2.5 md:left-3 top-1/2 -translate-y-1/2 text-secondary text-[16px] md:text-[18px]">search</span>
                        <input type="search" name="search"
                            value="{{ e(old('search', $search)) }}"
                            maxlength="100" autocomplete="off"
                            class="w-full pl-9 pr-3 py-2 md:py-2.5 border border-outline-variant rounded focus:border-crimson-red focus:ring-1 focus:ring-crimson-red/20 font-body-md text-xs md:text-sm bg-transparent outline-none transition"
                            placeholder="Cari nama DPD..." />
                    </div>

                    <button type="submit"
                        class="bg-charcoal text-off-white font-label-bold px-4 md:px-6 py-2 md:py-2.5 rounded hover:bg-crimson-red transition-colors flex items-center justify-center gap-2 text-xs md:text-sm">
                        <span class="material-symbols-outlined text-[14px] md:text-[16px]">search</span>
                        CARI
                    </button>

                    @if ($search)
                        <a href="{{ route('dpd.index') }}"
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

            @if ($search)
                <div class="flex items-center gap-2 mb-8 text-sm text-secondary font-body-md">
                    <span class="material-symbols-outlined text-[16px]">filter_list</span>
                    Menampilkan <strong class="text-charcoal">{{ $districts->count() }}</strong> hasil
                    untuk "<strong class="text-charcoal">{{ e($search) }}</strong>"
                </div>
            @endif

            @if ($districts->isEmpty())
                <div class="text-center py-32">
                    <span class="material-symbols-outlined text-7xl text-outline-variant block mb-4">search_off</span>
                    <p class="font-headline-md text-charcoal text-xl mb-2">Tidak ada DPD ditemukan</p>
                    <p class="font-body-md text-secondary mb-6">Coba ubah kata kunci pencarian.</p>
                    <a href="{{ route('dpd.index') }}"
                        class="inline-flex items-center gap-2 bg-charcoal text-off-white font-label-bold px-6 py-3 rounded hover:bg-crimson-red transition-colors">
                        <span class="material-symbols-outlined text-[16px]">refresh</span>
                        Reset Pencarian
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($districts as $district)
                        <a href="{{ route('dpd.detail', $district->slug) }}"
                            class="dpd-card group bg-white border border-charcoal/10 rounded-lg overflow-hidden flex flex-col">

                            <!-- Header with logo -->
                            <div class="relative bg-gradient-to-br from-charcoal to-[#2a1f3a] p-6 flex items-center gap-4">
                                <div class="w-14 h-14 rounded-full bg-white/10 border border-white/20 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if ($district->img_path)
                                        <img src="{{ \App\Helpers\Media::url($district->img_path) }}"
                                            class="w-full h-full object-cover"
                                            alt="{{ $district->name }}" />
                                    @else
                                        <span class="material-symbols-outlined text-2xl text-white/40">shield</span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-label-bold text-off-white text-sm leading-snug line-clamp-2 group-hover:text-crimson-red transition-colors">
                                        {{ $district->name }}
                                    </h3>
                                    @if ($district->district_name)
                                        <p class="text-surface-variant text-[10px] mt-0.5 truncate">{{ $district->district_name }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Info body -->
                            <div class="p-4 flex-1 flex flex-col gap-3 border-t border-outline-variant/50">

                                @if ($district->pic)
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-[15px] text-secondary mt-0.5 flex-shrink-0">person</span>
                                        <div class="min-w-0">
                                            <p class="font-label-bold text-charcoal text-xs truncate">{{ $district->pic }}</p>
                                            @if ($district->pic_position)
                                                <p class="text-secondary text-[10px] truncate">{{ $district->pic_position }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if ($district->contact)
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[15px] text-secondary flex-shrink-0">phone</span>
                                        <p class="font-body-md text-charcoal text-xs truncate">{{ $district->contact }}</p>
                                    </div>
                                @endif

                                <!-- Stats -->
                                <div class="mt-auto pt-3 border-t border-outline-variant/40 grid grid-cols-4 gap-2">
                                    <div class="text-center">
                                        <span class="font-headline-md oswald text-crimson-red text-xl leading-none block">
                                            {{ $district->teams_count }}
                                        </span>
                                        <p class="font-label-bold text-[8px] text-secondary uppercase tracking-wider mt-0.5">Klub</p>
                                    </div>
                                    <div class="text-center">
                                        <span class="font-headline-md oswald text-[#3b82f6] text-xl leading-none block">
                                            {{ $district->players_count }}
                                        </span>
                                        <p class="font-label-bold text-[8px] text-secondary uppercase tracking-wider mt-0.5">Atlet</p>
                                    </div>
                                    <div class="text-center">
                                        <span class="font-headline-md oswald text-[#10b981] text-xl leading-none block">
                                            {{ $district->coaches_count }}
                                        </span>
                                        <p class="font-label-bold text-[8px] text-secondary uppercase tracking-wider mt-0.5">Pelatih</p>
                                    </div>
                                    <div class="text-center">
                                        <span class="font-headline-md oswald text-amber-gold text-xl leading-none block">
                                            {{ $district->referees_count }}
                                        </span>
                                        <p class="font-label-bold text-[8px] text-secondary uppercase tracking-wider mt-0.5">Wasit</p>
                                    </div>
                                </div>
                            </div>

                            <div class="h-0.5 w-0 bg-crimson-red group-hover:w-full transition-all duration-300"></div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </main>
@endsection
