@extends('backend.layouts.main', ['title' => 'Edit Post'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">Edit Post</h3>
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
                            <a href="#">Edit Post</a>
                        </li>
                    </ul>
                    </ul>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    {{-- Jika perlu, Anda bisa menambahkan tombol atau link lain di sini --}}
                </div>
            </div>
            <form method="POST" action="{{ route('posts.update', $post->slug) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Tambahkan metode PUT untuk pembaruan -->
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" value="{{ old('title', $post->title) }}" name="title"
                                        id="title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" id="slug-display" class="form-control"
                                            value="{{ old('slug', $post->slug) }}" readonly>
                                        <input type="hidden" name="slug" id="slug" required
                                            value="{{ old('slug', $post->slug) }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten</label>
                                    <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content', $post->content) }}</textarea>
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
                                            value="{{ old('image', $post->image) }}" readonly>
                                        <button type="button" class="btn btn-secondary" onclick="openFileManager()">Pilih
                                            Gambar</button>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Preview Gambar -->
                                <div class="mb-3">
                                    <img id="imagePreview"
                                        src="{{ asset(old('image', $post->image) ?: 'path/to/default-image.jpg') }}"
                                        alt="Preview Gambar"
                                        style="max-width: 100%; height: auto; display: {{ old('image', $post->image) ? 'block' : 'none' }};">
                                </div>

                            </div>
                        </div>
                        {{-- category --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category_id" id="category" class="form-control" required>
                                        <option value="" disabled selected>-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category', $post->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
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
                                        @php
                                            $statuses = [
                                                \App\Enums\PostStatus::Published->value => 'Published',
                                                \App\Enums\PostStatus::Trashed->value => 'Trashed',
                                                \App\Enums\PostStatus::Draft->value => 'Draft',
                                            ];
                                        @endphp

                                        @foreach ($statuses as $enumValue => $label)
                                            <option value="{{ $enumValue }}"
                                                {{ $post->status->value === $enumValue ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- comments --}}
                        <div class="card">
                            <div class="card-body">
                                <label for="comments_is_active" class="form-label">Comments</label>
                                <div class="mb-3">
                                    <small class="text-muted">Aktifkan untuk izinkan komentar</small>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="comments_is_active"
                                                id="commentsActive" value="1"
                                                {{ old('comments_is_active', $post->comments_is_active) == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="commentsActive">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="comments_is_active"
                                                id="commentsInactive" value="0"
                                                {{ old('comments_is_active', $post->comments_is_active) == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="commentsInactive">Tidak Aktif</label>
                                        </div>
                                    </div>
                                    @error('comments_is_active')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Featured Post --}}
                        <div class="card">
                            <div class="card-body">
                                <label for="is_featured" class="form-label">Featured Post</label>
                                <div class="mb-3">
                                    <small class="text-muted">Tandai sebagai postingan utama</small>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="is_featured"
                                                id="isFeatured" value="1"
                                                {{ old('is_featured', $post->is_featured) == '1' ? 'checked' : '' }}
                                                {{ !$canBeFeatured ? 'disabled' : '' }}>
                                            <label class="form-check-label" for="isFeatured">
                                                Featured
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_featured"
                                                id="isNotFeatured" value="0"
                                                {{ old('is_featured', $post->is_featured) == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isNotFeatured">
                                                Not Featured
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

                        {{-- Banner Post --}}
                        <div class="card">
                            <div class="card-body">
                                <label for="is_banner" class="form-label">Banner Post</label>
                                <div class="mb-3">
                                    <small class="text-muted">Tandai sebagai banner website</small>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="is_banner"
                                                id="isBanner" value="1"
                                                {{ old('is_banner', $post->is_banner) == '1' ? 'checked' : '' }}
                                                {{ !$canBeBanner ? 'disabled' : '' }}>
                                            <label class="form-check-label" for="isBanner">
                                                Banner
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_banner"
                                                id="isNotBanner" value="0"
                                                {{ old('is_banner', $post->is_banner) == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isNotBanner">
                                                Not Banner
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
                // Tampilkan preview gambar
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
                console.log(meta.filetype);

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
                if (meta.filetype === 'media') {
                    let route_prefix = "{{ url('cms-unkhair-filemanager') }}";
                    window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');
                    window.SetUrl = function(items) {
                        let file_url = items[0].url;
                        callback(file_url, {
                            alt: items[0].name
                        });
                    };
                }
                if (meta.filetype === 'file') {
                    let route_prefix = "{{ url('cms-unkhair-filemanager') }}";
                    window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');
                    window.SetUrl = function(items) {
                        // Memeriksa apakah ada file yang dipilih
                        if (items.length > 0) {
                            let file_url = items[0].url; // URL dari file yang dipilih

                            // Memastikan file yang dipilih adalah PDF
                            if (file_url.endsWith('.pdf')) {
                                callback(file_url, {
                                    alt: items[0].name
                                });
                            } else {
                                alert('Silakan pilih file PDF.');
                            }
                        }
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

        function openFileManager() {
            let route_prefix = "{{ url('cms-unkhair-filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');
        }

        window.SetUrl = function(items) {
            if (items.length > 0) {
                let file_url = items[0].url;
                document.getElementById('fileUrl').value = file_url;

                // Update preview image
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = file_url;
                imagePreview.style.display = 'block';
            } else {
                // If no image selected, reset preview
                document.getElementById('fileUrl').value = '';
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = '';
                imagePreview.style.display = 'none';
            }
        };
    </script>
@endsection
