<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="d-none d-md-flex align-items-center">
                <i class="bi bi-clock me-1"></i>
                {{ \Carbon\Carbon::now()->setTimezone('Asia/Jayapura')->locale('id')->translatedFormat('l, H:i') }}
                WIT
            </div>
            {{-- <div class="d-flex align-items-center">
                <i class="bi bi-phone me-1"></i> Call us now +1 5589 55488 55
            </div> --}}
        </div>
    </div><!-- End Top Bar -->


    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-end">
            <a href="/" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('storage/' . $site_logo->value) }}" alt="">
                <!-- Uncomment the line below if you also wish to use a text logo -->
                <h3 class="sitename">{{ $site_name->value }}</h3>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/" class="">Beranda</a></li>
                    @foreach ($menus as $menu)
                        @foreach ($menu->items as $item)
                            <li class="{{ $item->children->isNotEmpty() ? 'dropdown' : '' }}">
                                <a href="{{ $item->page
                                    ? route('pages.show', $item->page->slug)
                                    : ($item->post
                                        ? route('posts.show', $item->post->slug)
                                        : ($item->category
                                            ? route('categories.show', $item->category->slug)
                                            : $item->url)) }}"
                                    class="{{ Request::url() == $item->url ? 'active' : '' }}">
                                    {{ $item->label }}
                                    @if ($item->children->isNotEmpty())
                                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                                    @endif
                                </a>

                                @if ($item->children->isNotEmpty())
                                    <ul>
                                        @foreach ($item->children as $child)
                                            <li class="{{ $child->children->isNotEmpty() ? 'dropdown' : '' }}">
                                                <a
                                                    href="{{ $child->page
                                                        ? route('pages.show', $child->page->slug)
                                                        : ($child->post
                                                            ? route('posts.show', $child->post->slug)
                                                            : ($child->category
                                                                ? route('categories.show', $child->category->slug)
                                                                : $child->url)) }}">
                                                    {{ $child->label }}
                                                    @if ($child->children->isNotEmpty())
                                                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                                                    @endif
                                                </a>

                                                @if ($child->children->isNotEmpty())
                                                    <ul>
                                                        @foreach ($child->children as $subchild)
                                                            <li>
                                                                <a
                                                                    href="{{ $subchild->page
                                                                        ? route('pages.show', $subchild->page->slug)
                                                                        : ($subchild->post
                                                                            ? route('posts.show', $subchild->post->slug)
                                                                            : ($subchild->category
                                                                                ? route('categories.show', $subchild->category->slug)
                                                                                : $subchild->url)) }}">
                                                                    {{ $subchild->label }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endforeach
                    <li><a href="{{ route('galleries.front') }}">Galleries</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>

    </div>

</header>
