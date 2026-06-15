@extends('themes.perbasi.layouts.main')

@section('main')
    <main class="mt-20">
        <!-- Page Header -->
        <section class="bg-charcoal py-stack-lg px-margin-desktop text-off-white border-b border-crimson-red/30">
            <div class="max-w-container-max mx-auto">
                <h1 class="font-headline-xl text-headline-xl uppercase tracking-tighter mb-stack-sm">
                    {{ $page->title }}
                </h1>
                <nav class="flex items-center gap-2 font-label-bold text-label-bold text-surface-variant text-sm">
                    <a href="/" class="hover:text-crimson-red transition-colors">Beranda</a>
                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                    <span class="text-crimson-red">{{ $page->title }}</span>
                </nav>
            </div>
        </section>

        <!-- Content -->
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
                <!-- Main Content -->
                <section class="lg:col-span-8">
                    @if ($page->image)
                        <div class="mb-stack-lg overflow-hidden shadow-sm">
                            <img src="{{ \App\Helpers\Media::url($page->image) }}" alt="{{ $page->title }}"
                                class="w-full h-64 object-cover" />
                        </div>
                    @endif

                    <article
                        class="bg-white border border-charcoal/10 p-stack-lg shadow-sm border-t-4 border-crimson-red">
                        <div class="prose max-w-none font-body-md text-body-md text-charcoal leading-relaxed">
                            {!! $page->content !!}
                        </div>
                    </article>
                </section>

                @include('themes.perbasi.layouts.sidebar')
            </div>
        </div>
    </main>
@endsection
