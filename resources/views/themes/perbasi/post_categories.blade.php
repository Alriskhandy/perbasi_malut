@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .bento-grid-item {
            transition: transform 0.3s ease;
        }

        .bento-grid-item:hover {
            transform: translateY(-4px);
        }

        .text-stroke {
            -webkit-text-stroke: 1px rgba(169, 35, 51, 0.3);
            color: transparent;
        }
    </style>
@endpush

@section('main')
    <main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-padding mt-20">
        <!-- Page Header -->
        <div class="mb-section-padding border-l-8 border-crimson-red pl-gutter">
            <h1 class="font-headline-xl text-headline-xl uppercase mb-stack-sm tracking-tighter">
                @if (isset($category))
                    {{ $category->name }}
                @else
                    BERITA <span class="text-crimson-red">TERBARU</span>
                @endif
            </h1>
            <p class="font-body-lg text-body-lg text-secondary max-w-2xl">
                Tetap terhubung dengan perkembangan terbaru bola basket di Maluku Utara. Mulai dari hasil
                pertandingan, agenda organisasi, hingga prestasi atlet lokal.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <!-- Main Content Area -->
            <section class="lg:col-span-8 space-y-stack-lg">
                @if ($posts->count() > 0)
                    <!-- Featured News Item -->
                    @php $featured = $posts->first(); @endphp
                    <article
                        class="group bg-white border border-charcoal/10 overflow-hidden bento-grid-item shadow-sm">
                        <div class="relative h-[400px] overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                src="{{ $featured->image }}" alt="{{ $featured->title }}" />
                            @if ($featured->category)
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-crimson-red text-off-white font-label-bold text-label-bold px-4 py-1 uppercase">{{ $featured->category->name }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-stack-lg border-b-4 border-crimson-red">
                            <div
                                class="flex items-center gap-2 text-secondary font-label-bold text-label-bold mb-stack-sm">
                                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                <span>{{ strtoupper($featured->created_at->format('d F Y')) }}</span>
                            </div>
                            <h2
                                class="font-headline-lg text-headline-lg mb-stack-md leading-tight group-hover:text-crimson-red transition-colors">
                                {{ strtoupper($featured->title) }}</h2>
                            <p class="text-body-md text-secondary mb-stack-lg line-clamp-3">
                                {{ Str::limit(strip_tags($featured->content), 200) }}
                            </p>
                            <a class="inline-flex items-center gap-2 text-crimson-red font-label-bold text-label-bold hover:gap-4 transition-all"
                                href="{{ route('posts.show', $featured->slug) }}">
                                BACA SELENGKAPNYA <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </article>

                    <!-- News Grid -->
                    <div class="grid md:grid-cols-2 gap-gutter">
                        @foreach ($posts->skip(1) as $post)
                            <article
                                class="bg-white border border-charcoal/10 overflow-hidden bento-grid-item flex flex-col">
                                <div class="relative h-64 overflow-hidden">
                                    <img class="w-full h-full object-cover" src="{{ $post->image }}"
                                        alt="{{ $post->title }}" />
                                    @if ($post->category)
                                        <div class="absolute top-4 left-4">
                                            <span
                                                class="bg-charcoal text-off-white font-label-bold text-label-bold px-3 py-1 uppercase">{{ $post->category->name }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-stack-md flex-1 flex flex-col border-b-4 border-crimson-red">
                                    <span
                                        class="text-secondary text-sm font-label-bold mb-2">{{ strtoupper($post->created_at->format('d F Y')) }}</span>
                                    <h3 class="font-headline-md text-headline-md mb-stack-sm line-clamp-2">
                                        {{ $post->title }}</h3>
                                    <p class="text-body-md text-secondary mb-stack-md line-clamp-2">
                                        {{ Str::limit(strip_tags($post->content), 120) }}</p>
                                    <a class="mt-auto inline-flex items-center gap-1 text-crimson-red font-label-bold text-label-bold hover:underline"
                                        href="{{ route('posts.show', $post->slug) }}">
                                        BACA SELENGKAPNYA
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($posts->hasPages())
                        <div class="pt-stack-lg flex justify-center">
                            {{ $posts->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-white border border-charcoal/10 p-stack-lg text-center shadow-sm">
                        <span class="material-symbols-outlined text-secondary text-6xl mb-4">article</span>
                        <h3 class="font-headline-md text-headline-md text-charcoal mb-stack-md">Belum ada berita</h3>
                        <p class="font-body-md text-secondary">Belum ada berita yang dipublikasikan.</p>
                    </div>
                @endif
            </section>

            <!-- Sidebar -->
            @include('themes.perbasi.layouts.sidebar')
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.bento-grid-item').forEach(card => {
            card.addEventListener('mouseenter', () => {});
        });
    </script>
@endpush
