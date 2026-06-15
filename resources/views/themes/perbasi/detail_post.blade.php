@extends('themes.perbasi.layouts.main')

@push('styles')
    <style>
        .bento-grid-item {
            transition: transform 0.3s ease;
        }

        .bento-grid-item:hover {
            transform: translateY(-4px);
        }
    </style>
@endpush

@push('head')
    <meta name="title" content="{{ $page->title }}">
    <meta name="description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta name="keywords" content="{{ implode(',', $page->tags ?? ['basket', 'perbasi']) }}">
    <meta name="author" content="{{ $page->author ?? 'Admin' }}">
    <meta name="robots" content="index, follow">

    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta property="og:image" content="{{ \App\Helpers\Media::url($page->image) }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="{{ $site_name ?? 'Perbasi Maluku Utara' }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta name="twitter:image" content="{{ \App\Helpers\Media::url($page->image) }}">
@endpush

@section('main')
    <main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-padding mt-20">
        <!-- Page Header -->
        <div class="mb-section-padding border-l-8 border-crimson-red pl-gutter">
            <nav class="flex items-center gap-2 font-label-bold text-label-bold text-secondary mb-stack-sm text-sm">
                <a href="/" class="hover:text-crimson-red transition-colors">Beranda</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <a href="{{ route('allPosts') }}" class="hover:text-crimson-red transition-colors">Berita</a>
                @if ($page->category)
                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                    <a href="{{ route('categories.show', $page->category->slug) }}"
                        class="hover:text-crimson-red transition-colors">{{ $page->category->name }}</a>
                @endif
            </nav>
            <h1 class="font-headline-xl text-headline-xl uppercase mb-stack-sm tracking-tighter">
                {{ $page->title }}
            </h1>
            <div class="flex items-center gap-4 text-secondary font-label-bold text-label-bold">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                    {{ strtoupper($page->created_at->format('d F Y')) }}
                </span>
                @if ($page->category)
                    <span
                        class="bg-crimson-red text-off-white text-[10px] font-bold px-3 py-1 uppercase">{{ $page->category->name }}</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <!-- Main Content Area -->
            <section class="lg:col-span-8 space-y-stack-lg">
                <!-- Featured Image -->
                @if ($page->image)
                    <div class="relative overflow-hidden bento-grid-item shadow-sm">
                        <img class="w-full h-[400px] object-cover" src="{{ \App\Helpers\Media::url($page->image) }}"
                            alt="{{ $page->title }}" />
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-crimson-red"></div>
                    </div>
                @endif

                <!-- Post Content -->
                <article class="bg-white border border-charcoal/10 p-stack-lg shadow-sm border-b-4 border-crimson-red">
                    <div class="prose max-w-none font-body-md text-body-md text-charcoal leading-relaxed">
                        {!! $page->content !!}
                    </div>
                </article>

                <!-- Share Buttons -->
                <div class="bg-white border border-charcoal/10 p-stack-md shadow-sm flex flex-wrap items-center gap-4">
                    <span class="font-label-bold text-label-bold text-charcoal uppercase tracking-wider">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('posts.show', $page->slug)) }}"
                        target="_blank"
                        class="flex items-center gap-2 bg-charcoal text-off-white px-4 py-2 text-sm font-label-bold hover:bg-crimson-red transition-colors">
                        <img src="{{ asset('assets/facebook.svg') }}" alt="Facebook" width="18"> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', $page->slug)) }}&text={{ urlencode($page->title) }}"
                        target="_blank"
                        class="flex items-center gap-2 bg-charcoal text-off-white px-4 py-2 text-sm font-label-bold hover:bg-crimson-red transition-colors">
                        <img src="{{ asset('assets/x.svg') }}" alt="X / Twitter" width="18"> Twitter
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' ' . route('posts.show', $page->slug)) }}"
                        target="_blank"
                        class="flex items-center gap-2 bg-charcoal text-off-white px-4 py-2 text-sm font-label-bold hover:bg-crimson-red transition-colors">
                        <img src="{{ asset('assets/whatsapp.svg') }}" alt="WhatsApp" width="18"> WhatsApp
                    </a>
                </div>

                @if ($page->comments_is_active)
                    <!-- Comments Section -->
                    <div class="bg-white border border-charcoal/10 shadow-sm">
                        <div class="border-b-4 border-crimson-red px-stack-lg py-stack-md">
                            <h3 class="font-headline-md text-headline-md uppercase tracking-tight">
                                Komentar <span class="text-crimson-red">({{ $comments->count() }})</span>
                            </h3>
                        </div>
                        <div class="p-stack-lg space-y-stack-md">
                            @if (session('success'))
                                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm font-label-bold">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @forelse ($comments as $comment)
                                <div class="border-b border-charcoal/10 pb-stack-md last:border-0">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-8 h-8 bg-crimson-red flex items-center justify-center text-white font-bold text-sm uppercase">
                                            {{ substr($comment->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="font-label-bold text-charcoal">{{ $comment->name }}</span>
                                            <span class="text-secondary text-xs ml-2">{{ $comment->created_at->format('d F Y, H:i') }}</span>
                                        </div>
                                    </div>
                                    <p class="font-body-md text-secondary pl-11">{{ $comment->content }}</p>
                                </div>
                            @empty
                                <p class="text-secondary font-body-md text-center py-stack-md">Belum ada komentar.</p>
                            @endforelse
                        </div>

                    </div>
                @endif

                <!-- Back Button -->
                <div class="pt-stack-sm">
                    <a href="{{ route('allPosts') }}"
                        class="inline-flex items-center gap-2 text-charcoal font-label-bold text-label-bold hover:text-crimson-red transition-colors">
                        <span class="material-symbols-outlined">arrow_back</span>
                        KEMBALI KE BERITA
                    </a>
                </div>
            </section>

            <!-- Sidebar -->
            @include('themes.perbasi.layouts.sidebar')
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const header = document.querySelector('header, nav.fixed');
        window.addEventListener('scroll', () => {
            if (header) {
                if (window.scrollY > 50) {
                    header.classList.add('py-1', 'h-16');
                    header.classList.remove('h-20');
                } else {
                    header.classList.remove('py-1', 'h-16');
                    header.classList.add('h-20');
                }
            }
        });
    </script>
@endpush
