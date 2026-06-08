@extends('backend.layouts.main', ['title' => 'Create Gallery'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3 fs-3">Create New Gallery</h3>
                </div>
            </div>

            <!-- Form Create -->
            <form id="formGallery" action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Main Form Section -->
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="permalink" class="form-label">Permalink *</label>
                                    <input type="text" class="form-control" id="permalink" name="slug" required
                                        readonly value="{{ old('slug') }}">
                                    <small class="form-text text-muted" id="permalink-preview">Preview:
                                        {{ url('galleries/' . old('slug')) }}</small>
                                </div>


                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured"
                                        {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Is featured?</label>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery Images Section -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mt-4">Gallery Images</h5>
                                <button type="button" class="btn btn-secondary mb-3" onclick="openFileManager()">Select
                                    Images</button>

                                <div id="imagePreviewContainer" class="d-flex gap-3 flex-wrap">
                                    <!-- Image previews will be here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Section -->
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5>Publish</h5>
                                <button type="submit" class="btn btn-primary w-100 mb-2">Save</button>
                                <a href="{{ route('galleries.index') }}" class="btn btn-secondary w-100">Cancel</a>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <div class="input-group">
                                <input type="hidden" name="image" id="fileUrl"
                                    class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}"
                                    readonly>
                                <button type="button" class="btn btn-secondary" onclick="openFileManager()">Pilih
                                    Gambar</button>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <img id="imagePreview"
                                src="{{ old('image') ? asset(old('image')) : asset('path/to/default-image.jpg') }}"
                                alt="Preview Gambar"
                                style="max-width: 100%; height: auto; display: {{ old('image') ? 'block' : 'none' }};">
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- Modal untuk menambah atau memperbarui deskripsi gambar -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Update Photo's Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="imagePath" />
                    <input type="text" class="form-control" id="imageDescription"
                        placeholder="Photo's description..." />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="updateDescription()">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .image-container {
            position: relative;
            display: inline-block;
        }

        .image-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            display: block;
            transition: opacity 0.3s ease;
        }

        .image-container:hover .edit-icon {
            display: block;
        }

        .edit-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        let selectedImageContainer;

        function openDescriptionModal(img) {
            selectedImageContainer = img.closest('.image-container');
            const selectedDescriptionInput = selectedImageContainer.querySelector('input[name$="[description]"]');
            document.getElementById("imageDescription").value = selectedDescriptionInput.value || "";

            const modal = new bootstrap.Modal(document.getElementById('descriptionModal'));
            modal.show();
        }

        function updateDescription() {
            const description = document.getElementById("imageDescription").value;
            const selectedDescriptionInput = selectedImageContainer.querySelector('input[name$="[description]"]');
            selectedDescriptionInput.value = description;

            const modal = bootstrap.Modal.getInstance(document.getElementById("descriptionModal"));
            modal.hide();
        }

        function openFileManager() {
            const route_prefix = "{{ url('files') }}";
            window.open(route_prefix + "?type=file", "FileManager", "width=800,height=600");
        }

        window.SetUrl = function(items) {
            const imageContainer = document.getElementById('imagePreviewContainer');
            let imageCount = imageContainer.children.length;

            items.forEach((item) => {
                let file_url = item.url;

                // Update gambar utama
                document.getElementById('fileUrl').value = file_url;
                document.getElementById('imagePreview').src = file_url;
                document.getElementById('imagePreview').style.display = 'block';

                // Preview gallery
                let imgContainer = document.createElement("div");
                imgContainer.classList.add("image-container");

                let inputImage = document.createElement('input');
                inputImage.type = 'hidden';
                inputImage.name = `gallery_images[${imageCount}][image]`;
                inputImage.value = file_url;
                imgContainer.appendChild(inputImage);

                let inputDesc = document.createElement('input');
                inputDesc.type = 'hidden';
                inputDesc.name = `gallery_images[${imageCount}][description]`;
                inputDesc.value = '';
                imgContainer.appendChild(inputDesc);

                let img = document.createElement("img");
                img.src = file_url;
                img.classList.add("img-thumbnail");

                imgContainer.onclick = () => openDescriptionModal(img);

                let editIcon = document.createElement("span");
                editIcon.classList.add("edit-icon");
                editIcon.innerHTML = '<i class="fa fa-edit"></i>';

                imgContainer.appendChild(img);
                imgContainer.appendChild(editIcon);
                imageContainer.appendChild(imgContainer);

                imageCount++;
            });
        };

        const domain = "{{ rtrim($app_url, '/') }}/galleries/";

        document.getElementById('name').addEventListener('input', function() {
            let name = this.value;
            let slug = name.toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/--+/g, '-');

            // Simpan slug ke input
            document.getElementById('permalink').value = slug;

            // Tampilkan preview full URL
            document.getElementById('permalink-preview').innerHTML = 'Preview: ' + domain + slug;
        });

        document.addEventListener('DOMContentLoaded', function() {
            let currentSlug = document.getElementById('permalink').value;
            if (currentSlug) {
                document.getElementById('permalink-preview').innerHTML = 'Preview: ' + domain + currentSlug;
            }
        });
    </script>
@endpush
