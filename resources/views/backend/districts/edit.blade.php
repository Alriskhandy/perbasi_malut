@extends('backend.layouts.main', ['title' => 'Edit Distrik'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3 fs-3">Edit DPD Kab / Kota</h3>
                </div>
            </div>

            <form action="{{ route('districts.update', $district->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama DPD Kab / Kota *</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $district->name) }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Slug URL
                                        <small class="text-muted">(digunakan di URL publik /dpd/{slug})</small>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text text-muted">/dpd/</span>
                                        <input type="text" name="slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            value="{{ old('slug', $district->slug) }}"
                                            pattern="[a-z0-9-]+"
                                            title="Hanya huruf kecil, angka, dan tanda hubung">
                                    </div>
                                    @error('slug') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    <div class="form-text text-warning">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        Mengubah slug akan memutus tautan lama ke halaman DPD ini.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kabupaten / Kota</label>
                                    <select name="district_name" class="form-select @error('district_name') is-invalid @enderror">
                                        <option value="">-- Pilih Kabupaten / Kota --</option>
                                        @foreach ([
                                            'Kota Ternate',
                                            'Kota Tidore Kepulauan',
                                            'Kabupaten Halmahera Utara',
                                            'Kabupaten Halmahera Selatan',
                                            'Kabupaten Halmahera Barat',
                                            'Kabupaten Halmahera Timur',
                                            'Kabupaten Halmahera Tengah',
                                            'Kabupaten Kepulauan Sula',
                                            'Kabupaten Pulau Taliabu',
                                            'Kabupaten Pulau Morotai',
                                        ] as $kab)
                                            <option value="{{ $kab }}"
                                                {{ old('district_name', $district->district_name) == $kab ? 'selected' : '' }}>
                                                {{ $kab }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('district_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Penanggung Jawab</label>
                                        <input type="text" name="pic" class="form-control @error('pic') is-invalid @enderror"
                                            value="{{ old('pic', $district->pic) }}">
                                        @error('pic') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jabatan PJ</label>
                                        <input type="text" name="pic_position" class="form-control @error('pic_position') is-invalid @enderror"
                                            value="{{ old('pic_position', $district->pic_position) }}" placeholder="Contoh: Ketua Perbasi">
                                        @error('pic_position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $district->email) }}">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kontak / Telepon</label>
                                        <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                            value="{{ old('contact', $district->contact) }}">
                                        @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $district->address) }}</textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">URL Website</label>
                                    <input type="url" name="web_url" class="form-control @error('web_url') is-invalid @enderror"
                                        value="{{ old('web_url', $district->web_url) }}" placeholder="https://...">
                                    @error('web_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100 mb-2">Perbarui</button>
                                <a href="{{ route('districts.index') }}" class="btn btn-secondary w-100">Batal</a>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">Logo / Foto</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="img_path" id="imgPath"
                                        class="form-control @error('img_path') is-invalid @enderror"
                                        value="{{ old('img_path', $district->img_path) }}" placeholder="URL gambar" readonly>
                                    <button type="button" class="btn btn-secondary" onclick="openFileManager('img')">Pilih</button>
                                </div>
                                @error('img_path') <div class="text-danger small">{{ $message }}</div> @enderror
                                <img id="imgPreview" src="{{ \App\Helpers\Media::url(old('img_path', $district->img_path)) }}"
                                    style="max-width:100%; display: {{ $district->img_path ? 'block' : 'none' }}; margin-top:8px;">
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">Foto Penanggung Jawab</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="pic_img_path" id="picImgPath"
                                        class="form-control @error('pic_img_path') is-invalid @enderror"
                                        value="{{ old('pic_img_path', $district->pic_img_path) }}" placeholder="URL gambar" readonly>
                                    <button type="button" class="btn btn-secondary" onclick="openFileManager('picImg')">Pilih</button>
                                </div>
                                @error('pic_img_path') <div class="text-danger small">{{ $message }}</div> @enderror
                                <img id="picImgPreview" src="{{ \App\Helpers\Media::url(old('pic_img_path', $district->pic_img_path)) }}"
                                    style="max-width:100%; display: {{ $district->pic_img_path ? 'block' : 'none' }}; margin-top:8px;">
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">SK Kemenkumham (.pdf)</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="sk_path" id="skPath"
                                        class="form-control @error('sk_path') is-invalid @enderror"
                                        value="{{ old('sk_path', $district->sk_path) }}" placeholder="URL file" readonly>
                                    <button type="button" class="btn btn-secondary" onclick="openFileManager('sk')">Pilih</button>
                                </div>
                                @error('sk_path') <div class="text-danger small">{{ $message }}</div> @enderror
                                <a id="skPreview" href="{{ \App\Helpers\Media::url(old('sk_path', $district->sk_path)) }}" target="_blank"
                                    style="display: {{ $district->sk_path ? 'inline' : 'none' }}; margin-top:8px;">Lihat File</a>
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
    </script>
@endpush
