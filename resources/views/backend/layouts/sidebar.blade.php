 <!-- Sidebar -->
 <div class="sidebar" data-background-color="dark">
     <div class="sidebar-logo">
         <!-- Logo Header -->
         <div class="logo-header" data-background-color="dark">
             <a href="{{ route('dashboard') }}" class="logo">
                 <img src="{{ asset('backend/assets/img/logo-unkhair.png') }}" alt="navbar brand"
                     class="navbar-brand img-fluid" />
                 <h5 class="text-white m-2">Perbasi Malut</h5>
             </a>
             <div class="nav-toggle">
                 <button class="btn btn-toggle toggle-sidebar">
                     <i class="gg-menu-right"></i>
                 </button>
                 <button class="btn btn-toggle sidenav-toggler">
                     <i class="gg-menu-left"></i>
                 </button>
             </div>
             <button class="topbar-toggler more">
                 <i class="gg-more-vertical-alt"></i>
             </button>
         </div>
         <!-- End Logo Header -->
     </div>
     <div class="sidebar-wrapper scrollbar scrollbar-inner">
         <div class="sidebar-content">
             <ul class="nav nav-secondary">

                 <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                     <a href="{{ route('dashboard') }}">
                         <i class="fas fa-home"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>

                 {{-- ===== KONTEN ===== --}}
                 <li class="nav-section">
                     <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                     <h4 class="text-section">Konten</h4>
                 </li>

                 <li class="nav-item {{ request()->routeIs('posts.*') ? 'active submenu' : '' }}">
                     <a data-bs-toggle="collapse" href="#menu-posts">
                         <i class="fas fa-newspaper"></i>
                         <p>Berita</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse {{ request()->routeIs('posts.*') ? 'show' : '' }}" id="menu-posts">
                         <ul class="nav nav-collapse">
                             <li class="{{ request()->routeIs(['posts.index', 'posts.edit']) ? 'active' : '' }}">
                                 <a href="{{ route('posts.index') }}">
                                     <span class="sub-item">Semua Berita</span>
                                 </a>
                             </li>
                             <li class="{{ request()->routeIs('posts.create') ? 'active' : '' }}">
                                 <a href="{{ route('posts.create') }}">
                                     <span class="sub-item">Tambah Berita</span>
                                 </a>
                             </li>
                             <li class="{{ request()->routeIs('posts.categories.index') ? 'active' : '' }}">
                                 <a href="{{ route('posts.categories.index') }}">
                                     <span class="sub-item">Kategori</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>

                 <li class="nav-item {{ request()->routeIs('galleries.*') ? 'active' : '' }}">
                     <a href="{{ route('galleries.index') }}">
                         <i class="fas fa-camera"></i>
                         <p>Galeri</p>
                     </a>
                 </li>

                 <li class="nav-item {{ request()->routeIs('media.index') ? 'active' : '' }}">
                     <a href="{{ route('media.index') }}">
                         <i class="fas fa-folder"></i>
                         <p>Media</p>
                     </a>
                 </li>

                 <li class="nav-item {{ request()->routeIs('comments.index') ? 'active' : '' }}">
                     <a href="{{ route('comments.index') }}">
                         <i class="fab fa-facebook-messenger"></i>
                         <p>Komentar</p>
                         @if ($unreadCommentsCount)
                             <span class="badge badge-secondary">{{ $unreadCommentsCount }}</span>
                         @endif
                     </a>
                 </li>

                 {{-- ===== DATA PERBASI ===== --}}
                 <li class="nav-section">
                     <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                     <h4 class="text-section">Data Perbasi</h4>
                 </li>

                 <li class="nav-item {{ request()->routeIs('districts.*') ? 'active' : '' }}">
                     <a href="{{ route('districts.index') }}">
                         <i class="fas fa-map-marker-alt"></i>
                         <p>DPD Kab / Kota</p>
                     </a>
                 </li>

                 <li class="nav-item {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                     <a href="{{ route('teams.index') }}">
                         <i class="fas fa-shield-alt"></i>
                         <p>Klub</p>
                     </a>
                 </li>

                 <li class="nav-item {{ request()->routeIs('players.*') ? 'active' : '' }}">
                     <a href="{{ route('players.index') }}">
                         <i class="fas fa-running"></i>
                         <p>Pemain</p>
                     </a>
                 </li>

                 <li class="nav-item {{ request()->routeIs('coaches.*') ? 'active' : '' }}">
                     <a href="{{ route('coaches.index') }}">
                         <i class="fas fa-chalkboard-teacher"></i>
                         <p>Pelatih</p>
                     </a>
                 </li>

                 <li class="nav-item {{ request()->routeIs('officials.*') ? 'active' : '' }}">
                     <a href="{{ route('officials.index') }}">
                         <i class="fas fa-user-tie"></i>
                         <p>Official</p>
                     </a>
                 </li>

                 <li class="nav-item {{ request()->routeIs('referees.*') ? 'active' : '' }}">
                     <a href="{{ route('referees.index') }}">
                         <i class="fas fa-whistle"></i>
                         <p>Wasit</p>
                     </a>
                 </li>

                 {{-- ===== PENGATURAN (admin only) ===== --}}
                 @auth
                     @if (auth()->user()->is_admin)
                         <li class="nav-section">
                             <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                             <h4 class="text-section">Pengaturan</h4>
                         </li>

                         <li class="nav-item {{ request()->routeIs('tema.index') ? 'active' : '' }}">
                             <a href="{{ route('tema.index') }}">
                                 <i class="far fa-window-restore"></i>
                                 <p>Tema</p>
                             </a>
                         </li>

                         <li class="nav-item {{ request()->routeIs('pages.*') ? 'active submenu' : '' }}">
                             <a data-bs-toggle="collapse" href="#menu-pages">
                                 <i class="fas fa-file"></i>
                                 <p>Halaman</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse {{ request()->routeIs('pages.*') ? 'show' : '' }}" id="menu-pages">
                                 <ul class="nav nav-collapse">
                                     <li class="{{ request()->routeIs(['pages.index', 'pages.edit']) ? 'active' : '' }}">
                                         <a href="{{ route('pages.index') }}">
                                             <span class="sub-item">Semua Halaman</span>
                                         </a>
                                     </li>
                                     <li class="{{ request()->routeIs('pages.create') ? 'active' : '' }}">
                                         <a href="{{ route('pages.create') }}">
                                             <span class="sub-item">Buat Halaman</span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>

                         <li class="nav-item {{ request()->routeIs('menus.*') ? 'active' : '' }}">
                             <a href="{{ route('menus.create') }}">
                                 <i class="fas fa-caret-square-right"></i>
                                 <p>Menu Navigasi</p>
                             </a>
                         </li>

                         <li class="nav-item {{ request()->routeIs('settings.*', 'users.*') ? 'active submenu' : '' }}">
                             <a data-bs-toggle="collapse" href="#menu-settings">
                                 <i class="fas fa-cogs"></i>
                                 <p>Pengaturan</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse {{ request()->routeIs('settings.*', 'users.*') ? 'show' : '' }}" id="menu-settings">
                                 <ul class="nav nav-collapse">
                                     <li class="{{ request()->routeIs('settings.index') ? 'active' : '' }}">
                                         <a href="{{ route('settings.index') }}">
                                             <span class="sub-item">Umum</span>
                                         </a>
                                     </li>
                                     <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                                         <a href="{{ route('users.index') }}">
                                             <span class="sub-item">Pengguna</span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>
                     @endif
                 @endauth

             </ul>
         </div>
     </div>
 </div>
 <!-- End Sidebar -->
