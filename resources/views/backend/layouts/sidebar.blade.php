 <!-- Sidebar -->
 <div class="sidebar" data-background-color="dark">
     <div class="sidebar-logo">
         <!-- Logo Header -->
         <div class="logo-header" data-background-color="dark">
             <a href="{{ route('dashboard') }}" class="logo">
                 <img src="{{ asset('backend/assets/img/logo-unkhair.png') }}" alt="navbar brand"
                     class="navbar-brand img-fluid" />
                 <h5 class="text-white m-2">CMS UNKHAIR</h5>
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

                 <li class="nav-section">
                     <span class="sidebar-mini-icon">
                         <i class="fa fa-ellipsis-h"></i>
                     </span>
                     <h4 class="text-section">Pages</h4>
                 </li>

                 <li class="nav-item {{ request()->routeIs('posts.*') ? 'active submenu' : '' }}">
                     <a data-bs-toggle="collapse" href="#base">
                         <i class="fas fa-newspaper"></i>
                         <p>Posts</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse {{ request()->routeIs('posts.*') ? 'show' : '' }}" id="base">
                         <ul class="nav nav-collapse">
                             <li class="{{ request()->routeIs(['posts.index', 'posts.edit']) ? 'active' : '' }}">
                                 <a href="{{ route('posts.index') }}">
                                     <span class="sub-item">All Posts</span>
                                 </a>
                             </li>
                             <li class="{{ request()->routeIs('posts.create') ? 'active' : '' }}">
                                 <a href="{{ route('posts.create') }}">
                                     <span class="sub-item">Add Posts</span>
                                 </a>
                             </li>
                             <li class="{{ request()->routeIs('posts.categories.index') ? 'active' : '' }}">
                                 <a href="{{ route('posts.categories.index') }}">
                                     <span class="sub-item">Categories</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>

                 <li class="nav-item {{ request()->routeIs('galleries.*') ? 'active' : '' }}">
                     <a href="{{ route('galleries.index') }}">
                         <i class="fas fa-camera"></i>
                         <p>Galleries</p>
                     </a>
                 </li>

                 <li class="nav-item {{ request()->routeIs('media.index') ? 'active' : '' }}">
                     <a href="{{ route('media.index') }}">
                         <i class="fas fa-folder"></i>
                         <p>Media</p>
                     </a>
                 </li>

                 <li class="nav-item ">
                     <a href="{{ route('comments.index') }}">
                         <i class="fab fa-facebook-messenger"></i>
                         <p>Comments</p>
                         {{-- <span class="badge badge-secondary">2000</span> --}}
                         @if ($unreadCommentsCount)
                             <span class="badge badge-secondary">{{ $unreadCommentsCount }}</span>
                         @endif
                     </a>
                 </li>

                 <li class="nav-item {{ request()->routeIs('tema.index') ? 'active' : '' }}">
                     <a href="{{ route('tema.index') }}">
                         <i class="far fa-window-restore"></i>
                         <p>Themes</p>
                     </a>
                 </li>
                 @auth
                     @if (auth()->user()->is_admin)
                         <li class="nav-section">
                             <span class="sidebar-mini-icon">
                                 <i class="fa fa-ellipsis-h"></i>
                             </span>
                             <h4 class="text-section">Settings</h4>
                         </li>

                         <li class="nav-item {{ request()->routeIs('pages.*') ? 'active submenu' : '' }}">
                             <a data-bs-toggle="collapse" href="#laman">
                                 <i class="fas fa-file"></i>
                                 <p>Pages</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse {{ request()->routeIs('pages.*') ? 'show' : '' }}" id="laman">
                                 <ul class="nav nav-collapse">
                                     <li class="{{ request()->routeIs(['pages.index', 'pages.edit']) ? 'active' : '' }}">
                                         <a href="{{ route('pages.index') }}">
                                             <span class="sub-item">All Pages</span>
                                         </a>
                                     </li>
                                     <li class="{{ request()->routeIs('pages.create') ? 'active' : '' }}">
                                         <a href="{{ route('pages.create') }}">
                                             <span class="sub-item">Create Page</span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>

                         <li class="nav-item {{ request()->routeIs('menus.create') ? 'active' : '' }}">
                             <a href="{{ route('menus.create') }}">
                                 <i class="fas fa-caret-square-right"></i>
                                 <p>Menu</p>
                             </a>
                         </li>


                         <li class="nav-item {{ request()->routeIs('users.*') ? 'active submenu' : '' }}">
                             <a data-bs-toggle="collapse" href="#charts">
                                 <i class="fas fa-cogs"></i>
                                 <p>Settings</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse {{ request()->routeIs('settings.*') ? 'show' : '' }}" id="charts">
                                 <ul class="nav nav-collapse">
                                     <li class="{{ request()->routeIs('settings.index') ? 'active' : '' }}">
                                         <a href="{{ route('settings.index') }}">
                                             <span class="sub-item">General</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="{{ route('users.index') }}">
                                             <span class="sub-item">Users</span>
                                         </a>
                                     </li>

                                 </ul>
                             </div>
                         </li>
                     @endif
                 @endauth


                 {{-- <li class="nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                     <a href="{{ route('settings.index') }}">
                         <i class="fas fa-cogs"></i>
                         <p>Settings</p>
                     </a>
                 </li> --}}
                 {{-- <li class="nav-item {{ request()->routeIs('settings.*') ? 'active submenu' : '' }}">
                     <a data-bs-toggle="collapse" href="#pengaturan">
                         <i class="fas fa-cogs"></i>
                         <p>Settings</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse {{ request()->routeIs('settings.*') ? 'show' : '' }}" id="pengaturan">
                         <ul class="nav nav-collapse">
                             <li>
                                 <a href="#">
                                     <span class="sub-item">General</span>
                                 </a>
                             </li>
                             <li>
                                 <a href="#">
                                     <span class="sub-item">Other Settings</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li> --}}
             </ul>
         </div>
     </div>



 </div>
 <!-- End Sidebar -->
