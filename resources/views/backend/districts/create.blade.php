@extends('backend.layouts.main', ['title' => 'Tambah Distrik'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3 fs-3">Tambah DPD Kab / Kota</h3>
                </div>
            </div>

            <form action="{{ route('districts.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama DPD Kab / Kota *</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kabupaten / Kota *</label>
                                    <select name="district_name" class="form-select @error('district_name') is-invalid @enderror" required>
                                        <option value="">-- Pilih Kabupaten / Kota --</option>
                                        <option value="Kota Ternate" {{ old('district_name') == 'Kota Ternate' ? 'selected' : '' }}>Kota Ternate</option>
                                        <option value="Kota Tidore Kepulauan" {{ old('district_name') == 'Kota Tidore Kepulauan' ? 'selected' : '' }}>Kota Tidore Kepulauan</option>
                                        <option value="Kabupaten Halmahera Utara" {{ old('district_name') == 'Kabupaten Halmahera Utara' ? 'selected' : '' }}>Kabupaten Halmahera Utara</option>
                                        <option value="Kabupaten Halmahera Selatan" {{ old('district_name') == 'Kabupaten Halmahera Selatan' ? 'selected' : '' }}>Kabupaten Halmahera Selatan</option>
                                        <option value="Kabupaten Halmahera Barat" {{ old('district_name') == 'Kabupaten Halmahera Barat' ? 'selected' : '' }}>Kabupaten Halmahera Barat</option>
                                        <option value="Kabupaten Halmahera Timur" {{ old('district_name') == 'Kabupaten Halmahera Timur' ? 'selected' : '' }}>Kabupaten Halmahera Timur</option>
                                        <option value="Kabupaten Halmahera Tengah" {{ old('district_name') == 'Kabupaten Halmahera Tengah' ? 'selected' : '' }}>Kabupaten Halmahera Tengah</option>
                                        <option value="Kabupaten Kepulauan Sula" {{ old('district_name') == 'Kabupaten Kepulauan Sula' ? 'selected' : '' }}>Kabupaten Kepulauan Sula</option>
                                        <option value="Kabupaten Pulau Taliabu" {{ old('district_name') == 'Kabupaten Pulau Taliabu' ? 'selected' : '' }}>Kabupaten Pulau Taliabu</option>
                                        <option value="Kabupaten Pulau Morotai" {{ old('district_name') == 'Kabupaten Pulau Morotai' ? 'selected' : '' }}>Kabupaten Pulau Morotai</option>
                                    </select>
                                    @error('district_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Penanggung Jawab</label>
                                        <input type="text" name="pic" class="form-control @error('pic') is-invalid @enderror"
                                            value="{{ old('pic') }}">
                                        @error('pic') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jabatan PJ</label>
                                        <input type="text" name="pic_position" class="form-control @error('pic_position') is-invalid @enderror"
                                            value="{{ old('pic_position') }}" placeholder="Contoh: Ketua Perbasi">
                                        @error('pic_position') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address') }}</textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">URL Website</label>
                                    <input type="url" name="web_url" class="form-control @error('web_url') is-invalid @enderror"
                                        value="{{ old('web_url') }}" placeholder="https://...">
                                    @error('web_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100 mb-2">Simpan</button>
                                <a href="{{ route('districts.index') }}" class="btn btn-secondary w-100">Batal</a>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">Logo / Foto</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="img_path" id="imgPath"
                                        class="form-control @error('img_path') is-invalid @enderror"
                                        value="{{ old('img_path') }}" placeholder="URL gambar" readonly>
                                    <button type="button" class="btn btn-secondary" onclick="openFileManager()">Pilih</button>
                                </div>
                                @error('img_path') <div class="text-danger small">{{ $message }}</div> @enderror
                                <img id="imgPreview" src="{{ old('img_path') }}"
                                    style="max-width:100%; display: {{ old('img_path') ? 'block' : 'none' }}; margin-top:8px;">
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
        function openFileManager() {
            const route_prefix = "{{ url('cms-unkhair-filemanager') }}";
            window.open(route_prefix + "?type=file", "FileManager", "width=800,height=600");
        }

        window.SetUrl = function(items) {
            if (items.length > 0) {
                const url = items[0].url;
                document.getElementById('imgPath').value = url;
                const preview = document.getElementById('imgPreview');
                preview.src = url;
                preview.style.display = 'block';
            }
        };
    </script>
@endpush
