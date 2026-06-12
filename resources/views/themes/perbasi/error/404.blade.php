@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #0d0a14 0%, #1a0f2e 50%, #0d0a14 100%);
        }
        .hero-pattern {
            background-image: radial-gradient(circle, rgba(169,35,51,0.12) 1.5px, transparent 1.5px);
            background-size: 32px 32px;
        }
        .outline-text {
            -webkit-text-stroke: 2px rgba(169,35,51,0.6);
            color: transparent;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33%       { transform: translateY(-12px) rotate(6deg); }
            66%       { transform: translateY(-6px) rotate(-4deg); }
        }
        .anim-float { animation: float 4s ease-in-out infinite; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-fade-up   { animation: fadeUp 0.6s ease both; }
        .anim-delay-1   { animation-delay: 0.15s; }
        .anim-delay-2   { animation-delay: 0.3s; }
        .anim-delay-3   { animation-delay: 0.45s; }
    </style>
@endpush

@section('main')
    <main class="mt-20 hero-bg min-h-[calc(100vh-80px)] relative overflow-hidden flex items-center">

        <!-- Dot pattern -->
        <div class="hero-pattern absolute inset-0 pointer-events-none"></div>

        <!-- Decorative basketball -->
        <div class="absolute bottom-10 left-8 hidden lg:block opacity-10 anim-float select-none pointer-events-none">
            <span class="material-symbols-outlined text-off-white" style="font-size: 160px;">sports_basketball</span>
        </div>
        <div class="absolute top-16 right-10 hidden xl:block opacity-5 select-none pointer-events-none" style="transform: rotate(20deg);">
            <span class="material-symbols-outlined text-off-white" style="font-size: 220px;">sports_basketball</span>
        </div>

        <!-- Content -->
        <div class="relative z-10 w-full px-margin-mobile md:px-margin-desktop py-16 flex flex-col items-center text-center">

            <!-- 404 number -->
            <div class="anim-fade-up">
                <span class="font-headline-xl oswald outline-text leading-none select-none block"
                      style="font-size: clamp(140px, 28vw, 320px); letter-spacing: -0.04em; line-height: 0.9;">
                    404
                </span>
            </div>

            <!-- Label -->
            <p class="font-label-bold text-crimson-red uppercase tracking-[0.2em] mt-4 mb-3 anim-fade-up anim-delay-1"
               style="font-size: clamp(11px, 1.8vw, 16px);">
                Air Ball! &mdash; Halaman Tidak Ditemukan
            </p>

            <!-- Divider -->
            <div class="w-12 h-0.5 bg-crimson-red mb-5 anim-fade-up anim-delay-1"></div>

            <!-- Message -->
            <p class="text-surface-variant leading-relaxed mb-8 anim-fade-up anim-delay-2"
               style="font-size: clamp(12px, 1.4vw, 14px); max-width: 320px;">
                Sepertinya tembakan kamu meleset jauh dari ring. Halaman ini tidak ditemukan.
            </p>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-3 anim-fade-up anim-delay-3">
                <a href="/"
                   class="inline-flex items-center justify-center gap-2 bg-crimson-red text-off-white font-label-bold px-6 py-2.5 rounded hover:bg-[#8a1d29] transition-colors uppercase tracking-wider text-xs">
                    <span class="material-symbols-outlined text-[15px]">home</span>
                    Kembali ke Beranda
                </a>
                <button onclick="history.back()"
                        class="inline-flex items-center justify-center gap-2 border border-off-white/20 text-off-white font-label-bold px-6 py-2.5 rounded hover:bg-white/10 transition-colors uppercase tracking-wider text-xs">
                    <span class="material-symbols-outlined text-[15px]">arrow_back</span>
                    Halaman Sebelumnya
                </button>
            </div>
        </div>

    </main>
@endsection
