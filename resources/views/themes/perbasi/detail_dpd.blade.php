@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #130e24 0%, #251640 40%, #130e24 100%);
        }
        .hero-dot-grid {
            background-image: radial-gradient(circle, rgba(139,92,246,0.18) 1.5px, transparent 1.5px);
            background-size: 28px 28px;
        }
        .club-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .club-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(19,14,36,0.15);
        }
        .club-card:hover .club-logo {
            transform: scale(1.05);
        }
        .club-logo { transition: transform 0.4s ease; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes logoDrop {
            from { opacity: 0; transform: scale(0.85) translateY(-16px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }
        .anim-fade-up  { animation: fadeUp 0.6s ease both; }
        .anim-logo     { animation: logoDrop 0.7s cubic-bezier(.22,1,.36,1) both; }
        .anim-delay-1  { animation-delay: 0.1s; }
        .anim-delay-2  { animation-delay: 0.22s; }
        .anim-delay-3  { animation-delay: 0.36s; }
    </style>
@endpush

@section('main')
    <main class="mt-20">

        <!-- Hero -->
        <div class="hero-bg border-b-4 border-crimson-red overflow-hidden relative">
            <div class="hero-dot-grid absolute inset-0 pointer-events-none"></div>

            <div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16 md:py-24">

                <!-- Breadcrumb -->
                <p class="font-label-bold text-crimson-red uppercase tracking-widest text-xs mb-8 anim-fade-up">
                    <a href="{{ route('dpd.index') }}" class="hover:text-off-white transition-colors">Resources &rarr; DPD</a>
                    <span class="text-surface-variant mx-1">/</span>
                    <span class="text-surface-variant">{{ $district->name }}</span>
                </p>

                <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-start">

                    <!-- Logo -->
                    <div class="flex-shrink-0 anim-logo">
                        <div class="w-28 h-28 md:w-36 md:h-36 rounded-full bg-white/10 border-2 border-crimson-red/40 flex items-center justify-center overflow-hidden shadow-lg">
                            @if ($district->img_path)
                                <img src="{{ \App\Helpers\Media::url($district->img_path) }}"
                                    class="w-full h-full object-cover"
                                    alt="{{ $district->name }}" />
                            @else
                                <span class="material-symbols-outlined text-5xl text-white/30">shield</span>
                            @endif
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <h1 class="font-headline-xl text-off-white uppercase leading-none mb-2 text-headline-xl-mobile md:text-headline-xl anim-fade-up anim-delay-1">
                            {{ $district->name }}
                        </h1>
                        @if ($district->district_name)
                            <p class="font-body-lg text-surface-variant mb-4 anim-fade-up anim-delay-1">{{ $district->district_name }}</p>
                        @endif
                        <div class="w-12 h-0.5 bg-crimson-red mb-6 anim-fade-up anim-delay-2"></div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 anim-fade-up anim-delay-2">
                            @if ($district->pic)
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-crimson-red text-[18px] mt-0.5 flex-shrink-0">person</span>
                                    <div>
                                        <p class="font-label-bold text-off-white text-sm">{{ $district->pic }}</p>
                                        @if ($district->pic_position)
                                            <p class="text-surface-variant text-xs mt-0.5">{{ $district->pic_position }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if ($district->contact)
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-amber-gold text-[18px] flex-shrink-0">phone</span>
                                    <p class="font-body-md text-off-white text-sm">{{ $district->contact }}</p>
                                </div>
                            @endif
                            @if ($district->email)
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-amber-gold text-[18px] flex-shrink-0">mail</span>
                                    <p class="font-body-md text-surface-variant text-sm truncate">{{ $district->email }}</p>
                                </div>
                            @endif
                            @if ($district->web_url)
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-amber-gold text-[18px] flex-shrink-0">language</span>
                                    <a href="{{ $district->web_url }}" target="_blank" rel="noopener"
                                        class="font-body-md text-surface-variant hover:text-amber-gold text-sm truncate transition-colors">
                                        {{ $district->web_url }}
                                    </a>
                                </div>
                            @endif
                            @if ($district->address)
                                <div class="flex items-start gap-3 sm:col-span-2">
                                    <span class="material-symbols-outlined text-surface-variant text-[18px] mt-0.5 flex-shrink-0">location_on</span>
                                    <p class="font-body-md text-surface-variant text-sm">{{ $district->address }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 lg:grid-cols-1 gap-5 flex-shrink-0 anim-fade-up anim-delay-3">
                        <div class="border-l-2 border-crimson-red pl-5">
                            <span class="font-headline-xl oswald text-off-white leading-none block text-[clamp(28px,4vw,48px)]">
                                {{ $district->teams_count }}
                            </span>
                            <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">Klub</p>
                        </div>
                        <div class="border-l-2 border-[#3b82f6] pl-5">
                            <span class="font-headline-xl oswald text-[#3b82f6] leading-none block text-[clamp(28px,4vw,48px)]">
                                {{ $district->players_count }}
                            </span>
                            <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">Atlet</p>
                        </div>
                        <div class="border-l-2 border-[#10b981] pl-5">
                            <span class="font-headline-xl oswald text-[#10b981] leading-none block text-[clamp(28px,4vw,48px)]">
                                {{ $district->coaches_count }}
                            </span>
                            <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">Pelatih</p>
                        </div>
                        <div class="border-l-2 border-amber-gold pl-5">
                            <span class="font-headline-xl oswald text-amber-gold leading-none block text-[clamp(28px,4vw,48px)]">
                                {{ $district->referees_count }}
                            </span>
                            <p class="font-label-bold text-xs text-surface-variant uppercase tracking-widest mt-1">Wasit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clubs Section -->
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">

            <div class="flex items-center gap-4 mb-8">
                <div class="w-1 h-8 bg-amber-gold flex-shrink-0"></div>
                <h2 class="font-headline-md text-charcoal uppercase tracking-wide text-xl">
                    Klub di {{ $district->name }}
                </h2>
                <span class="ml-auto font-label-bold text-xs text-secondary uppercase tracking-widest bg-surface-container-high px-3 py-1 rounded-full">
                    {{ $teams->count() }} klub
                </span>
            </div>

            @if ($teams->isEmpty())
                <div class="text-center py-24 border border-dashed border-outline-variant rounded-lg">
                    <span class="material-symbols-outlined text-6xl text-outline-variant block mb-3">shield</span>
                    <p class="font-headline-md text-charcoal text-lg mb-1">Belum ada klub terdaftar</p>
                    <p class="font-body-md text-secondary text-sm">Klub aktif di DPD ini belum tersedia.</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
                    @foreach ($teams as $team)
                        <a href="{{ route('clubs.detail', $team->slug) }}"
                            class="club-card group bg-white border border-charcoal/10 rounded-lg overflow-hidden flex flex-col">

                            <div class="relative aspect-square bg-surface-container-low overflow-hidden flex items-center justify-center p-4">
                                @if ($team->img_path)
                                    <img class="club-logo w-full h-full object-contain"
                                        src="{{ \App\Helpers\Media::url($team->img_path) }}"
                                        alt="Logo {{ $team->name }}" />
                                @else
                                    <span class="material-symbols-outlined text-5xl text-charcoal/15">shield</span>
                                @endif
                            </div>

                            <div class="p-3 flex-1 flex flex-col border-t border-outline-variant/50">
                                <h4 class="font-label-bold text-charcoal text-sm leading-snug group-hover:text-amber-gold transition-colors line-clamp-2">
                                    {{ $team->name }}
                                </h4>
                                @if ($team->players_count > 0)
                                    <p class="text-secondary font-label-bold text-[10px] uppercase tracking-wider mt-1">
                                        {{ $team->players_count }} atlet aktif
                                    </p>
                                @endif
                            </div>

                            <div class="h-0.5 w-0 bg-amber-gold group-hover:w-full transition-all duration-300"></div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </main>
@endsection
