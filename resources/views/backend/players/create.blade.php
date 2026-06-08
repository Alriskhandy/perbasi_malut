@extends('backend.layouts.main', ['title' => 'Tambah Atlet'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3 fs-3">Tambah Atlet</h3>
                </div>
            </div>

            <form action="{{ route('players.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Atlet *</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Klub *</label>
                                    <select name="team_id" class="form-select @error('team_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Klub --</option>
                                        @foreach ($teams as $team)
                                            <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                                                {{ $team->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('team_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Kelamin *</label>
                                        <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                                        </select>
                                        @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        
                                        <label class="form-label">Posisi *</label>
                                        <select name="position" class="form-select @error('position') is-invalid @enderror" required>
                                            <option value="">-- Pilih Posisi --</option>
                                            <option value="Point Guard" {{ old('position') == 'Point Guard' ? 'selected' : '' }}>Point Guard</option>
                                            <option value="Shooting Guard" {{ old('position') == 'Shooting Guard' ? 'selected' : '' }}>Shooting Guard</option>
                                            <option value="Small Forward" {{ old('position') == 'Small Forward' ? 'selected' : '' }}>Small Forward</option>
                                            <option value="Power Forward" {{ old('position') == 'Power Forward' ? 'selected' : '' }}>Power Forward</option>
                                            <option value="Center" {{ old('position') == 'Center' ? 'selected' : '' }}>Center</option>
                                        </select>
                                        @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tinggi Badan (cm)</label>
                                        <input type="number" name="height" class="form-control @error('height') is-invalid @enderror"
                                            value="{{ old('height') }}" min="100" max="250">
                                        @error('height') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Berat Badan (kg)</label>
                                        <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                                            value="{{ old('weight') }}" min="30" max="200">
                                        @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-2">Simpan</button>
                                <a href="{{ route('players.index') }}" class="btn btn-secondary w-100">Batal</a>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">Foto</label>
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
