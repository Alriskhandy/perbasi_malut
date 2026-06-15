@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #1A1D20 0%, #2e1a1e 50%, #1A1D20 100%);
        }
        .hero-dot-grid {
            background-image: radial-gradient(circle, rgba(169,35,51,0.18) 1px, transparent 1px);
            background-size: 28px 28px;
        }
        .person-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .person-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(26, 29, 32, 0.12);
        }

        /* Logo animations */
        @keyframes logoDrop {
            0%   { opacity: 0; transform: scale(0.7) translateY(-20px); }
            70%  { transform: scale(1.06) translateY(4px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        @keyframes ringPulse {
            0%   { transform: scale(1);    opacity: 0.6; }
            50%  { transform: scale(1.18); opacity: 0; }
            100% { transform: scale(1);    opacity: 0; }
        }
        @keyframes borderSpin {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .logo-enter { animation: logoDrop 0.7s cubic-bezier(0.34,1.56,0.64,1) both; }
        .ring-pulse {
            animation: ringPulse 2.4s ease-out 0.8s infinite;
        }
        .border-spin {
            animation: borderSpin 8s linear infinite;
        }
        .anim-fade-up  { animation: fadeUp 0.6s ease both; }
        .anim-delay-1  { animation-delay: 0.15s; }
        .anim-delay-2  { animation-delay: 0.3s; }
        .anim-delay-3  { animation-delay: 0.45s; }
    </style>
@endpush

@section('main')
    <main class="mt-20">

        <!-- Page Hero -->
        <div class="hero-bg border-b-4 border-crimson-red overflow-hidden relative">
            <!-- Dot grid overlay -->
            <div class="hero-dot-grid absolute inset-0 pointer-events-none"></div>
            <!-- Decorative ghost name -->
            <div class="absolute right-0 bottom-0 flex items-end pr-margin-desktop pb-4 select-none pointer-events-none overflow-hidden">
                <span class="font-headline-xl oswald text-white/[0.035] uppercase leading-none text-[clamp(80px,12vw,180px)] tracking-tighter">
                    {{ Str::upper(Str::words($team->name, 1, '')) }}
                </span>
            </div>

            <div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-10 pb-16 md:pb-24">
                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 font-label-bold text-xs uppercase tracking-widest mb-10 anim-fade-up">
                    <a href="{{ route('clubs.index') }}" class="text-surface-variant hover:text-crimson-red transition-colors">
                        Klub
                    </a>
                    <span class="material-symbols-outlined text-[14px] text-surface-variant/50">chevron_right</span>
                    <span class="text-crimson-red truncate max-w-xs">{{ $team->name }}</span>
                </nav>

                <div class="flex flex-col md:flex-row items-center md:items-end gap-10 md:gap-14">

                    <!-- Logo dengan animasi -->
                    <div class="relative flex-shrink-0 anim-fade-up">
                        <!-- Pulsing rings -->
                        <div class="ring-pulse absolute inset-0 rounded-full border-2 border-crimson-red/50 -m-4"></div>
                        <div class="ring-pulse absolute inset-0 rounded-full border border-crimson-red/30 -m-8" style="animation-delay:0.8s"></div>
                        <!-- Spinning dashed border -->
                        <div class="border-spin absolute -inset-2 rounded-full border-2 border-dashed border-crimson-red/25"></div>
                        <!-- Logo box -->
                        <div class="relative w-40 h-40 md:w-56 md:h-56 bg-white border-4 border-crimson-red
                                    flex items-center justify-center rounded-full overflow-hidden shadow-2xl logo-enter">
                            @if ($team->img_path)
                                <img src="{{ \App\Helpers\Media::url($team->img_path) }}"
                                    alt="Logo {{ $team->name }}"
                                    class="w-4/5 h-4/5 object-contain" />
                            @else
                                <span class="material-symbols-outlined text-8xl text-charcoal/20">shield</span>
                            @endif
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 text-center md:text-left">
                        <p class="font-label-bold text-crimson-red uppercase tracking-widest text-xs mb-3 anim-fade-up anim-delay-1">
                            {{ $team->district->name ?? 'Maluku Utara' }}, Maluku Utara
                        </p>
                        <h1 class="font-headline-xl text-off-white uppercase leading-none mb-5 text-headline-xl-mobile md:text-headline-xl anim-fade-up anim-delay-1">
                            {{ $team->name }}
                        </h1>
                        <div class="w-12 h-0.5 bg-crimson-red mb-5 mx-auto md:mx-0 anim-fade-up anim-delay-1"></div>

                        <!-- Contact chips -->
                        @if ($team->address || $team->email || $team->contact)
                            <div class="flex flex-wrap justify-center md:justify-start gap-x-6 gap-y-2 mb-8 anim-fade-up anim-delay-2">
                                @if ($team->address)
                                    <span class="flex items-center gap-1.5 text-surface-variant font-body-md text-sm">
                                        <span class="material-symbols-outlined text-[15px] text-crimson-red">location_on</span>
                                        {{ $team->address }}
                                    </span>
                                @endif
                                @if ($team->email)
                                    <span class="flex items-center gap-1.5 text-surface-variant font-body-md text-sm">
                                        <span class="material-symbols-outlined text-[15px] text-crimson-red">mail</span>
                                        {{ $team->email }}
                                    </span>
                                @endif
                                @if ($team->contact)
                                    <span class="flex items-center gap-1.5 text-surface-variant font-body-md text-sm">
                                        <span class="material-symbols-outlined text-[15px] text-crimson-red">call</span>
                                        {{ $team->contact }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        <!-- Stats strip -->
                        <div class="flex justify-center md:justify-start gap-8 anim-fade-up anim-delay-3">
                            <div class="border-l-2 border-crimson-red pl-4">
                                <span class="font-headline-md oswald text-off-white leading-none block text-4xl">
                                    {{ str_pad($activeCoaches->count(), 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <p class="font-label-bold text-[10px] text-surface-variant uppercase tracking-widest mt-1">Pelatih</p>
                            </div>
                            <div class="border-l-2 border-off-white/20 pl-4">
                                <span class="font-headline-md oswald text-off-white leading-none block text-4xl">
                                    {{ str_pad($activePlayers->count(), 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <p class="font-label-bold text-[10px] text-surface-variant uppercase tracking-widest mt-1">Atlet Aktif</p>
                            </div>
                            <div class="border-l-2 border-amber-gold pl-4">
                                <span class="font-headline-md oswald text-amber-gold leading-none block text-4xl">
                                    {{ str_pad($officials->count(), 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <p class="font-label-bold text-[10px] text-surface-variant uppercase tracking-widest mt-1">Official</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-padding space-y-16">

            {{-- ── PELATIH ────────────────────────────────────────────── --}}
            <section>
                <div class="flex justify-between items-end mb-stack-md">
                    <h2 class="font-headline-md text-headline-md oswald uppercase border-l-8 border-crimson-red pl-6">
                        Pelatih
                    </h2>
                    <span class="text-secondary font-label-bold text-sm">{{ $activeCoaches->count() }} pelatih aktif</span>
                </div>

                @if ($activeCoaches->isEmpty())
                    <div class="bg-white border border-charcoal/10 p-8 text-center text-secondary font-body-md">
                        Belum ada data pelatih.
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
                        @foreach ($activeCoaches as $coach)
                            <div class="person-card group bg-white border border-charcoal/10 rounded-lg overflow-hidden">
                                <div class="relative aspect-[3/4] bg-surface-container-low overflow-hidden flex items-center justify-center">
                                    @if ($coach->img_path)
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            src="{{ \App\Helpers\Media::url($coach->img_path) }}"
                                            alt="{{ $coach->name }}" />
                                    @else
                                        <span class="material-symbols-outlined text-6xl text-charcoal/15">person</span>
                                    @endif
                                </div>
                                <div class="p-4 border-t border-outline-variant/50 border-b-4 border-b-crimson-red">
                                    <p class="font-label-bold text-charcoal text-sm truncate">{{ $coach->name }}</p>
                                    <p class="text-[11px] font-body-md text-secondary uppercase tracking-wider mt-0.5">Pelatih</p>
                                    @if ($coach->contact)
                                        <p class="text-[11px] text-secondary/70 mt-1 truncate">{{ $coach->contact }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            {{-- ── ATLET ──────────────────────────────────────────────── --}}
            <section>
                <div class="flex justify-between items-end mb-stack-md">
                    <h2 class="font-headline-md text-headline-md oswald uppercase border-l-8 border-crimson-red pl-6">
                        Daftar Atlet
                    </h2>
                    <span class="text-secondary font-label-bold text-sm">{{ $activePlayers->count() }} atlet aktif</span>
                </div>

                @if ($activePlayers->isEmpty())
                    <div class="bg-white border border-charcoal/10 p-8 text-center text-secondary font-body-md">
                        Belum ada data atlet.
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
                        @foreach ($activePlayers as $player)
                            <a href="{{ route('athletes.detail', \App\Helpers\Hashid::encode($player->id)) }}"
                                class="person-card group bg-white border border-charcoal/10 rounded-lg overflow-hidden">
                                <div class="relative aspect-[3/4] bg-surface-container-low overflow-hidden flex items-center justify-center">
                                    @if ($player->img_path)
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            src="{{ \App\Helpers\Media::url($player->img_path) }}"
                                            alt="{{ $player->name }}" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-6xl text-charcoal/15">person</span>
                                        </div>
                                    @endif
                                    <!-- Gender badge -->
                                    <div class="absolute top-2 right-2 bg-charcoal/80 text-off-white font-label-bold text-[10px] px-2 py-0.5 rounded uppercase">
                                        {{ $player->gender === 'L' ? 'Putra' : 'Putri' }}
                                    </div>
                                </div>
                                <div class="p-4 border-t border-outline-variant/50 border-b-4 border-b-crimson-red">
                                    <p class="font-label-bold text-charcoal text-sm truncate group-hover:text-crimson-red transition-colors">{{ $player->name }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

            {{-- ── OFFICIAL ───────────────────────────────────────────── --}}
            @if ($officials->isNotEmpty())
                <section>
                    <div class="flex justify-between items-end mb-stack-md">
                        <h2 class="font-headline-md text-headline-md oswald uppercase border-l-8 border-crimson-red pl-6">
                            Official
                        </h2>
                        <span class="text-secondary font-label-bold text-sm">{{ $officials->count() }} official</span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
                        @foreach ($officials as $official)
                            <div class="person-card group bg-white border border-charcoal/10 rounded-lg overflow-hidden">
                                <div class="relative aspect-[3/4] bg-surface-container-low overflow-hidden flex items-center justify-center">
                                    @if ($official->img_path)
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            src="{{ \App\Helpers\Media::url($official->img_path) }}"
                                            alt="{{ $official->name }}" />
                                    @else
                                        <span class="material-symbols-outlined text-6xl text-charcoal/15">person</span>
                                    @endif
                                </div>
                                <div class="p-4 border-t border-outline-variant/50 border-b-4 border-b-amber-gold">
                                    <p class="font-label-bold text-charcoal text-sm truncate">{{ $official->name }}</p>
                                    <p class="text-[11px] font-body-md text-secondary uppercase tracking-wider mt-0.5">Official</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </main>
@endsection
