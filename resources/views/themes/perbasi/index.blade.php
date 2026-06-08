@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .text-shadow-hero {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .asymmetric-clip {
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }
    </style>
@endpush

@section('main')
    <main class="mt-20">
        @include('themes.perbasi.layouts.hero')

        <!-- News Slider Section -->
        <section class="py-section-padding px-margin-desktop max-w-container-max mx-auto">
            <div class="flex justify-between items-end mb-stack-lg">
                <div>
                    <h2
                        class="font-headline-lg text-headline-lg text-charcoal uppercase leading-tight tracking-tight">
                        Berita <span class="text-crimson-red">Terbaru</span></h2>
                    <div class="h-1 w-20 bg-crimson-red mt-2"></div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                @foreach ($posts->take(6) as $post)
                    <div
                        class="bg-white border border-charcoal/5 group flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="h-56 overflow-hidden relative">
                            <img alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                src="{{ $post->image }}" />
                            @if ($post->category)
                                <div
                                    class="absolute top-4 left-4 bg-crimson-red text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest">
                                    {{ $post->category->name }}</div>
                            @endif
                        </div>
                        <div class="p-stack-md flex-grow">
                            <div class="text-secondary text-[12px] mb-2 flex items-center gap-1"><span
                                    class="material-symbols-outlined text-sm">calendar_today</span>
                                {{ $post->created_at->format('d M Y') }}</div>
                            <h3
                                class="font-headline-md text-[22px] text-charcoal leading-tight mb-3 group-hover:text-crimson-red transition-colors">
                                {{ Str::limit($post->title, 70) }}</h3>
                            <p class="font-body-md text-body-md text-secondary line-clamp-3">
                                {{ Str::limit(strip_tags($post->content), 150) }}</p>
                        </div>
                        <div class="px-stack-md pb-stack-md">
                            <a class="text-charcoal font-label-bold text-sm flex items-center gap-2 group-hover:text-crimson-red"
                                href="{{ route('posts.show', $post->slug) }}">BACA SELENGKAPNYA <span
                                    class="material-symbols-outlined text-sm">arrow_forward</span></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end mt-stack-lg">
                <a href="{{ route('allPosts') }}"
                    class="text-crimson-red font-label-bold flex items-center gap-1 hover:underline uppercase">Lihat
                    Semua Berita <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
            </div>
        </section>

        <!-- Media Gallery Section -->
        <section class="py-section-padding bg-white">
            <div class="px-margin-desktop max-w-container-max mx-auto">
                <div class="flex justify-between items-end mb-stack-lg">
                    <div>
                        <h2
                            class="font-headline-lg text-headline-lg text-charcoal uppercase leading-tight tracking-tight">
                            Galeri <span class="text-crimson-red">Media</span></h2>
                        <p class="text-secondary font-body-md mt-2">Momen-momen terbaik dari setiap kompetisi.</p>
                    </div>
                    <a class="text-crimson-red font-label-bold flex items-center gap-1 hover:underline"
                        href="{{ route('galleries.front') }}">LIHAT SEMUA <span
                            class="material-symbols-outlined">arrow_forward</span></a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($galleries->take(5) as $index => $gallery)
                        @if ($index === 2)
                            <div class="aspect-square md:row-span-2 md:col-span-2 relative">
                                <div class="relative w-full h-full overflow-hidden group z-10">
                                    <img alt="{{ $gallery->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        src="{{ $gallery->cover_image ?? $gallery->image }}" />
                                </div>
                                <div class="absolute -bottom-3 -left-3 w-full h-full border-2 border-crimson-red z-0"></div>
                            </div>
                        @else
                            <div class="aspect-square overflow-hidden group">
                                <img alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    src="{{ $gallery->cover_image ?? $gallery->image }}" />
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1
            };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('section').forEach(section => {
                section.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
                observer.observe(section);
            });
        });
    </script>
@endpush
