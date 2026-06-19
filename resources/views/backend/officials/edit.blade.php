@extends('backend.layouts.main', ['title' => 'Edit Official'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3 fs-3">Edit Official</h3>
                </div>
            </div>

            <form action="{{ route('officials.update', $official->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header"><h6 class="mb-0">Data Diri</h6></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Official *</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $official->name) }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pendidikan</label>
                                        @include('backend.partials._education_select', ['selectedEducation' => old('education', $official->education ?? '')])
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $official->email) }}">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kontak / Telepon</label>
                                        <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                            value="{{ old('contact', $official->contact) }}">
                                        @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
                                            value="{{ old('position', $official->position) }}">
                                        @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header"><h6 class="mb-0">Data Official</h6></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Klub *</label>
                                        <select name="team_id" class="form-select @error('team_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Klub --</option>
                                            @foreach ($teams as $team)
                                                <option value="{{ $team->id }}"
                                                    {{ old('team_id', $official->team_id) == $team->id ? 'selected' : '' }}>
                                                    {{ $team->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('team_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Bergabung</label>
                                        <input type="date" name="joined_at" class="form-control @error('joined_at') is-invalid @enderror"
                                            value="{{ old('joined_at', $official->joined_at?->format('Y-m-d')) }}">
                                        @error('joined_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
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
                                        <option value="registered" {{ old('status', $official->status) == 'registered' ? 'selected' : '' }}>Registered</option>
                                        <option value="not registered" {{ old('status', $official->status) == 'not registered' ? 'selected' : '' }}>Not Registered</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-2">Perbarui</button>
                                <a href="{{ route('officials.index') }}" class="btn btn-secondary w-100">Batal</a>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">Foto</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="img_path" id="imgPath"
                                        class="form-control @error('img_path') is-invalid @enderror"
                                        value="{{ old('img_path', $official->img_path) }}" placeholder="URL gambar" readonly>
                                    <button type="button" class="btn btn-secondary" onclick="openFileManager()">Pilih</button>
                                </div>
                                @error('img_path') <div class="text-danger small">{{ $message }}</div> @enderror
                                <img id="imgPreview" src="{{ \App\Helpers\Media::url(old('img_path', $official->img_path)) }}"
                                    style="max-width:100%; display: {{ $official->img_path ? 'block' : 'none' }}; margin-top:8px;">
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
            const route_prefix = "{{ url('files') }}";
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
