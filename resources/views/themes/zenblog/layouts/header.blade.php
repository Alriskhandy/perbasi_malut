<div class="container section">
    <img class="img-fluid" src="{{ asset('hero.jpg') }}" alt="">
</div>
<header id="header" class="header d-flex align-items-center sticky-top ">
    <div class="container navbar position-relative d-flex align-items-center justify-content-between p-2">

        <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('storage/' . $site_logo->value) }}" alt="">
            <h1 class="sitename">{{ $site_name->value }}</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>

                <li><a href="/">Home</a></li>
                @foreach ($menus as $menu)
                    @foreach ($menu->items as $item)
                        <li class="{{ $item->children->isNotEmpty() ? 'dropdown' : '' }}">
                            <!-- Conditional logic for page, post, or custom link -->
                            <a href="{{ $item->page
                                ? route('pages.show', $item->page->slug)
                                : ($item->post
                                    ? route('posts.show', $item->post->slug)
                                    : ($item->category
                                        ? route('categories.show', $item->category->slug)
                                        : $item->url)) }}"
                                class="{{ $item->children->isNotEmpty() ? 'dropdown-toggle' : '' }}"
                                {{ $item->children->isNotEmpty() ? 'data-toggle=dropdown' : '' }}>
                                {{ $item->label }}
                            </a>

                            <!-- First-level dropdown menu -->
                            @if ($item->children->isNotEmpty())
                                <ul class="dropdown-menu">
                                    @foreach ($item->children as $child)
                                        <li class="{{ $child->children->isNotEmpty() ? 'dropdown' : '' }}">
                                            <!-- Conditional logic for child items (page, post, category) -->
                                            <a href="{{ $child->page
                                                ? route('pages.show', $child->page->slug)
                                                : ($child->post
                                                    ? route('posts.show', $child->post->slug)
                                                    : ($child->category
                                                        ? route('categories.show', $child->category->slug)
                                                        : $child->url)) }}"
                                                class="{{ $child->children->isNotEmpty() ? 'dropdown-toggle' : '' }}"
                                                {{ $child->children->isNotEmpty() ? 'data-toggle=dropdown' : '' }}>
                                                {{ $child->label }}
                                            </a>

                                            <!-- Second-level dropdown menu -->
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

        <div class="header-social-links">
            {{-- <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> --}}
        </div>

    </div>
</header>
