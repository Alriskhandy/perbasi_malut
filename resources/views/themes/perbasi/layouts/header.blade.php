<nav
    class="bg-charcoal fixed top-0 w-full z-50 border-b border-crimson-red shadow-md h-20 flex justify-between items-center px-margin-desktop">
    <div class="flex items-center gap-stack-md">
        <img alt="PERBASI Logo" class="h-12 w-auto"
            src="{{ isset($site_logo) ? \App\Helpers\Media::url($site_logo->value) : asset('backend/assets/img/logo-perbasi.png') }}" />
        <span class="font-headline-md text-headline-md font-bold text-off-white tracking-tighter">PERBASI
            MALUT</span>
    </div>

    <!-- Desktop Nav -->
    <div class="hidden md:flex items-center gap-stack-lg">
        <a class="font-label-bold text-label-bold {{ request()->is('/') ? 'text-crimson-red border-b-2 border-crimson-red pb-1' : 'text-off-white hover:text-crimson-red' }} transition-colors duration-300"
            href="/">Beranda</a>

        @if (isset($menus))
            @foreach ($menus as $menu)
                @foreach ($menu->items as $item)
                    @php
                        $href = $item->page
                            ? route('pages.show', $item->page->slug)
                            : ($item->post
                                ? route('posts.show', $item->post->slug)
                                : ($item->category
                                    ? route('categories.show', $item->category->slug)
                                    : ($item->url ?:
                                    '#')));
                        $hasChildren = $item->children->isNotEmpty();
                    @endphp

                    @if ($hasChildren)
                        <!-- Dropdown Item -->
                        <div class="relative nav-dropdown-wrapper">
                            <button
                                class="nav-dropdown-btn flex items-center gap-1 font-label-bold text-label-bold text-off-white hover:text-crimson-red transition-colors duration-300">
                                {{ $item->label }}
                                <span
                                    class="material-symbols-outlined text-[16px] nav-chevron transition-transform duration-200">expand_more</span>
                            </button>

                            <div
                                class="nav-dropdown-menu absolute top-full left-0 mt-2 min-w-[200px] bg-charcoal border-t-2 border-crimson-red shadow-xl opacity-0 invisible translate-y-2 transition-all duration-200 z-50">
                                <!-- Level 1 children -->
                                @foreach ($item->children as $child)
                                    @php
                                        $childHref = $child->page
                                            ? route('pages.show', $child->page->slug)
                                            : ($child->post
                                                ? route('posts.show', $child->post->slug)
                                                : ($child->category
                                                    ? route('categories.show', $child->category->slug)
                                                    : $child->url));
                                        $hasGrandchildren = $child->children->isNotEmpty();
                                    @endphp

                                    @if ($hasGrandchildren)
                                        <!-- Level 2 dropdown -->
                                        <div class="relative nav-subdropdown-wrapper group/sub">
                                            <button
                                                class="w-full text-left px-4 py-3 font-label-bold text-label-bold text-surface-variant hover:text-off-white hover:bg-white/5 transition-colors flex items-center justify-between">
                                                {{ $child->label }}
                                                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                                            </button>
                                            <div
                                                class="absolute left-full top-0 min-w-[200px] bg-charcoal border-t-2 border-crimson-red shadow-xl opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-200 z-50">
                                                @foreach ($child->children as $subchild)
                                                    @php
                                                        $subHref = $subchild->page
                                                            ? route('pages.show', $subchild->page->slug)
                                                            : ($subchild->post
                                                                ? route('posts.show', $subchild->post->slug)
                                                                : ($subchild->category
                                                                    ? route(
                                                                        'categories.show',
                                                                        $subchild->category->slug,
                                                                    )
                                                                    : $subchild->url));
                                                    @endphp
                                                    <a href="{{ $subHref }}"
                                                        class="block px-4 py-3 font-label-bold text-label-bold text-surface-variant hover:text-off-white hover:bg-white/5 transition-colors border-b border-white/5 last:border-0">
                                                        {{ $subchild->label }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ $childHref }}"
                                            class="block px-4 py-3 font-label-bold text-label-bold text-surface-variant hover:text-off-white hover:bg-white/5 transition-colors border-b border-white/5 last:border-0">
                                            {{ $child->label }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a class="font-label-bold text-label-bold {{ url()->current() === $href ? 'text-crimson-red border-b-2 border-crimson-red pb-1' : 'text-off-white hover:text-crimson-red' }} transition-colors duration-300"
                            href="{{ $href }}">{{ $item->label }}</a>
                    @endif
                @endforeach
            @endforeach
        @endif

        @php
            $resourcesActive = request()->routeIs('athletes.*', 'clubs.*', 'coaches.*', 'officials.*', 'referees.*');
        @endphp
        <div class="relative nav-dropdown-wrapper">
            <button
                class="nav-dropdown-btn flex items-center gap-1 font-label-bold text-label-bold {{ $resourcesActive ? 'text-crimson-red border-b-2 border-crimson-red pb-1' : 'text-off-white hover:text-crimson-red' }} transition-colors duration-300">
                Resources
                <span
                    class="material-symbols-outlined text-[16px] nav-chevron transition-transform duration-200">expand_more</span>
            </button>
            <div
                class="nav-dropdown-menu absolute top-full left-0 mt-2 w-48 bg-charcoal border-t-2 border-crimson-red shadow-xl opacity-0 invisible translate-y-2 transition-all duration-200 z-50">
                <a href="{{ route('athletes.index') }}"
                    class="flex items-center gap-3 px-4 py-3 font-label-bold text-label-bold {{ request()->routeIs('athletes.*') ? 'text-crimson-red' : 'text-surface-variant hover:text-off-white' }} hover:bg-white/5 transition-colors border-b border-white/5">
                    <span class="material-symbols-outlined text-[17px]">person</span>
                    Atlet
                </a>
                <a href="{{ route('clubs.index') }}"
                    class="flex items-center gap-3 px-4 py-3 font-label-bold text-label-bold {{ request()->routeIs('clubs.*') ? 'text-crimson-red' : 'text-surface-variant hover:text-off-white' }} hover:bg-white/5 transition-colors border-b border-white/5">
                    <span class="material-symbols-outlined text-[17px]">groups</span>
                    Klub
                </a>
                <a href="{{ route('coaches.front') }}"
                    class="flex items-center gap-3 px-4 py-3 font-label-bold text-label-bold {{ request()->routeIs('coaches.*') ? 'text-crimson-red' : 'text-surface-variant hover:text-off-white' }} hover:bg-white/5 transition-colors border-b border-white/5">
                    <span class="material-symbols-outlined text-[17px]">sports</span>
                    Pelatih
                </a>
                <a href="{{ route('referees.front') }}"
                    class="flex items-center gap-3 px-4 py-3 font-label-bold text-label-bold {{ request()->routeIs('referees.*') ? 'text-crimson-red' : 'text-surface-variant hover:text-off-white' }} hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined text-[17px]">sports_cricket</span>
                    Wasit
                </a>
            </div>
        </div>

        <a class="font-label-bold text-label-bold {{ request()->routeIs('dpd.*') ? 'text-crimson-red border-b-2 border-crimson-red pb-1' : 'text-off-white hover:text-crimson-red' }} transition-colors duration-300"
            href="{{ route('dpd.index') }}">Perbasi DPD</a>

        <a class="font-label-bold text-label-bold {{ request()->routeIs('galleries.front') ? 'text-crimson-red border-b-2 border-crimson-red pb-1' : 'text-off-white hover:text-crimson-red' }} transition-colors duration-300"
            href="{{ route('galleries.front') }}">Galeri</a>
    </div>

    <div class="flex items-center gap-stack-md">
        <button id="search-toggle-btn"
            class="hidden md:block material-symbols-outlined text-off-white hover:text-crimson-red transition-colors">search</button>
        {{-- <a href="{{ route('login') }}"
            class="bg-crimson-red text-off-white px-6 py-2 rounded-DEFAULT font-label-bold text-label-bold hover:bg-primary-container transition-all active:scale-95 duration-150 uppercase">Login</a> --}}
        <button id="mobile-menu-btn" class="md:hidden material-symbols-outlined text-off-white">menu</button>
    </div>
</nav>

<!-- Search Modal -->
<div id="search-modal" style="display:none"
    class="fixed inset-0 bg-charcoal/80 z-[60] items-start justify-center pt-32 px-margin-mobile">
    <div class="bg-off-white w-full max-w-2xl shadow-2xl relative">
        <form action="{{ route('search') }}" method="GET" class="flex" id="search-form">
            <input type="search" name="q" id="search-input" value="{{ e(request('q')) }}"
                placeholder="Cari berita, halaman..." maxlength="100" autocomplete="off"
                class="flex-grow px-6 py-4 font-body-md text-body-md text-charcoal border-none focus:ring-0 outline-none bg-transparent" />
            <button type="submit"
                class="bg-crimson-red text-off-white px-6 font-label-bold uppercase hover:bg-primary-container transition-colors">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
        <button id="search-close-btn"
            class="absolute -top-10 right-0 text-off-white material-symbols-outlined text-3xl hover:text-crimson-red">close</button>
    </div>
</div>

<!-- Mobile Menu -->
<div id="mobile-menu" style="display:none"
    class="fixed inset-0 bg-charcoal z-[55] flex-col items-center justify-center gap-6 overflow-y-auto py-20">
    <button id="mobile-close-btn"
        class="absolute top-6 right-6 text-off-white material-symbols-outlined text-3xl">close</button>

    <a class="font-headline-md text-headline-md {{ request()->is('/') ? 'text-crimson-red' : 'text-off-white hover:text-crimson-red' }} transition-colors"
        href="/">Beranda</a>

    @if (isset($menus))
        @foreach ($menus as $menu)
            @foreach ($menu->items as $item)
                @php
                    $href = $item->page
                        ? route('pages.show', $item->page->slug)
                        : ($item->post
                            ? route('posts.show', $item->post->slug)
                            : ($item->category
                                ? route('categories.show', $item->category->slug)
                                : ($item->url ?:
                                '#')));
                    $hasChildren = $item->children->isNotEmpty();
                @endphp

                @if ($hasChildren)
                    <div class="w-full max-w-xs text-center">
                        <button
                            class="mobile-dropdown-btn w-full font-headline-md text-headline-md text-off-white hover:text-crimson-red transition-colors flex items-center justify-center gap-2">
                            {{ $item->label }}
                            <span
                                class="material-symbols-outlined mobile-chevron transition-transform duration-200">expand_more</span>
                        </button>
                        <div class="mobile-dropdown-content hidden flex-col gap-3 mt-3 border-t border-white/10 pt-3">
                            @foreach ($item->children as $child)
                                @php
                                    $childHref = $child->page
                                        ? route('pages.show', $child->page->slug)
                                        : ($child->post
                                            ? route('posts.show', $child->post->slug)
                                            : ($child->category
                                                ? route('categories.show', $child->category->slug)
                                                : $child->url));
                                @endphp
                                <a href="{{ $childHref }}"
                                    class="font-label-bold text-label-bold text-surface-variant hover:text-crimson-red transition-colors">
                                    {{ $child->label }}
                                </a>
                                @foreach ($child->children as $subchild)
                                    @php
                                        $subHref = $subchild->page
                                            ? route('pages.show', $subchild->page->slug)
                                            : ($subchild->post
                                                ? route('posts.show', $subchild->post->slug)
                                                : ($subchild->category
                                                    ? route('categories.show', $subchild->category->slug)
                                                    : $subchild->url));
                                    @endphp
                                    <a href="{{ $subHref }}"
                                        class="font-label-bold text-label-bold text-surface-variant/60 hover:text-crimson-red transition-colors pl-4">
                                        — {{ $subchild->label }}
                                    </a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @else
                    <a class="font-headline-md text-headline-md {{ url()->current() === $href ? 'text-crimson-red' : 'text-off-white hover:text-crimson-red' }} transition-colors"
                        href="{{ $href }}">{{ $item->label }}</a>
                @endif
            @endforeach
        @endforeach
    @endif

    <div class="w-full max-w-xs text-center">
        <button
            class="mobile-dropdown-btn w-full font-headline-md text-headline-md {{ $resourcesActive ? 'text-crimson-red' : 'text-off-white hover:text-crimson-red' }} transition-colors flex items-center justify-center gap-2">
            Resources
            <span class="material-symbols-outlined mobile-chevron transition-transform duration-200">expand_more</span>
        </button>
        <div class="mobile-dropdown-content hidden flex-col gap-3 mt-3 border-t border-white/10 pt-3">
            <a href="{{ route('athletes.index') }}"
                class="font-label-bold text-label-bold {{ request()->routeIs('athletes.*') ? 'text-crimson-red' : 'text-surface-variant hover:text-crimson-red' }} transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[16px]">person</span>Atlet
            </a>
            <a href="{{ route('clubs.index') }}"
                class="font-label-bold text-label-bold {{ request()->routeIs('clubs.*') ? 'text-crimson-red' : 'text-surface-variant hover:text-crimson-red' }} transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[16px]">groups</span>Klub
            </a>
            <a href="{{ route('coaches.front') }}"
                class="font-label-bold text-label-bold {{ request()->routeIs('coaches.*') ? 'text-crimson-red' : 'text-surface-variant hover:text-crimson-red' }} transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[16px]">sports</span>Pelatih
            </a>
            <a href="{{ route('referees.front') }}"
                class="font-label-bold text-label-bold {{ request()->routeIs('referees.*') ? 'text-crimson-red' : 'text-surface-variant hover:text-crimson-red' }} transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[16px]">sports_cricket</span>Wasit
            </a>
        </div>
    </div>

    <a class="font-headline-md text-headline-md {{ request()->routeIs('dpd.*') ? 'text-crimson-red' : 'text-off-white hover:text-crimson-red' }} transition-colors"
        href="{{ route('dpd.index') }}">Perbasi DPD</a>

    <a class="font-headline-md text-headline-md {{ request()->routeIs('galleries.front') ? 'text-crimson-red' : 'text-off-white hover:text-crimson-red' }} transition-colors"
        href="{{ route('galleries.front') }}">Galeri</a>
</div>

@push('scripts')
    <script>
        (function() {
            // Search modal
            var searchModal = document.getElementById('search-modal');
            var mobileMenu = document.getElementById('mobile-menu');

            document.getElementById('search-toggle-btn')?.addEventListener('click', function() {
                searchModal.style.display = searchModal.style.display === 'flex' ? 'none' : 'flex';
                if (searchModal.style.display === 'flex') {
                    document.getElementById('search-input')?.focus();
                }
            });
            document.getElementById('search-form')?.addEventListener('submit', function(e) {
                var input = document.getElementById('search-input');
                var query = input.value.trim().replace(/[<>'"]/g, '');
                if (!query) {
                    e.preventDefault();
                    return;
                }
                input.value = query;
            });
            document.getElementById('search-close-btn')?.addEventListener('click', function() {
                searchModal.style.display = 'none';
            });

            // Mobile menu
            document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
                mobileMenu.style.display = mobileMenu.style.display === 'flex' ? 'none' : 'flex';
            });
            document.getElementById('mobile-close-btn')?.addEventListener('click', function() {
                mobileMenu.style.display = 'none';
            });

            // Desktop dropdown: toggle on click, close on outside click
            document.querySelectorAll('.nav-dropdown-wrapper').forEach(function(wrapper) {
                var btn = wrapper.querySelector('.nav-dropdown-btn');
                var menu = wrapper.querySelector('.nav-dropdown-menu');
                var chevron = wrapper.querySelector('.nav-chevron');

                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    var isOpen = !menu.classList.contains('invisible');
                    // tutup semua dropdown lain
                    document.querySelectorAll('.nav-dropdown-menu').forEach(function(m) {
                        m.classList.add('opacity-0', 'invisible', 'translate-y-2');
                        m.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    });
                    document.querySelectorAll('.nav-chevron').forEach(function(c) {
                        c.classList.remove('rotate-180');
                    });
                    if (!isOpen) {
                        menu.classList.remove('opacity-0', 'invisible', 'translate-y-2');
                        menu.classList.add('opacity-100', 'visible', 'translate-y-0');
                        chevron.classList.add('rotate-180');
                    }
                });
            });

            document.addEventListener('click', function() {
                document.querySelectorAll('.nav-dropdown-menu').forEach(function(m) {
                    m.classList.add('opacity-0', 'invisible', 'translate-y-2');
                    m.classList.remove('opacity-100', 'visible', 'translate-y-0');
                });
                document.querySelectorAll('.nav-chevron').forEach(function(c) {
                    c.classList.remove('rotate-180');
                });
            });

            // Mobile dropdown: toggle children
            document.querySelectorAll('.mobile-dropdown-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var content = btn.nextElementSibling;
                    var chevron = btn.querySelector('.mobile-chevron');
                    var isHidden = content.classList.contains('hidden');
                    content.classList.toggle('hidden', !isHidden);
                    content.classList.toggle('flex', isHidden);
                    chevron.classList.toggle('rotate-180', isHidden);
                });
            });
        })();
    </script>
@endpush
