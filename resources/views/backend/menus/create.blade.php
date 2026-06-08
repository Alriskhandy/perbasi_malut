@extends('backend.layouts.main')

@push('css')
    <style>
        .dd-item > .dd-handle {
            padding: 12px 16px;
            margin-bottom: 6px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: move;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 500;
        }
        .dd-list {
            padding-left: 20px;
            border-left: 2px solid #ddd;
            margin-top: 8px;
        }
        .dd-item > button { display: none !important; }
        .dd-dragel { position: absolute; pointer-events: none; z-index: 1000; }
        .dd-dragel .dd-handle { background-color: #e2e6ea; border-color: #ccc; }
    </style>
@endpush

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3 fs-3">Menu Structure</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('dashboard') }}"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Menu Structure</a></li>
                </ul>
            </div>

            <div class="row">
                <!-- Add Menu Form -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Add Menu</h2>
                            <form action="{{ route('menus.store') }}" method="POST" class="p-4 border rounded">
                                @csrf

                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">Parent (optional)</label>
                                    <select name="parent_id" id="parent_id" class="form-select">
                                        <option value="">-- Select Parent Menu --</option>
                                        @foreach ($menuItems as $item)
                                            <option value="{{ $item->id }}">{{ $item->label }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="menu_type" class="form-label">Select Menu Type</label>
                                    <select name="menu_type" id="menu_type" class="form-select">
                                        <option value="">-- Select Menu Type --</option>
                                                        <option value="group">Grup (tanpa link)</option>
                                        <option value="pages">Pages</option>
                                        <option value="posts">Posts</option>
                                        <option value="categories">Categories</option>
                                        <option value="link">Link</option>
                                    </select>
                                </div>

                                <div class="mb-3 menu-section" id="pages-section" style="display:none">
                                    <label class="form-label">Pages</label>
                                    <input type="text" id="page-search" class="form-control mb-2" placeholder="Search Pages">
                                    <div class="border p-3" id="pages-list" style="max-height:200px;overflow-y:auto">
                                        @foreach ($pages as $page)
                                            <div class="form-check page-item">
                                                <input type="radio" class="form-check-input" name="selected_item"
                                                    value="{{ $page->id }}" id="page{{ $page->id }}">
                                                <input type="hidden" id="page_id">
                                                <label class="form-check-label" for="page{{ $page->id }}">{{ $page->title }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-3 menu-section" id="posts-section" style="display:none">
                                    <label class="form-label">Posts</label>
                                    <input type="text" id="post-search" class="form-control mb-2" placeholder="Search Posts">
                                    <div class="border p-3" id="posts-list" style="max-height:200px;overflow-y:auto">
                                        @foreach ($posts as $post)
                                            <div class="form-check post-item">
                                                <input type="radio" class="form-check-input" name="selected_item"
                                                    value="{{ $post->id }}" id="post{{ $post->id }}">
                                                <input type="hidden" id="post_id">
                                                <label class="form-check-label" for="post{{ $post->id }}">{{ $post->title }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-3 menu-section" id="categories-section" style="display:none">
                                    <label class="form-label">Categories</label>
                                    <input type="text" id="category-search" class="form-control mb-2" placeholder="Search Categories">
                                    <div class="border p-3" id="categories-list" style="max-height:200px;overflow-y:auto">
                                        @foreach ($categories as $category)
                                            <div class="form-check category-item">
                                                <input type="radio" class="form-check-input" name="selected_item"
                                                    value="{{ $category->id }}" id="category{{ $category->id }}">
                                                <input type="hidden" id="category_id">
                                                <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Label — selalu tampil setelah tipe dipilih -->
                                <div class="mb-3" id="label-section" style="display:none">
                                    <label for="label" class="form-label">Label <span class="text-danger">*</span></label>
                                    <input type="text" name="label" id="label" class="form-control"
                                        maxlength="255" placeholder="Nama yang tampil di menu">
                                    @error('label')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="group-hint" class="form-text text-muted" style="display:none">
                                        Menu grup tidak memiliki link — hanya digunakan sebagai parent/judul dropdown.
                                    </div>
                                </div>

                                <div class="mb-3 menu-section" id="url-section" style="display:none">
                                    <label for="url" class="form-label">URL (optional)</label>
                                    <input type="text" name="url" id="url" class="form-control"
                                        maxlength="255" placeholder="Enter URL" value="#!">
                                    @error('url')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Add Menu</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Menu Tree -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Struktur Menu</h2>
                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    @foreach ($menus as $menu)
                                        @foreach ($menu->items as $item)
                                            <li class="dd-item" data-id="{{ $item->id }}">
                                                @include('backend.menus._item', ['node' => $item])

                                                @if ($item->children->isNotEmpty())
                                                    <ol class="dd-list">
                                                        @foreach ($item->children as $child)
                                                            <li class="dd-item" data-id="{{ $child->id }}">
                                                                @include('backend.menus._item', ['node' => $child])

                                                                @if ($child->children->isNotEmpty())
                                                                    <ol class="dd-list">
                                                                        @foreach ($child->children as $subchild)
                                                                            <li class="dd-item" data-id="{{ $subchild->id }}">
                                                                                @include('backend.menus._item', ['node' => $subchild])
                                                                            </li>
                                                                        @endforeach
                                                                    </ol>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ol>
                            </div>

                            <form id="delete-form" method="POST" style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#nestable').nestable({ maxDepth: 3, noDragClass: 'dd-nodrag' })
                .on('change', function() {
                    $.ajax({
                        url: '{{ route('menu.updateOrder') }}',
                        method: 'POST',
                        data: {
                            menu_structure: $('#nestable').nestable('serialize'),
                            _token: '{{ csrf_token() }}'
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to update order:', error);
                        }
                    });
                });
        });

        // Menu type toggle
        document.getElementById('menu_type').addEventListener('change', function() {
            document.querySelectorAll('.menu-section').forEach(el => el.style.display = 'none');
            document.getElementById('url-section').style.display = 'none';
            document.getElementById('group-hint').style.display = 'none';

            var type = this.value;
            var labelSection = document.getElementById('label-section');
            var labelInput   = document.getElementById('label');

            if (!type) { labelSection.style.display = 'none'; return; }

            labelSection.style.display = 'block';
            labelInput.value = '';

            var contentMap = { pages: 'pages-section', posts: 'posts-section', categories: 'categories-section' };
            if (contentMap[type]) document.getElementById(contentMap[type]).style.display = 'block';
            if (type === 'link')  document.getElementById('url-section').style.display = 'block';
            if (type === 'group') document.getElementById('group-hint').style.display = 'block';
        });

        // Auto-fill label/url on item selection
        var pagesData      = @json($pages->map(fn($p) => ['id' => $p->id, 'title' => $p->title, 'slug' => $p->slug]));
        var postsData      = @json($posts->map(fn($p) => ['id' => $p->id, 'title' => $p->title, 'slug' => $p->slug]));
        var categoriesData = @json($categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name, 'slug' => $c->slug]));

        document.querySelectorAll('input[name="selected_item"]').forEach(function(input) {
            input.addEventListener('change', function() {
                var type  = document.getElementById('menu_type').value;
                var id    = parseInt(this.value);
                var label = document.getElementById('label');

                if (type === 'pages') {
                    var item = pagesData.find(p => p.id === id);
                    if (item) label.value = item.title;
                    document.getElementById('page_id').value = id;
                    document.getElementById('page_id').name  = 'page_id';
                } else if (type === 'posts') {
                    var item = postsData.find(p => p.id === id);
                    if (item) label.value = item.title;
                    document.getElementById('post_id').value = id;
                    document.getElementById('post_id').name  = 'post_id';
                } else if (type === 'categories') {
                    var item = categoriesData.find(c => c.id === id);
                    if (item) label.value = item.name;
                    document.getElementById('category_id').value = id;
                    document.getElementById('category_id').name  = 'category_id';
                }
            });
        });

        // Search filter
        function filterItems(inputId, listId, itemClass) {
            var filter = document.getElementById(inputId).value.toLowerCase();
            document.querySelectorAll('#' + listId + ' .' + itemClass).forEach(function(item) {
                item.style.display = item.querySelector('label').textContent.toLowerCase().includes(filter) ? '' : 'none';
            });
        }
        document.getElementById('page-search').addEventListener('keyup', () => filterItems('page-search', 'pages-list', 'page-item'));
        document.getElementById('post-search').addEventListener('keyup', () => filterItems('post-search', 'posts-list', 'post-item'));
        document.getElementById('category-search').addEventListener('keyup', () => filterItems('category-search', 'categories-list', 'category-item'));

        // Delete confirmation
        function konfirmasiHapus(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(result => {
                if (result.isConfirmed) {
                    var form = document.getElementById('delete-form');
                    form.action = `/dashboard/menu-items/${id}`;
                    form.submit();
                }
            });
        }
    </script>
@endpush
