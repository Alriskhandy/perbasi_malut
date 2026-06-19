@extends('backend.layouts.main', ['title' => 'Tambah Klub'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3 fs-3">Tambah Klub</h3>
                </div>
            </div>

            <form action="{{ route('teams.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header"><h6 class="mb-0">Data Klub</h6></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Klub *</label>
                                    <input type="text" name="name" id="teamName" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Slug URL
                                        <small class="text-muted">(opsional — otomatis dari nama jika dikosongkan)</small>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text text-muted">/klub/</span>
                                        <input type="text" name="slug" id="teamSlug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            value="{{ old('slug') }}"
                                            placeholder="contoh: pancasila-junior"
                                            pattern="[a-z0-9-]+"
                                            title="Hanya huruf kecil, angka, dan tanda hubung">
                                    </div>
                                    @error('slug') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">DPD *</label>
                                        <select name="district_id" class="form-select @error('district_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih DPD --</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('district_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Pendirian</label>
                                        <input type="date" name="founded_at" class="form-control @error('founded_at') is-invalid @enderror"
                                            value="{{ old('founded_at') }}">
                                        @error('founded_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kontak / Telepon</label>
                                        <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                            value="{{ old('contact') }}">
                                        @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address') }}</textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rekening Klub</label>
                                    <input type="text" name="bank_account" class="form-control @error('bank_account') is-invalid @enderror"
                                        value="{{ old('bank_account') }}" placeholder="Nama Bank, Nama Rekening, No Rekening">
                                    @error('bank_account') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header"><h6 class="mb-0">Penanggung Jawab</h6></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Penanggung Jawab</label>
                                    <input type="text" name="pic" class="form-control @error('pic') is-invalid @enderror"
                                        value="{{ old('pic') }}">
                                    @error('pic') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Status *</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-2">Simpan</button>
                                <a href="{{ route('teams.index') }}" class="btn btn-secondary w-100">Batal</a>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">Logo Klub</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="img_path" id="imgPath"
                                        class="form-control @error('img_path') is-invalid @enderror"
                                        value="{{ old('img_path') }}" placeholder="URL gambar" readonly>
                                    <button type="button" class="btn btn-secondary" onclick="openFileManager('img')">Pilih</button>
                                </div>
                                @error('img_path') <div class="text-danger small">{{ $message }}</div> @enderror
                                <img id="imgPreview" src="{{ old('img_path') }}"
                                    style="max-width:100%; display: {{ old('img_path') ? 'block' : 'none' }}; margin-top:8px;">
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">Foto Penanggung Jawab</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="pic_img_path" id="picImgPath"
                                        class="form-control @error('pic_img_path') is-invalid @enderror"
                                        value="{{ old('pic_img_path') }}" placeholder="URL gambar" readonly>
                                    <button type="button" class="btn btn-secondary" onclick="openFileManager('picImg')">Pilih</button>
                                </div>
                                @error('pic_img_path') <div class="text-danger small">{{ $message }}</div> @enderror
                                <img id="picImgPreview" src="{{ old('pic_img_path') }}"
                                    style="max-width:100%; display: {{ old('pic_img_path') ? 'block' : 'none' }}; margin-top:8px;">
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">SK Kemenkumham (.pdf)</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="sk_path" id="skPath"
                                        class="form-control @error('sk_path') is-invalid @enderror"
                                        value="{{ old('sk_path') }}" placeholder="URL file" readonly>
                                    <button type="button" class="btn btn-secondary" onclick="openFileManager('sk')">Pilih</button>
                                </div>
                                @error('sk_path') <div class="text-danger small">{{ $message }}</div> @enderror
                                <a id="skPreview" href="{{ old('sk_path') }}" target="_blank"
                                    style="display: {{ old('sk_path') ? 'inline' : 'none' }}; margin-top:8px;">Lihat File</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let currentFileTarget = null;
        function openFileManager(target) {
            currentFileTarget = target;
            const route_prefix = "{{ url('files') }}";
            window.open(route_prefix + "?type=file", "FileManager", "width=800,height=600");
        }
        window.SetUrl = function(items) {
            if (items.length > 0 && currentFileTarget) {
                const url = items[0].url;
                document.getElementById(currentFileTarget + 'Path').value = url;
                const preview = document.getElementById(currentFileTarget + 'Preview');
                if (preview.tagName === 'IMG') {
                    preview.src = url;
                    preview.style.display = 'block';
                } else {
                    preview.href = url;
                    preview.style.display = 'inline';
                }
            }
        };

        // Auto-preview slug from name (only when slug field is empty)
        const nameInput = document.getElementById('teamName');
        const slugInput = document.getElementById('teamSlug');
        let slugManuallyEdited = false;

        slugInput.addEventListener('input', function () {
            slugManuallyEdited = this.value.length > 0;
        });

        nameInput.addEventListener('input', function () {
            if (!slugManuallyEdited) {
                slugInput.placeholder = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-');
            }
        });
    </script>
@endpush
