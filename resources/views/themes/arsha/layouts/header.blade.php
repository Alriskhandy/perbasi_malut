<header class="header d-flex align-items-center {{ request()->is('/') ? 'fixed-top' : 'sticky-top' }}">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('storage/' . $site_logo->value) }}" class="mr-2" alt="Logo" height="40px" width="40px">
            <h3 class="sitename mb-0">{{ $site_name->value ?? 'themes/Arsha' }}</h3>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>

                @foreach ($menus as $menu)
                @foreach ($menu->items as $item)
                <li class="{{ $item->children->isNotEmpty() ? 'dropdown' : '' }}">
                    <a href="{{ $item->page
                                ? route('pages.show', $item->page->slug)
                                : ($item->post
                                    ? route('posts.show', $item->post->slug)
                                    : ($item->category
                                        ? route('categories.show', $item->category->slug)
                                        : $item->url)) }}"><span>{{ $item->label }}</span>
                        @if ($item->children->isNotEmpty())
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                        @endif
                    </a>

                    <!-- First-level dropdown menu -->
                    @if ($item->children->isNotEmpty())
                    <ul>
                        @foreach ($item->children as $child)
                        <li class="{{ $child->children->isNotEmpty() ? 'dropdown' : '' }}">
                            <a href="{{ $child->page
                                            ? route('pages.show', $child->page->slug)
                                            : ($child->post
                                                ? route('posts.show', $child->post->slug)
                                                : ($child->category
                                                    ? route('categories.show', $child->category->slug)
                                                    : $child->url)) }}"><span>{{ $child->label }}</span>
                                @if ($child->children->isNotEmpty())
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                                @endif
                            </a>
                            
                            <!-- Second-level dropdown menu -->
                            @if ($child->children->isNotEmpty())
                            <ul>
                                @foreach ($child->children as $subchild)
                                <li><a href="{{ $subchild->page
                                            ? route('pages.show', $subchild->page->slug)
                                            : ($subchild->post
                                                ? route('posts.show', $subchild->post->slug)
                                                : ($subchild->category
                                                    ? route('categories.show', $subchild->category->slug)
                                                    : $subchild->url)) }}">{{ $subchild->label
                                        }}</a></li>
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

                <li><a href="{{ route('galleries.front') }}" class="{{ request()->routeIs('galleries.front') ? 'active' : '' }}">Galleries</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>