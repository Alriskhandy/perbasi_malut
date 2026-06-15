<aside class="lg:col-span-4 space-y-stack-lg">

    <!-- Search Widget -->
    <div class="bg-white p-gutter border-t-4 border-crimson-red shadow-sm">
        <form action="{{ route('search') }}" method="GET" class="flex" id="sidebar-search-form">
            <input type="search" name="q" id="sidebar-search-input"
                value="{{ e(request('q')) }}"
                placeholder="Cari..."
                maxlength="100"
                autocomplete="off"
                class="flex-grow px-4 py-2 font-body-md text-body-md text-charcoal border border-charcoal/20 focus:ring-1 focus:ring-crimson-red focus:border-crimson-red outline-none" />
            <button type="submit"
                class="bg-crimson-red text-off-white px-4 hover:bg-primary-container transition-colors">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
        <script>
            document.getElementById('sidebar-search-form')?.addEventListener('submit', function(e) {
                var input = document.getElementById('sidebar-search-input');
                var query = input.value.trim().replace(/[<>'"]/g, '');
                if (!query) { e.preventDefault(); return; }
                input.value = query;
            });
        </script>
    </div>

    <!-- Artikel Terbaru -->
    @if (isset($trendingPosts) && $trendingPosts->count() > 0)
        <div class="bg-white p-gutter border-t-4 border-crimson-red shadow-sm">
            <h3 class="font-headline-md text-headline-md mb-gutter uppercase">Artikel Lainnya</h3>
            <div class="space-y-stack-md">
                @foreach ($trendingPosts as $post)
                    <a class="group flex gap-stack-md items-center"
                        href="{{ route('posts.show', $post->slug) }}">
                        <div class="w-20 h-20 flex-shrink-0 overflow-hidden border border-charcoal/10">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform"
                                src="{{ \App\Helpers\Media::url($post->image) }}" alt="{{ $post->title }}" />
                        </div>
                        <div>
                            <h4
                                class="font-label-bold text-label-bold group-hover:text-crimson-red transition-colors leading-tight">
                                {{ Str::limit($post->title, 60) }}</h4>
                            <span
                                class="text-xs text-secondary/60">{{ $post->created_at->format('d M Y') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Kategori -->
    @if (isset($categoriesAll) && $categoriesAll->count() > 0)
        <div class="bg-charcoal p-gutter shadow-lg">
            <h3
                class="font-headline-md text-headline-md text-off-white mb-gutter uppercase border-b-2 border-crimson-red pb-2">
                Kategori</h3>
            <ul class="space-y-4">
                @foreach ($categoriesAll as $category)
                    <li class="flex justify-between items-center group">
                        <a href="{{ route('categories.show', $category->slug) }}"
                            class="font-body-md text-surface-variant group-hover:text-off-white transition-colors">
                            {{ $category->name }}
                        </a>
                        @if (isset($category->posts_count))
                            <span
                                class="bg-crimson-red text-off-white text-xs font-bold px-2 py-1">{{ $category->posts_count }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

</aside>
