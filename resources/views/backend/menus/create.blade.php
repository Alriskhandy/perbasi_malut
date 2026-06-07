@extends('backend.layouts.main')

@push('css')
    <style>
        /* General styling for Nestable items */
        .dd {
            max-width: 600px;
            margin: 20px auto;
        }

        /* Styling for each menu item handle */
        .dd-item>.dd-handle {
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

        /* Nested list visual hierarchy */
        .dd-list {
            padding-left: 20px;
            border-left: 2px solid #ddd;
            margin-top: 8px;
        }

        /* Remove any built-in expand/collapse buttons */
        .dd-item>button {
            display: none !important;
        }

        /* Special styling for the dragging element */
        .dd-dragel {
            position: absolute;
            pointer-events: none;
            z-index: 1000;
        }

        .dd-dragel .dd-handle {
            background-color: #e2e6ea;
            border-color: #ccc;
        }

        /* Card container for the menu */
        .card {
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 16px;
        }

        /* Button styling */
        .submit-btn {
            margin-top: 20px;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endpush

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3 fs-3">Menu Structure</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('dashboard') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Menu Structure</a>
                    </li>
                    {{-- <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Basic Form</a>
                    </li> --}}
                </ul>
                </ul>
                <div class="ms-md-auto py-2 py-md-0">
                    {{-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> --}}
                    {{-- <a href="#" class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Tambah User</a> --}}
                </div>
            </div>


            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Add Menu</h2>
                            <form action="{{ route('menus.store') }}" method="POST" class="p-4 border rounded">
                                @csrf
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary my-2">Add Menu</button>
                                <!-- Parent ID Field -->
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">Parent (optional)</label>
                                    <select name="parent_id" id="parent_id" class="form-select">
                                        <option value="" selected>-- Select Parent Menu --</option>
                                        @foreach ($menuItems as $item)
                                            <option value="{{ $item->id }}">{{ $item->label }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Menu Type Select -->
                                <div class="mb-3">
                                    <label for="menu_type" class="form-label">Select Menu Type</label>
                                    <select name="menu_type" id="menu_type" class="form-select">
                                        <option value="" selected>-- Select Menu Type --</option>
                                        <option value="pages">Pages</option>
                                        <option value="posts">Posts</option>
                                        <option value="categories">Categories</option>
                                        <option value="link">Link</option>
                                    </select>
                                </div>

                                <!-- Pages Section -->
                                <div class="mb-3" id="pages-section" style="display: none;">
                                    <label class="form-label">Pages</label>
                                    <input type="text" id="page-search" class="form-control mb-3"
                                        placeholder="Search Pages">
                                    <div class="border p-3" id="pages-list">
                                        @foreach ($pages as $page)
                                            <div class="form-check page-item">
                                                <input type="radio" class="form-check-input" name="selected_item"
                                                    value="{{ $page->id }}" id="page{{ $page->id }}">
                                                <input type="hidden" id="page_id">
                                                <label class="form-check-label"
                                                    for="page{{ $page->id }}">{{ $page->title }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Posts Section -->
                                <div class="mb-3" id="posts-section" style="display: none;">
                                    <label class="form-label">Posts</label>
                                    <input type="text" id="post-search" class="form-control mb-3"
                                        placeholder="Search Posts">
                                    <div class="border p-3" id="posts-list">
                                        @foreach ($posts as $post)
                                            <div class="form-check post-item">
                                                <input type="radio" class="form-check-input" name="selected_item"
                                                    value="{{ $post->id }}" id="post{{ $post->id }}">
                                                <input type="hidden" id="post_id">
                                                <label class="form-check-label"
                                                    for="post{{ $post->id }}">{{ $post->title }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Categories Section -->
                                <div class="mb-3" id="categories-section" style="display: none;">
                                    <label class="form-label">Categories</label>
                                    <input type="text" id="category-search" class="form-control mb-3"
                                        placeholder="Search Categories">
                                    <div class="border p-3" id="categories-list">
                                        @foreach ($categories as $category)
                                            <div class="form-check category-item">
                                                <input type="radio" class="form-check-input" name="selected_item"
                                                    value="{{ $category->id }}" id="category{{ $category->id }}">


                                                <input type="hidden" id="category_id">


                                                <label class="form-check-label"
                                                    for="category{{ $category->id }}">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Link Section (Auto-filled) -->
                                <div class="mb-3" id="link-section" style="display: none;">
                                    <label for="label" class="form-label">Link Label</label>
                                    <input type="text" name="label" id="label" class="form-control"
                                        maxlength="255" placeholder="Enter Link Label">
                                    @error('label')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3" id="url-section" style="display: none;">
                                    <label for="url" class="form-label">Link URL (optional)</label>
                                    <input type="text" name="url" id="url" class="form-control"
                                        maxlength="255" placeholder="Enter URL" value="#!">
                                    @error('url')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary my-2">Add Menu</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Struktur Menu</h2>
                            <!-- Nestable Menu Structure -->
                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    @foreach ($menus as $menu)
                                        @foreach ($menu->items as $item)
                                            <li class="dd-item" data-id="{{ $item->id }}">
                                                <div class="dd-handle d-flex justify-content-between align-items-center">
                                                    {{ $item->label }}
                                                    <button class="btn btn-secondary dd-nodrag" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $item->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse{{ $item->id }}">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>

                                                <!-- Accordion Collapse for Edit Form -->
                                                <div id="collapse{{ $item->id }}" class="collapse">
                                                    <div class="p-3 border mt-2">
                                                        <form id="edit-form-{{ $item->id }}"
                                                            action="/cms-unkhair/cp/menus/{{ $item->id }}/update"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')

                                                            <!-- label Field -->
                                                            <div class="form-group mb-2">
                                                                <label for="itemTitle{{ $item->id }}">
                                                                    Label</label>
                                                                <input type="text" class="form-control" name="label"
                                                                    id="itemTitle{{ $item->id }}"
                                                                    value="{{ $item->label }}" required>
                                                            </div>
                                                            <!-- label Field -->
                                                            <div class="form-group mb-2">
                                                                <label for="itemTitle{{ $item->id }}">
                                                                    Url</label>
                                                                <input type="text" class="form-control" name="url"
                                                                    id="itemTitle{{ $item->id }}"
                                                                    value="{{ $item->url }}">
                                                            </div>

                                                            {{-- <!-- Parent ID Field -->
                                                            <div class="mb-3">
                                                                <label for="parent_id" class="form-label">Parent
                                                                    (optional)
                                                                </label>
                                                                <select name="parent_id" id="parent_id" class="form-select">
                                                                    <option value=""
                                                                        {{ $item->parent_id == null ? 'selected' : '' }}>--
                                                                        Select Parent --</option>
                                                                    @foreach ($menuItems as $parentItem)
                                                                        @if ($parentItem->id != $item->id)
                                                                            <option value="{{ $parentItem->id }}"
                                                                                {{ $item->parent_id == $parentItem->id ? 'selected' : '' }}>
                                                                                {{ $parentItem->label }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('parent_id')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div> --}}


                                                            <!-- Page ID Field -->
                                                            <div class="mb-3">
                                                                <label for="page_id" class="form-label">Page
                                                                    (optional)
                                                                </label>
                                                                <select name="page_id" id="page_id"
                                                                    class="form-select">
                                                                    <option value="" selected>-- Select Page --
                                                                    </option>
                                                                    @foreach ($pages as $page)
                                                                        <option value="{{ $page->id }}"
                                                                            {{ $item->page_id == $page->id ? 'selected' : '' }}>
                                                                            {{ $page->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('page_id')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="d-flex">
                                                                <button type="submit" class="btn btn-sm btn-success">Save
                                                                    Changes</button>
                                                                <!-- Delete Button -->
                                                                <button type="button" class="btn btn-sm btn-danger ms-1"
                                                                    onclick="konfirmasiHapus('{{ $item->id }}')">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Check for children and render nested items -->
                                                @if ($item->children->isNotEmpty())
                                                    <ol class="dd-list">
                                                        @foreach ($item->children as $child)
                                                            <li class="dd-item" data-id="{{ $child->id }}">
                                                                <div
                                                                    class="dd-handle d-flex justify-content-between align-items-center">
                                                                    {{ $child->label }}
                                                                    <button class="btn btn-secondary dd-nodrag"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapse{{ $child->id }}"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapse{{ $child->id }}">
                                                                        <i class="fas fa-chevron-down"></i>
                                                                    </button>
                                                                </div>

                                                                <!-- Accordion Collapse for Child Edit Form -->
                                                                <div id="collapse{{ $child->id }}" class="collapse">
                                                                    <div class="p-3 border mt-2">
                                                                        <form id="edit-form-{{ $child->id }}"
                                                                            action="/cms-unkhair/cp/menus/{{ $child->id }}/update"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PATCH')

                                                                            <!-- label Field -->
                                                                            <div class="form-group mb-2">
                                                                                <label for="itemTitle{{ $child->id }}">
                                                                                    Label</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="label"
                                                                                    id="itemTitle{{ $child->id }}"
                                                                                    value="{{ $child->label }}" required>
                                                                            </div>
                                                                            <!-- label Field -->
                                                                            <div class="form-group mb-2">
                                                                                <label for="itemTitle{{ $child->id }}">
                                                                                    Url</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="url"
                                                                                    id="itemTitle{{ $child->id }}"
                                                                                    value="{{ $child->url }}">
                                                                            </div>



                                                                            <!-- Page ID Field -->
                                                                            <div class="mb-3">
                                                                                <label for="page_id"
                                                                                    class="form-label">Page
                                                                                    (optional)
                                                                                </label>
                                                                                <select name="page_id" id="page_id"
                                                                                    class="form-select">
                                                                                    <option value="" selected>--
                                                                                        Select Page --
                                                                                    </option>
                                                                                    @foreach ($pages as $page)
                                                                                        <option
                                                                                            value="{{ $page->id }}"
                                                                                            {{ $child->page_id == $page->id ? 'selected' : '' }}>
                                                                                            {{ $page->title }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('page_id')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="d-flex">
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-success">Save
                                                                                    Changes</button>
                                                                                <!-- Delete Button -->
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger ms-1"
                                                                                    onclick="konfirmasiHapus('{{ $child->id }}')">Delete</button>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>

                                                                <!-- Check for sub-children -->
                                                                @if ($child->children->isNotEmpty())
                                                                    <ol class="dd-list">
                                                                        @foreach ($child->children as $subchild)
                                                                            <li class="dd-item"
                                                                                data-id="{{ $subchild->id }}">
                                                                                <div
                                                                                    class="dd-handle d-flex justify-content-between align-items-center">
                                                                                    {{ $subchild->label }}
                                                                                    <button
                                                                                        class="btn btn-secondary dd-nodrag"
                                                                                        type="button"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#collapse{{ $subchild->id }}"
                                                                                        aria-expanded="false"
                                                                                        aria-controls="collapse{{ $subchild->id }}">
                                                                                        <i class="fas fa-chevron-down"></i>
                                                                                    </button>
                                                                                </div>

                                                                                <!-- Accordion Collapse for Subchild Edit Form -->
                                                                                <div id="collapse{{ $subchild->id }}"
                                                                                    class="collapse">
                                                                                    <div class="p-3 border mt-2">
                                                                                        <form
                                                                                            id="edit-form-{{ $subchild->id }}"
                                                                                            action="/cms-unkhair/cp/menus/{{ $subchild->id }}/update"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('PATCH')

                                                                                            <!-- label Field -->
                                                                                            <div class="form-group mb-2">
                                                                                                <label
                                                                                                    for="itemTitle{{ $subchild->id }}">
                                                                                                    Label</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="label"
                                                                                                    id="itemTitle{{ $subchild->id }}"
                                                                                                    value="{{ $subchild->label }}"
                                                                                                    required>
                                                                                            </div>
                                                                                            <!-- label Field -->
                                                                                            <div class="form-group mb-2">
                                                                                                <label
                                                                                                    for="itemTitle{{ $subchild->id }}">
                                                                                                    Url</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="url"
                                                                                                    id="itemTitle{{ $subchild->id }}"
                                                                                                    value="{{ $subchild->url }}">
                                                                                            </div>



                                                                                            <!-- Page ID Field -->
                                                                                            <div class="mb-3">
                                                                                                <label for="page_id"
                                                                                                    class="form-label">Page
                                                                                                    (optional)
                                                                                                </label>
                                                                                                <select name="page_id"
                                                                                                    id="page_id"
                                                                                                    class="form-select">
                                                                                                    <option value=""
                                                                                                        selected>--
                                                                                                        Select Page --
                                                                                                    </option>
                                                                                                    @foreach ($pages as $page)
                                                                                                        <option
                                                                                                            value="{{ $page->id }}"
                                                                                                            {{ $subchild->page_id == $page->id ? 'selected' : '' }}>
                                                                                                            {{ $page->title }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                                @error('page_id')
                                                                                                    <div class="text-danger">
                                                                                                        {{ $message }}
                                                                                                    </div>
                                                                                                @enderror
                                                                                            </div>

                                                                                            <div class="d-flex">
                                                                                                <button type="submit"
                                                                                                    class="btn btn-sm btn-success">Save
                                                                                                    Changes</button>
                                                                                                <!-- Delete Button -->
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-danger ms-1"
                                                                                                    onclick="konfirmasiHapus('{{ $subchild->id }}')">Delete</button>
                                                                                            </div>
                                                                                        </form>

                                                                                    </div>
                                                                                </div>
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

                                    <!-- Hidden Delete Form -->
                                    <form id="delete-form" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

            <!-- Hidden field to store serialized menu structure -->
            <textarea id="nestable-output" name="menu_structure" style="display: none;"></textarea>

        </div>
    </div>
@endsection

@push('scripts')
    <!-- Load jQuery and Nestable2 in correct order -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Nestable with maxDepth set to 3
            $('#nestable').nestable({
                maxDepth: 3, // Limit nesting depth to 3 levels
                noDragClass: 'dd-nodrag'
            }).on('change', function() {
                // Serialize the structure whenever it changes
                const serializedData = $('#nestable').nestable('serialize');

                // Send the serialized data to the server via AJAX
                $.ajax({
                    url: '{{ route('menu.updateOrder') }}',
                    method: 'POST',
                    data: {
                        menu_structure: serializedData,
                        _token: '{{ csrf_token() }}' // Add CSRF token for security
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.message);
                        } else {
                            console.error('Failed to update menu order.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred:', error);
                    }
                });
            });
        });
    </script>
    <!-- JavaScript untuk menghindari konflik drag -->
    <script>
        document.querySelectorAll('.dropdown').forEach(handle => {
            handle.addEventListener('mousedown', function(event) {
                event.stopPropagation(); // Menghentikan propagasi event untuk menghindari konflik
            });
        });
    </script>

    <!-- SweetAlert Confirmation Script -->
    <script>
        function konfirmasiHapus(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form');
                    form.action = `/cms-unkhair/cp/menu-items/${id}`; // Update with your route
                    form.submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Select all collapse elements
            const collapseElements = document.querySelectorAll('.collapse');

            // Add event listeners for each collapse element
            collapseElements.forEach(collapseElement => {
                // Change icon on show event
                collapseElement.addEventListener('show.bs.collapse', function() {
                    const toggleButton = document.querySelector(
                        `[data-bs-target="#${collapseElement.id}"] i`);
                    if (toggleButton) {
                        toggleButton.classList.remove('fa-chevron-down');
                        toggleButton.classList.add('fa-chevron-up');
                    }
                });

                // Change icon back on hide event
                collapseElement.addEventListener('hide.bs.collapse', function() {
                    const toggleButton = document.querySelector(
                        `[data-bs-target="#${collapseElement.id}"] i`);
                    if (toggleButton) {
                        toggleButton.classList.remove('fa-chevron-up');
                        toggleButton.classList.add('fa-chevron-down');
                    }
                });
            });
        });
    </script>

    <script>
        // Handle menu type selection
        document.getElementById('menu_type').addEventListener('change', function() {
            var type = this.value;

            // Hide all sections first
            document.getElementById('pages-section').style.display = 'none';
            document.getElementById('posts-section').style.display = 'none';
            document.getElementById('categories-section').style.display = 'none';
            document.getElementById('link-section').style.display = 'none';
            document.getElementById('url-section').style.display = 'none';

            // Show the selected section
            if (type === 'pages') {
                document.getElementById('pages-section').style.display = 'block';
            } else if (type === 'posts') {
                document.getElementById('posts-section').style.display = 'block';
            } else if (type === 'categories') {
                document.getElementById('categories-section').style.display = 'block';
            } else if (type === 'link') {
                document.getElementById('link-section').style.display = 'block';
                document.getElementById('url-section').style.display = 'block';
            }
        });

        // Handle item selection and auto-fill label and url
        document.querySelectorAll('input[name="selected_item"]').forEach(function(input) {
            input.addEventListener('change', function() {
                var selectedId = this.value;
                var selectedType = document.getElementById('menu_type').value;

                var labelField = document.getElementById('label');
                var urlField = document.getElementById('url');

                if (selectedType === 'pages') {
                    var pageIdField = document.getElementById('page_id'); // Correct the ID here
                    pageIdField.value = selectedId; // Update the hidden page_id field
                    pageIdField.name = 'page_id'; // Update the hidden pages_id field

                } else if (selectedType === 'posts') {
                    var postIdField = document.getElementById('post_id'); // Correct the ID here
                    postIdField.value = selectedId; // Update the hidden post_id field
                    postIdField.name = 'post_id'; // Update the hidden post_id field
                } else if (selectedType === 'categories') {
                    var categoryIdField = document.getElementById('category_id'); // Correct the ID here
                    categoryIdField.value = selectedId; // Update the hidden category_id field
                    categoryIdField.name = 'category_id'; // Update the hidden category_id field
                } else if (selectedType === 'link') {
                    labelField.value = ''; // Optionally reset the label
                    urlField.value = ''; // Reset the URL field, user will input their custom link
                }



                // Based on selected type, update label and url
                if (selectedType === 'pages') {

                    var page = @json($pages);
                    var selectedPage = page.find(item => item.id == selectedId);
                    labelField.value = selectedPage.title;
                    urlField.value = selectedPage.slug;
                } else if (selectedType === 'posts') {
                    var post = @json($posts);
                    var selectedPost = post.find(item => item.id == selectedId);
                    labelField.value = selectedPost.title;
                    urlField.value = selectedPost.slug;
                } else if (selectedType === 'categories') {
                    var category = @json($categories);
                    var selectedCategory = category.find(item => item.id == selectedId);
                    labelField.value = selectedCategory.name;
                    urlField.value = selectedCategory.slug;

                    console.log(selectedId);
                } else if (selectedType === 'link') {
                    labelField.value = ''; // Optionally reset the label
                    urlField.value = ''; // Reset the URL field, user will input their custom link
                }
            });
        });

        // Function for filtering list items based on search input
        function filterItems(inputId, listId, itemClass) {
            var input = document.getElementById(inputId);
            var filter = input.value.toLowerCase();
            var list = document.getElementById(listId);
            var items = list.getElementsByClassName(itemClass);

            for (var i = 0; i < items.length; i++) {
                var label = items[i].querySelector('label').textContent.toLowerCase();
                if (label.indexOf(filter) > -1) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        }

        // Add event listeners to search inputs
        document.getElementById('page-search').addEventListener('keyup', function() {
            filterItems('page-search', 'pages-list', 'page-item');
        });

        document.getElementById('post-search').addEventListener('keyup', function() {
            filterItems('post-search', 'posts-list', 'post-item');
        });

        document.getElementById('category-search').addEventListener('keyup', function() {
            filterItems('category-search', 'categories-list', 'category-item');
        });
    </script>

    <script>
        document.querySelectorAll('input[name="type[]"]').forEach(function(input) {
            input.addEventListener('change', function() {
                var type = this.value;
                var dynamicSelect = document.getElementById('dynamic-select');
                dynamicSelect.innerHTML = ''; // Kosongkan konten sebelumnya

                // Menampilkan collapse untuk Pages jika checkbox 'page' dipilih
                if (document.getElementById('page').checked) {
                    var pageCollapse = document.createElement('div');
                    pageCollapse.classList.add('collapse');
                    pageCollapse.id = 'pageCollapse';

                    var pageTitle = document.createElement('h5');
                    pageTitle.textContent = 'Select Pages';
                    pageCollapse.appendChild(pageTitle);

                    var pageList = document.createElement('ul');
                    @foreach ($pages as $page)
                        var pageItem = document.createElement('li');
                        var pageCheckbox = document.createElement('input');
                        pageCheckbox.type = 'checkbox';
                        pageCheckbox.name = 'page_ids[]'; // Menggunakan array untuk multiple selection
                        pageCheckbox.value = '{{ $page->id }}';
                        pageCheckbox.id = 'pageOption{{ $page->id }}';

                        var pageLabel = document.createElement('label');
                        pageLabel.setAttribute('for', 'pageOption{{ $page->id }}');
                        pageLabel.textContent = '{{ $page->title }}';

                        pageItem.appendChild(pageCheckbox);
                        pageItem.appendChild(pageLabel);
                        pageList.appendChild(pageItem);
                    @endforeach

                    pageCollapse.appendChild(pageList);
                    dynamicSelect.appendChild(pageCollapse);
                }

                // Menampilkan collapse untuk Posts jika checkbox 'post' dipilih
                if (document.getElementById('post').checked) {
                    var postCollapse = document.createElement('div');
                    postCollapse.classList.add('collapse');
                    postCollapse.id = 'postCollapse';

                    var postTitle = document.createElement('h5');
                    postTitle.textContent = 'Select Posts';
                    postCollapse.appendChild(postTitle);

                    var postList = document.createElement('ul');
                    @foreach ($posts as $post)
                        var postItem = document.createElement('li');
                        var postCheckbox = document.createElement('input');
                        postCheckbox.type = 'checkbox';
                        postCheckbox.name = 'post_ids[]'; // Menggunakan array untuk multiple selection
                        postCheckbox.value = '{{ $post->id }}';
                        postCheckbox.id = 'postOption{{ $post->id }}';

                        var postLabel = document.createElement('label');
                        postLabel.setAttribute('for', 'postOption{{ $post->id }}');
                        postLabel.textContent = '{{ $post->title }}';

                        postItem.appendChild(postCheckbox);
                        postItem.appendChild(postLabel);
                        postList.appendChild(postItem);
                    @endforeach

                    postCollapse.appendChild(postList);
                    dynamicSelect.appendChild(postCollapse);
                }

                // Menampilkan collapse untuk Categories jika checkbox 'category' dipilih
                if (document.getElementById('category').checked) {
                    var categoryCollapse = document.createElement('div');
                    categoryCollapse.classList.add('collapse');
                    categoryCollapse.id = 'categoryCollapse';

                    var categoryTitle = document.createElement('h5');
                    categoryTitle.textContent = 'Select Categories';
                    categoryCollapse.appendChild(categoryTitle);

                    var categoryList = document.createElement('ul');
                    @foreach ($categories as $category)
                        var categoryItem = document.createElement('li');
                        var categoryCheckbox = document.createElement('input');
                        categoryCheckbox.type = 'checkbox';
                        categoryCheckbox.name =
                            'category_ids[]'; // Menggunakan array untuk multiple selection
                        categoryCheckbox.value = '{{ $category->id }}';
                        categoryCheckbox.id = 'categoryOption{{ $category->id }}';

                        var categoryLabel = document.createElement('label');
                        categoryLabel.setAttribute('for', 'categoryOption{{ $category->id }}');
                        categoryLabel.textContent = '{{ $category->name }}';

                        categoryItem.appendChild(categoryCheckbox);
                        categoryItem.appendChild(categoryLabel);
                        categoryList.appendChild(categoryItem);
                    @endforeach

                    categoryCollapse.appendChild(categoryList);
                    dynamicSelect.appendChild(categoryCollapse);
                }
            });
        });
    </script>
@endpush
