@extends('backend.layouts.main', ['title' => 'Tambah Post'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">Add Post</h3>
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
                            <a href="{{ route('posts.index') }}">Posts</a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Add Post</a>
                        </li>
                    </ul>
                    </ul>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    {{-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> --}}
                    {{-- <a href="#" class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Tambah User</a> --}}
                </div>
            </div>
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" value="{{ old('title') }}" name="title" id="title"
                                        class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" id="slug-display" class="form-control"
                                            value="{{ old('slug') }}" readonly>
                                        <input type="hidden" name="slug" id="slug" required
                                            value="{{ old('slug') }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten</label>
                                    <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- gambar --}}
                        <div class="card">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar</label>
                                    <div class="input-group">
                                        <input type="hidden" name="image" id="fileUrl"
                                            class="form-control @error('image') is-invalid @enderror"
                                            value="{{ old('image') }}" readonly>
                                        <button type="button" class="btn btn-secondary" onclick="openFileManager()">Pilih
                                            Gambar</button>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Preview Gambar -->
                                <div class="mb-3">
                                    <img id="imagePreview" src="" alt="Preview Gambar"
                                        style="max-width: 100%; height: auto; display: none;">
                                </div>

                            </div>
                        </div>
                        {{-- category --}}
                        <div class="card">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" disabled selected>-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <!-- Ganti 'category' menjadi 'category_id' di sini -->
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        {{-- status --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="trashed" {{ old('status') == 'trashed' ? 'selected' : '' }}>Trashed
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- comments --}}
                        <div class="card">
                            <div class="card-body">
                                <label for="category" class="form-label">Comments</label>
                                <div class="mb-3">
                                    <small class="text-muted">Aktifkan untuk izinkan komentar</small>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="comments_is_active"
                                                id="commentsActive" value="1"
                                                {{ old('comments_is_active') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="commentsActive">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="comments_is_active"
                                                id="commentsInactive" value="0"
                                                {{ old('comments_is_active') == '0' ? 'checked' : '' }} checked>
                                            <label class="form-check-label" for="commentsInactive">
                                                Tidak Aktif
                                            </label>
                                        </div>
                                    </div>
                                    @error('comments_is_active')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Featured & Banner --}}
                        <div class="card">
                            <div class="card-body">
                                <label for="is_featured" class="form-label">Featured</label>
                                <div class="mb-3">
                                    <small class="text-muted">Tandai sebagai postingan utama</small>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="is_featured"
                                                id="featuredActive" value="1"
                                                {{ old('is_featured') == '1' ? 'checked' : '' }}
                                                {{ !$canBeFeatured ? 'disabled' : '' }}>
                                            <label class="form-check-label" for="featuredActive">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_featured"
                                                id="featuredInactive" value="0"
                                                {{ old('is_featured') == '0' ? 'checked' : '' }} checked>
                                            <label class="form-check-label" for="featuredInactive">
                                                Tidak Aktif
                                            </label>
                                        </div>
                                    </div>
                                    @if (!$canBeFeatured)
                                        <small class="text-muted">Jumlah featured post sudah mencapai batas maksimal
                                            (4).</small>
                                    @endif
                                    @error('is_featured')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <label for="is_banner" class="form-label">Banner</label>
                                <div class="mb-3">
                                    <small class="text-muted">Tandai sebagai banner website</small>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="is_banner"
                                                id="bannerActive" value="1"
                                                {{ old('is_banner') == '1' ? 'checked' : '' }}
                                                {{ !$canBeBanner ? 'disabled' : '' }}>
                                            <label class="form-check-label" for="bannerActive">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_banner"
                                                id="bannerInactive" value="0"
                                                {{ old('is_banner') == '0' ? 'checked' : '' }} checked>
                                            <label class="form-check-label" for="bannerInactive">
                                                Tidak Aktif
                                            </label>
                                        </div>
                                    </div>
                                    @if (!$canBeBanner)
                                        <small class="text-muted">Jumlah banner post sudah mencapai batas maksimal
                                            (3).</small>
                                    @endif
                                    @error('is_banner')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                    </div>
            </form>
        </div>
    </div>

    <!-- Sertakan skrip TinyMCE -->
    <script src="{{ asset('backend/tinymce/tinymce.min.js') }}"></script>
    <script>
        const baseURL = "{{ url('/') }}/";

        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter non-alphanumeric
                .trim() // Hapus spasi di awal/akhir
                .replace(/\s+/g, '-') // Ganti spasi dengan tanda hubung
                .replace(/-+/g, '-'); // Hapus tanda hubung ganda

            document.getElementById('slug-display').value = baseURL + 'posts/' + slug; // Tampilkan URL lengkap
            document.getElementById('slug').value = slug; // Simpan hanya slug
        });

        function openFileManager() {
            let route_prefix = "{{ url('cms-unkhair-filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');


        }

        window.SetUrl = function(items) {
            if (items.length > 0) {
                let file_url = items[0].url;
                document.getElementById('fileUrl').value = file_url;
                // Optionally, update a preview of the selected image
                // document.getElementById('filePreview').src = file_url;
                // Show the image preview
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = file_url;
                imagePreview.style.display = 'block';
            }
        };

        tinymce.init({
            selector: '#editor',
            height: 500,
            menubar: 'file edit view insert format tools table help',
            plugins: [
                'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | removeformat | table link image media | code fullscreen preview',
            toolbar_mode: 'sliding',
            content_css: [
                'https://www.tiny.cloud/css/codepen.min.css'
            ],
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    let route_prefix = "{{ url('cms-unkhair-filemanager') }}";
                    window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');
                    window.SetUrl = function(items) {
                        let file_url = items[0].url;
                        callback(file_url, {
                            alt: items[0].name
                        });
                    };
                }
            },
            setup: function(editor) {
                editor.on('NodeChange', function(e) {
                    // Periksa apakah elemen yang diubah adalah gambar
                    if (e.element && e.element.nodeName === 'IMG') {
                        e.element.style.maxWidth =
                            '100%'; // Batasi lebar maksimum gambar ke 100% kontainer
                        e.element.style.height = 'auto'; // Pastikan aspek rasio terjaga
                    }
                });

                editor.on('change', function() {
                    editor.save(); // Simpan perubahan konten editor ke textarea
                });
            }
        });
    </script>
@endsection
