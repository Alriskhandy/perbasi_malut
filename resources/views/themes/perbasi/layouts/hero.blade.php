<!-- Hero Section -->
<section class="relative min-h-screen w-full flex items-center bg-charcoal overflow-hidden py-stack-lg">
    <!-- Background Overlay -->
    <div class="absolute inset-0 z-0">
        <img alt="Epic Basketball Background" class="w-full h-full object-cover opacity-30"
            src="{{ isset($heroBg) ? $heroBg : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBjoRgi5IvT2t4k9Zx2kdkbtsE81A5QjiQZPOe-J-trEPK_kmS8B--xTsY-zBBfIDQEePfzSdzT950N5GaCjdHguY_HYObyTXud0RuW3dL9aSeem2ZQKwa0TBLUoWlHwV-eSPPtxDnRSyXrX_k65OUnnkvj36K8WWEU_rTu0XC_cE7D7VvWKGv5gD-hJF3ruWE-j1PHVsXqdRa8zdLYYii9wTd_pkCxlRk71nSthW5tYWZNuAKVG5LbmncT1ElahiQYzwMvuTJDQNa4' }}" />
        <div class="absolute inset-0 bg-gradient-to-r from-charcoal via-charcoal/80 to-transparent"></div>
    </div>

    <div class="relative z-10 w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <!-- Left Side: Content & Stats -->
        <div class="flex flex-col items-center justify-center text-center">
            {{-- <h1 class="font-headline-xl text-headline-xl-mobile md:text-headline-xl text-off-white uppercase leading-[1] mb-6 text-shadow-hero">
                Malut bisa,<br /><span class="text-crimson-red">Malut juara</span>
            </h1> --}}
            <img src="{{ asset('backend/assets/img/tag-malut bisa.png') }}" alt="Tag Malut Bisa, Malut Juara" class="mx-auto lg:mx-0 mb-6 w-64 md:w-80" />
            <p class="font-body-lg text-body-lg text-off-white/80 max-w-xl mx-auto lg:mx-0 mb-10">
                Menjadikan olahraga bola basket di Maluku Utara sebagai sarana pembinaan generasi muda yang berkarakter, berprestasi, dan mampu membawa nama baik daerah hingga ke kancah nasional maupun internasional.
            </p>
            <div class="flex flex-wrap justify-center lg:justify-start gap-4 mb-16">
                <a href="{{ route('allPosts') }}"
                    class="bg-crimson-red text-off-white px-8 py-4 rounded-DEFAULT font-label-bold text-label-bold hover:bg-primary-container transition-all flex items-center justify-center gap-2 uppercase">
                    LIHAT BERITA <span class="material-symbols-outlined">sports_basketball</span>
                </a>
                <a href="{{ isset($aboutPage) ? route('pages.show', $aboutPage->slug) : '#' }}"
                    class="bg-transparent border-2 border-off-white text-off-white px-8 py-4 rounded-DEFAULT font-label-bold text-label-bold hover:bg-off-white hover:text-charcoal transition-all uppercase">
                    Tentang Perbasi
                </a>
            </div>
            <!-- Stats Row -->
            <div class="grid grid-cols-4 gap-x-3 md:gap-x-6 gap-y-6 border-t border-white/10 pt-8">
                <div class="flex flex-col items-center lg:items-start gap-1">
                    <span class="font-headline-xl text-4xl md:text-5xl text-off-white leading-none">{{ $klubCount ?? 54 }}</span>
                    <span class="font-label-bold text-xs text-crimson-red uppercase tracking-widest mt-1">Klub</span>
                </div>
                <div class="flex flex-col items-center lg:items-start gap-1">
                    <span class="font-headline-xl text-4xl md:text-5xl text-off-white leading-none">{{ $pelatihCount ?? 85 }}</span>
                    <span class="font-label-bold text-xs text-crimson-red uppercase tracking-widest mt-1">Pelatih</span>
                </div>
                <div class="flex flex-col items-center lg:items-start gap-1">
                    <span class="font-headline-xl text-4xl md:text-5xl text-off-white leading-none">{{ $atletCount ?? 0 }}</span>
                    <span class="font-label-bold text-xs text-crimson-red uppercase tracking-widest mt-1">Pemain</span>
                </div>
                <div class="flex flex-col items-center lg:items-start gap-1">
                    <span class="font-headline-xl text-4xl md:text-5xl text-off-white leading-none">{{ $wasitCount ?? 42 }}</span>
                    <span class="font-label-bold text-xs text-crimson-red uppercase tracking-wider mt-1">Wasit</span>
                </div>
            </div>
        </div>

        <!-- Right Side: News Carousel -->
        <div class="relative hidden lg:block">
            @if (isset($banner) && $banner->count() > 0)
                @php $carouselCount = $banner->count(); @endphp

                <div id="hero-carousel">
                    <!-- Slides: stacked via absolute, fade dengan opacity -->
                    <div class="relative shadow-2xl" style="height: 460px;">
                        @foreach ($banner as $i => $carouselPost)
                            <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out bg-white p-2
                                        {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
                                data-index="{{ $i }}">
                                <!-- Image -->
                                <div class="relative overflow-hidden group" style="height: 270px;">
                                    <img alt="{{ $carouselPost->title }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                        src="{{ \App\Helpers\Media::url($carouselPost->image) }}" />
                                    @if ($carouselPost->category)
                                        <div class="absolute top-6 left-6 bg-crimson-red text-white text-[11px] font-bold px-4 py-1.5 uppercase tracking-widest shadow-lg">
                                            {{ strtoupper($carouselPost->category->name) }}
                                        </div>
                                    @endif
                                </div>
                                <!-- Content -->
                                <div class="p-6 bg-white border-x border-b border-surface-container" style="height: 182px;">
                                    <div class="flex items-center gap-2 text-secondary text-[12px] font-semibold mb-3">
                                        <span class="text-amber-gold uppercase tracking-tighter">HOT NEWS</span>
                                        <span class="w-8 h-[1px] bg-outline-variant"></span>
                                        <span>{{ $carouselPost->created_at->format('d M Y') }}</span>
                                    </div>
                                    <h3 class="font-headline-md text-charcoal leading-tight mb-4 hover:text-crimson-red transition-colors line-clamp-2">
                                        {{ Str::limit($carouselPost->title, 80) }}
                                    </h3>
                                    <a class="inline-flex items-center gap-2 text-crimson-red font-label-bold text-sm group"
                                        href="{{ route('posts.show', $carouselPost->slug) }}">
                                        BACA SELENGKAPNYA
                                        <span class="material-symbols-outlined text-sm transform transition-transform group-hover:translate-x-1">arrow_forward</span>
                                    </a>
                                </div>
                                <!-- Decorative Border -->
                                <div class="absolute -top-4 -right-4 w-24 h-24 border-t-4 border-r-4 border-crimson-red -z-10"></div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <div class="flex items-center justify-between mt-4 px-1">
                        <!-- Dots -->
                        <div class="flex gap-2" id="hero-dots">
                            @for ($d = 0; $d < $carouselCount; $d++)
                                <button
                                    class="hero-dot h-1 transition-all duration-300 {{ $d === 0 ? 'w-8 bg-crimson-red' : 'w-4 bg-white/40' }}"
                                    data-dot="{{ $d }}" aria-label="Slide {{ $d + 1 }}"></button>
                            @endfor
                        </div>
                        <!-- Prev / Next -->
                        <div class="flex gap-2">
                            <button id="hero-prev"
                                class="w-9 h-9 flex items-center justify-center bg-white/10 hover:bg-crimson-red border border-white/20 text-off-white transition-colors">
                                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                            </button>
                            <button id="hero-next"
                                class="w-9 h-9 flex items-center justify-center bg-crimson-red hover:bg-white/10 border border-crimson-red text-off-white transition-colors">
                                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>

            @else
                <div class="bg-white p-2 shadow-2xl relative">
                    <div class="h-72 bg-charcoal/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-charcoal/30 text-9xl"
                            style="font-variation-settings: 'FILL' 1">sports_basketball</span>
                    </div>
                    <div class="p-6 bg-white border-x border-b border-surface-container">
                        <div class="text-amber-gold uppercase tracking-tighter text-[12px] font-semibold mb-3">
                            PERBASI MALUT</div>
                        <h3 class="font-headline-md text-charcoal leading-tight">
                            Membangun Masa Depan Basket Maluku Utara</h3>
                    </div>
                    <div class="absolute -top-4 -right-4 w-24 h-24 border-t-4 border-r-4 border-crimson-red -z-10"></div>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
(function () {
    const carousel = document.getElementById('hero-carousel');
    if (!carousel) return;

    const slides = carousel.querySelectorAll('.hero-slide');
    const dots = carousel.querySelectorAll('.hero-dot');
    const total = slides.length;
    let current = 0;
    let timer;
    let transitioning = false;

    function goTo(index) {
        if (transitioning || index === current) return;
        transitioning = true;

        // Sembunyikan slide aktif
        slides[current].classList.remove('opacity-100', 'z-10');
        slides[current].classList.add('opacity-0', 'z-0');
        dots[current].classList.remove('w-8', 'bg-crimson-red');
        dots[current].classList.add('w-4', 'bg-white/40');

        current = (index + total) % total;

        // Tampilkan slide berikutnya
        slides[current].classList.remove('opacity-0', 'z-0');
        slides[current].classList.add('opacity-100', 'z-10');
        dots[current].classList.remove('w-4', 'bg-white/40');
        dots[current].classList.add('w-8', 'bg-crimson-red');

        // Tunggu transisi selesai (700ms sesuai duration-700)
        setTimeout(() => { transitioning = false; }, 700);
    }

    function startTimer() {
        timer = setInterval(() => goTo(current + 1), 5000);
    }

    function resetTimer() {
        clearInterval(timer);
        startTimer();
    }

    document.getElementById('hero-next').addEventListener('click', () => { goTo(current + 1); resetTimer(); });
    document.getElementById('hero-prev').addEventListener('click', () => { goTo(current - 1); resetTimer(); });

    dots.forEach(dot => {
        dot.addEventListener('click', () => { goTo(parseInt(dot.dataset.dot)); resetTimer(); });
    });

    startTimer();
})();
</script>
