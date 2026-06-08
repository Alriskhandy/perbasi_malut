@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #1A1D20 0%, #1a1e2e 50%, #1A1D20 100%);
        }
        .hero-dot-grid {
            background-image: radial-gradient(circle, rgba(169,35,51,0.18) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* Photo entrance */
        @keyframes photoReveal {
            0%   { opacity: 0; transform: scale(0.9) translateY(20px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        /* Corner line draw-in */
        @keyframes cornerH {
            from { width: 0; }
            to   { width: 2rem; }
        }
        @keyframes cornerV {
            from { height: 0; }
            to   { height: 2rem; }
        }
        /* Scan line sweeps once — more visible */
        @keyframes scanLine {
            0%   { top: -6px; opacity: 0; }
            4%   { opacity: 1; }
            88%  { opacity: 0.75; }
            100% { top: 106%; opacity: 0; }
        }
        /* Glow pulse on photo */
        @keyframes photoGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(169,35,51,0); }
            50%       { box-shadow: 0 0 28px 6px rgba(169,35,51,0.3); }
        }
        /* Badge slide-up */
        @keyframes badgeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        /* General fade-up */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        /* Name underline draw */
        @keyframes lineGrow {
            from { width: 0; }
            to   { width: 3rem; }
        }

        /* Running border traces — each spark loops with 1s stagger */
        @keyframes runTop    { from { transform: translateX(-110%); } to { transform: translateX(210%); } }
        @keyframes runRight  { from { transform: translateY(-110%); } to { transform: translateY(210%); } }
        @keyframes runBottom { from { transform: translateX(210%);  } to { transform: translateX(-110%); } }
        @keyframes runLeft   { from { transform: translateY(210%);  } to { transform: translateY(-110%); } }

        .photo-reveal  { animation: photoReveal 0.7s cubic-bezier(0.34,1.2,0.64,1) both; }
        .photo-glow    { animation: photoGlow 3s ease-in-out 1s infinite; }
        .corner-top-h  { animation: cornerH 0.4s ease 0.7s both; }
        .corner-top-v  { animation: cornerV 0.4s ease 0.7s both; }
        .corner-bot-h  { animation: cornerH 0.4s ease 0.85s both; }
        .corner-bot-v  { animation: cornerV 0.4s ease 0.85s both; }
        .scan-line     { animation: scanLine 1.5s ease-out 0.6s both; }
        .badge-in      { animation: badgeIn 0.4s ease 1.1s both; }
        .line-grow     { animation: lineGrow 0.5s ease 0.4s both; }
        .anim-fade-up  { animation: fadeUp 0.6s ease both; }
        .anim-delay-1  { animation-delay: 0.15s; }
        .anim-delay-2  { animation-delay: 0.28s; }
        .anim-delay-3  { animation-delay: 0.42s; }
        .anim-delay-4  { animation-delay: 0.56s; }

        /* Border trace spark styles */
        .border-run-t { animation: runTop    4s linear 0s   infinite; }
        .border-run-r { animation: runRight  4s linear 1s   infinite; }
        .border-run-b { animation: runBottom 4s linear 2s   infinite; }
        .border-run-l { animation: runLeft   4s linear 3s   infinite; }

        .scan-line {
            height: 3px;
            background: linear-gradient(90deg,
                transparent 0%,
                rgba(169,35,51,0.15) 15%,
                rgba(169,35,51,0.95) 50%,
                rgba(169,35,51,0.15) 85%,
                transparent 100%
            );
            box-shadow: 0 0 10px 3px rgba(169,35,51,0.55);
        }
    </style>
@endpush

@section('main')
    <main class="mt-20">

        <!-- Page Hero -->
        <div class="hero-bg border-b-4 border-crimson-red overflow-hidden relative">
            <div class="hero-dot-grid absolute inset-0 pointer-events-none"></div>
            <!-- Ghost name decoration -->
            <div class="absolute right-0 bottom-0 flex items-end pr-margin-desktop pb-2 select-none pointer-events-none overflow-hidden">
                <span class="font-headline-xl oswald text-white/[0.03] uppercase leading-none text-[clamp(80px,14vw,200px)] tracking-tighter">
                    {{ Str::upper(Str::words($player->name, 1, '')) }}
                </span>
            </div>

            <div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-10 pb-16 md:pb-24">
                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 font-label-bold text-xs uppercase tracking-widest mb-10 anim-fade-up">
                    <a href="{{ route('athletes.index') }}" class="text-surface-variant hover:text-crimson-red transition-colors">
                        Atlet
                    </a>
                    <span class="material-symbols-outlined text-[14px] text-surface-variant/50">chevron_right</span>
                    @if ($player->team)
                        <a href="{{ route('clubs.detail', $player->team->slug) }}"
                            class="text-surface-variant hover:text-crimson-red transition-colors truncate max-w-[120px]">
                            {{ $player->team->name }}
                        </a>
                        <span class="material-symbols-outlined text-[14px] text-surface-variant/50">chevron_right</span>
                    @endif
                    <span class="text-crimson-red truncate max-w-xs">{{ $player->name }}</span>
                </nav>

                <div class="flex flex-col md:flex-row items-center md:items-end gap-10 md:gap-14">

                    <!-- Foto Atlet -->
                    <div class="relative flex-shrink-0 photo-reveal">
                        <!-- Corner accents: animated draw-in -->
                        <div class="absolute -top-2 -left-2 overflow-hidden" style="width:2rem;height:2rem">
                            <div class="absolute top-0 left-0 h-1 bg-crimson-red corner-top-h"></div>
                            <div class="absolute top-0 left-0 w-1 bg-crimson-red corner-top-v"></div>
                        </div>
                        <div class="absolute -bottom-2 -right-2 overflow-hidden" style="width:2rem;height:2rem">
                            <div class="absolute bottom-0 right-0 h-1 bg-crimson-red corner-bot-h"></div>
                            <div class="absolute bottom-0 right-0 w-1 bg-crimson-red corner-bot-v"></div>
                        </div>

                        <!-- Photo with border trace + glow -->
                        <div class="relative w-48 h-64 md:w-56 md:h-72">

                            <!-- Running border traces — 4 edges -->
                            <div class="absolute top-0 left-0 right-0 h-px overflow-hidden z-10 pointer-events-none">
                                <div class="border-run-t absolute h-px w-3/5 bg-gradient-to-r from-transparent via-crimson-red to-transparent"></div>
                            </div>
                            <div class="absolute top-0 right-0 bottom-0 w-px overflow-hidden z-10 pointer-events-none">
                                <div class="border-run-r absolute w-px h-3/5 bg-gradient-to-b from-transparent via-crimson-red to-transparent"></div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 h-px overflow-hidden z-10 pointer-events-none">
                                <div class="border-run-b absolute h-px w-3/5 bg-gradient-to-r from-transparent via-crimson-red to-transparent"></div>
                            </div>
                            <div class="absolute top-0 left-0 bottom-0 w-px overflow-hidden z-10 pointer-events-none">
                                <div class="border-run-l absolute w-px h-3/5 bg-gradient-to-b from-transparent via-crimson-red to-transparent"></div>
                            </div>

                            <!-- Photo -->
                            <div class="photo-glow overflow-hidden w-full h-full border border-crimson-red/20 relative">
                                @if ($player->img_path)
                                    <img src="{{ asset($player->img_path) }}"
                                        alt="{{ $player->name }}"
                                        class="w-full h-full object-cover" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-surface-container-low">
                                        <span class="material-symbols-outlined text-8xl text-charcoal/15">person</span>
                                    </div>
                                @endif
                                <!-- Scan line overlay -->
                                <div class="scan-line absolute left-0 right-0 pointer-events-none"></div>
                            </div>
                        </div>

                        <!-- Gender badge -->
                        <div class="badge-in absolute bottom-3 left-3 bg-crimson-red text-off-white font-label-bold text-xs px-3 py-1 uppercase tracking-widest">
                            {{ $player->gender === 'L' ? 'Putra' : 'Putri' }}
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 text-center md:text-left">
                        @if ($player->team)
                            <a href="{{ route('clubs.detail', $player->team->slug) }}"
                                class="inline-flex items-center gap-1.5 font-label-bold text-crimson-red uppercase tracking-widest text-xs mb-3 hover:underline anim-fade-up anim-delay-1">
                                <span class="material-symbols-outlined text-[14px]">groups</span>
                                {{ $player->team->name }}
                                @if ($player->team->district)
                                    &bull; {{ $player->team->district->name }}
                                @endif
                            </a>
                        @endif

                        <h1 class="font-headline-xl text-off-white uppercase leading-none mb-4 text-headline-xl-mobile md:text-headline-xl anim-fade-up anim-delay-2">
                            {{ $player->name }}
                        </h1>
                        <div class="h-0.5 bg-crimson-red mb-6 mx-auto md:mx-0 line-grow" style="width:0"></div>

                        @if ($player->position)
                            <p class="font-label-bold text-amber-gold uppercase tracking-widest text-sm mb-6 anim-fade-up anim-delay-3">
                                {{ $player->position }}
                            </p>
                        @endif

                        <!-- Stats strip -->
                        <div class="flex justify-center md:justify-start gap-8 anim-fade-up anim-delay-4">
                            @if ($player->height)
                                <div class="border-l-2 border-crimson-red pl-4">
                                    <span class="font-headline-md oswald text-off-white leading-none block text-4xl">
                                        {{ $player->height }}
                                    </span>
                                    <p class="font-label-bold text-[10px] text-surface-variant uppercase tracking-widest mt-1">cm</p>
                                </div>
                            @endif
                            @if ($player->weight)
                                <div class="border-l-2 border-off-white/20 pl-4">
                                    <span class="font-headline-md oswald text-off-white leading-none block text-4xl">
                                        {{ $player->weight }}
                                    </span>
                                    <p class="font-label-bold text-[10px] text-surface-variant uppercase tracking-widest mt-1">kg</p>
                                </div>
                            @endif
                            <div class="border-l-2 border-amber-gold pl-4">
                                <span class="font-headline-md oswald text-amber-gold leading-none block text-4xl uppercase">
                                    {{ $player->gender }}
                                </span>
                                <p class="font-label-bold text-[10px] text-surface-variant uppercase tracking-widest mt-1">
                                    {{ $player->gender === 'L' ? 'Putra' : 'Putri' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail + Related Athletes -->
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-padding">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">

                <!-- Profil Atlet -->
                <div class="w-full lg:max-w-xl flex-shrink-0">
                    <h2 class="font-headline-md text-headline-md oswald uppercase border-l-8 border-crimson-red pl-6 mb-stack-md">
                        Profil Atlet
                    </h2>
                    <div class="bg-white border border-charcoal/10 divide-y divide-outline-variant/50"
                        style="box-shadow: 4px 4px 0 0 rgba(26,29,32,0.08)">

                        <div class="flex items-center px-6 py-4">
                            <span class="w-36 font-label-bold text-secondary text-xs uppercase tracking-wider shrink-0">Nama Lengkap</span>
                            <span class="font-body-md text-charcoal">{{ $player->name }}</span>
                        </div>

                        @if ($player->position)
                            <div class="flex items-center px-6 py-4">
                                <span class="w-36 font-label-bold text-secondary text-xs uppercase tracking-wider shrink-0">Posisi</span>
                                <span class="font-body-md text-charcoal">{{ $player->position }}</span>
                            </div>
                        @endif

                        <div class="flex items-center px-6 py-4">
                            <span class="w-36 font-label-bold text-secondary text-xs uppercase tracking-wider shrink-0">Gender</span>
                            <span class="font-body-md text-charcoal">
                                {{ $player->gender === 'L' ? 'Laki-laki (Putra)' : 'Perempuan (Putri)' }}
                            </span>
                        </div>

                        @if ($player->height)
                            <div class="flex items-center px-6 py-4">
                                <span class="w-36 font-label-bold text-secondary text-xs uppercase tracking-wider shrink-0">Tinggi Badan</span>
                                <span class="font-body-md text-charcoal">{{ $player->height }} cm</span>
                            </div>
                        @endif

                        @if ($player->weight)
                            <div class="flex items-center px-6 py-4">
                                <span class="w-36 font-label-bold text-secondary text-xs uppercase tracking-wider shrink-0">Berat Badan</span>
                                <span class="font-body-md text-charcoal">{{ $player->weight }} kg</span>
                            </div>
                        @endif

                        @if ($player->team)
                            <div class="flex items-center px-6 py-4">
                                <span class="w-36 font-label-bold text-secondary text-xs uppercase tracking-wider shrink-0">Klub</span>
                                <a href="{{ route('clubs.detail', $player->team->slug) }}"
                                    class="font-body-md text-crimson-red hover:underline flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px]">groups</span>
                                    {{ $player->team->name }}
                                </a>
                            </div>
                            @if ($player->team->district)
                                <div class="flex items-center px-6 py-4">
                                    <span class="w-36 font-label-bold text-secondary text-xs uppercase tracking-wider shrink-0">DPD PERBASI</span>
                                    <span class="font-body-md text-charcoal">{{ $player->team->district->name }}, Maluku Utara</span>
                                </div>
                            @endif
                        @endif
                    </div>

                    <!-- Back link -->
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('athletes.index') }}"
                            class="inline-flex items-center gap-2 border border-charcoal text-charcoal font-label-bold px-5 py-2.5 rounded hover:bg-charcoal hover:text-off-white transition-colors text-sm">
                            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                            Semua Atlet
                        </a>
                        @if ($player->team)
                            <a href="{{ route('clubs.detail', $player->team->slug) }}"
                                class="inline-flex items-center gap-2 bg-crimson-red text-off-white font-label-bold px-5 py-2.5 rounded hover:bg-primary-container transition-colors text-sm">
                                <span class="material-symbols-outlined text-[16px]">groups</span>
                                Lihat Profil Klub
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Atlet Lainnya (1 Klub) --}}
                @if ($relatedPlayers->isNotEmpty())
                    <div class="flex-1 min-w-0">
                        <div class="flex items-end justify-between mb-stack-md">
                            <h2 class="font-headline-md text-headline-md oswald uppercase border-l-8 border-crimson-red pl-6">
                                Atlet Lainnya
                            </h2>
                            @if ($player->team)
                                <a href="{{ route('clubs.detail', $player->team->slug) }}"
                                    class="font-label-bold text-xs text-crimson-red hover:underline uppercase tracking-widest flex items-center gap-0.5 shrink-0">
                                    Lihat Semua
                                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                                </a>
                            @endif
                        </div>
                        @if ($player->team)
                            <p class="font-label-bold text-[10px] text-secondary uppercase tracking-widest mb-5 pl-0">
                                {{ $player->team->name }}
                            </p>
                        @endif

                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                            @foreach ($relatedPlayers as $related)
                                <a href="{{ route('athletes.detail', \App\Helpers\Hashid::encode($related->id)) }}"
                                    class="group bg-white border border-charcoal/10 rounded-lg overflow-hidden flex flex-col
                                           transition-transform duration-300 hover:-translate-y-1 hover:shadow-lg">
                                    <div class="relative aspect-[3/4] bg-surface-container-low overflow-hidden flex items-center justify-center">
                                        @if ($related->img_path)
                                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                                src="{{ asset($related->img_path) }}"
                                                alt="{{ $related->name }}" />
                                        @else
                                            <span class="material-symbols-outlined text-5xl text-charcoal/15">person</span>
                                        @endif
                                        <div class="absolute top-2 right-2 bg-charcoal/75 text-off-white font-label-bold text-[9px] px-1.5 py-0.5 rounded uppercase">
                                            {{ $related->gender === 'L' ? 'Putra' : 'Putri' }}
                                        </div>
                                    </div>
                                    <div class="p-3 border-t border-outline-variant/50 border-b-4 border-b-crimson-red">
                                        <p class="font-label-bold text-charcoal text-xs leading-snug group-hover:text-crimson-red transition-colors line-clamp-2">
                                            {{ $related->name }}
                                        </p>
                                        @if ($related->position)
                                            <p class="text-[10px] text-secondary mt-0.5 uppercase tracking-wider truncate">{{ $related->position }}</p>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </main>
@endsection
