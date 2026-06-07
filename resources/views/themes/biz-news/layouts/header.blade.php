<!-- Topbar Start -->
<div class="container-fluid d-none d-lg-block">
    <div class="row align-items-center bg-white py-3 px-lg-5">
        <div class="col-lg-4">
            <a href="{{ url('/') }}" class="navbar-brand p-0 d-none d-flex align-middle">
                <img src="{{ asset('storage/' . $site_logo->value) }}" class="mr-2" alt="Logo" height="45px"
                    width="45px">

                <h1 class="m-0 display-5 text-secondary">{{ $site_name->value ?? 'themes/BizNews' }}
                </h1>
            </a>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
            <i class="bi bi-clock me-1"></i>
            {{ \Carbon\Carbon::now()->setTimezone('Asia/Jayapura')->locale('id')->translatedFormat('l, H:i') }}
            WIT
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>

                @foreach ($menus as $menu)
                @foreach ($menu->items as $item)

                <div class="nav-item {{ $item->children->isNotEmpty() ? 'dropdown' : '' }}">
                    <a href="{{ $item->page
                                    ? route('pages.show', $item->page->slug)
                                    : ($item->post
                                        ? route('posts.show', $item->post->slug)
                                        : ($item->category
                                            ? route('categories.show', $item->category->slug)
                                            : $item->url)) }}"
                        class="nav-link {{ $item->children->isNotEmpty() ? 'dropdown-toggle' : '' }}"
                        data-toggle="{{ $item->children->isNotEmpty() ? 'dropdown' : '' }}">{{ $item->label }}</a>

                    @if ($item->children->isNotEmpty())
                    <div class="dropdown-menu rounded-0 m-0">
                        @foreach ($item->children as $child)
                        <a href="{{ $child->page
                                            ? route('pages.show', $child->page->slug)
                                            : ($child->post
                                                ? route('posts.show', $child->post->slug)
                                                : ($child->category
                                                    ? route('categories.show', $child->category->slug)
                                                    : $child->url)) }}"
                            class="dropdown-item {{ Request::url() == url($child->url) ? 'active' : '' }}">{{
                            $child->label }}</a>
                        @if ($child->children->isNotEmpty())
                        <ul>
                            @foreach ($child->children as $subchild)
                            <li>
                                <a href="{{ $subchild->page
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
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach

                @endforeach

                <a href="{{ route('galleries.front') }}"
                    class="nav-item nav-link {{ request()->is('/galleries') ? 'active' : '' }}">Galleries</a>
            </div>

            <form action="{{ route('search') }}" method="GET" class="ml-auto d-none d-lg-flex"
                style="width: 100%; max-width: 300px;">
                <div class="input-group">
                    <input type="text" name="q" class="form-control border-0" placeholder="Search..."
                        value="{{ request('q') }}">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-primary text-dark border-0 px-3">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </nav>
</div>
<!-- Navbar End -->