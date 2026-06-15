@extends('themes.perbasi.layouts.main')

@section('main')
    <main class="mt-16 md:mt-20">
        <!-- Page Header -->
        <section class="bg-charcoal py-stack-lg px-margin-mobile md:px-margin-desktop text-off-white border-b border-crimson-red/30">
            <div class="max-w-container-max mx-auto">
                <h1 class="font-headline-xl text-headline-xl-mobile md:text-headline-xl uppercase tracking-tighter mb-stack-sm">
                    HASIL <span class="text-crimson-red">PENCARIAN</span>
                </h1>
                <nav class="flex items-center gap-2 font-label-bold text-label-bold text-surface-variant text-sm">
                    <a href="/" class="hover:text-crimson-red transition-colors">Beranda</a>
                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                    <span class="text-crimson-red">Pencarian: "{{ $query }}"</span>
                </nav>
            </div>
        </section>

        <!-- Content -->
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-padding-mobile md:py-section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
                <!-- Main Content -->
                <section class="lg:col-span-8">
                    @if ($posts->count() > 0 || $pages->count() > 0)

                        @if ($posts->count() > 0)
                            <h2
                                class="font-headline-md text-2xl md:text-headline-md mb-gutter uppercase border-l-8 border-crimson-red pl-4">
                                Berita ({{ $posts->total() }})</h2>
                            @foreach ($posts as $post)
                                <article
                                    class="bg-white border border-charcoal/10 overflow-hidden mb-gutter flex gap-stack-md shadow-sm hover:shadow-md transition-shadow">
                                    @if ($post->image)
                                        <div class="w-28 h-28 sm:w-40 sm:h-32 flex-shrink-0 overflow-hidden">
                                            <a href="{{ route('posts.show', $post->slug) }}">
                                                <img src="{{ \App\Helpers\Media::url($post->image) }}" alt="{{ $post->title }}"
                                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
                                            </a>
                                        </div>
                                    @endif
                                    <div class="p-stack-md flex-grow">
                                        @if ($post->category)
                                            <span
                                                class="bg-crimson-red text-off-white text-[10px] font-bold px-2 py-1 uppercase mb-2 inline-block">{{ $post->category->name }}</span>
                                        @endif
                                        <h3 class="font-headline-md text-xl md:text-headline-md text-charcoal mb-stack-sm leading-tight">
                                            <a href="{{ route('posts.show', $post->slug) }}"
                                                class="hover:text-crimson-red transition-colors">{{ $post->title }}</a>
                                        </h3>
                                        <p class="font-body-md text-secondary text-body-sm md:text-body-md line-clamp-2">
                                            {{ Str::limit(strip_tags($post->content), 150) }}</p>
                                        <div
                                            class="mt-2 flex items-center gap-1 text-secondary text-xs font-label-bold">
                                            <span class="material-symbols-outlined text-xs">calendar_today</span>
                                            {{ $post->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                            <div class="mb-gutter">
                                {{ $posts->appends(['q' => $query])->links() }}
                            </div>
                        @endif

                        @if ($pages->count() > 0)
                            <h2
                                class="font-headline-md text-2xl md:text-headline-md mb-gutter uppercase border-l-8 border-crimson-red pl-4 mt-section-padding">
                                Halaman ({{ $pages->total() }})</h2>
                            @foreach ($pages as $page)
                                <article
                                    class="bg-white border border-charcoal/10 overflow-hidden mb-gutter p-stack-md shadow-sm hover:shadow-md transition-shadow border-l-4 border-crimson-red">
                                    <h3 class="font-headline-md text-xl md:text-headline-md text-charcoal mb-stack-sm">
                                        <a href="{{ route('pages.show', $page->slug) }}"
                                            class="hover:text-crimson-red transition-colors">{{ $page->title }}</a>
                                    </h3>
                                    <p class="font-body-md text-secondary">
                                        {{ Str::limit(strip_tags($page->content), 200) }}</p>
                                </article>
                            @endforeach
                            <div class="mb-gutter">
                                {{ $pages->appends(['q' => $query])->links() }}
                            </div>
                        @endif

                    @else
                        <div class="bg-white border border-charcoal/10 p-section-padding text-center shadow-sm">
                            <span class="material-symbols-outlined text-secondary text-6xl mb-4">search_off</span>
                            <h3 class="font-headline-md text-2xl md:text-headline-md text-charcoal mb-stack-md">Tidak ada hasil
                            </h3>
                            <p class="font-body-md text-secondary max-w-md mx-auto">Tidak ditemukan hasil untuk
                                "<strong>{{ $query }}</strong>". Coba kata kunci yang berbeda.</p>
                        </div>
                    @endif
                </section>

                @include('themes.perbasi.layouts.sidebar')
            </div>
        </div>
    </main>
@endsection
