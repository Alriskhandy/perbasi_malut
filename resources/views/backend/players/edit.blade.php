@extends('backend.layouts.main', ['title' => 'Edit Atlet'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3 fs-3">Edit Atlet</h3>
                </div>
            </div>

            <form action="{{ route('players.update', $player->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header"><h6 class="mb-0">Data Diri</h6></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Atlet *</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $player->name) }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Kelamin *</label>
                                        <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="L" {{ old('gender', $player->gender) == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                                            <option value="P" {{ old('gender', $player->gender) == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                                        </select>
                                        @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pendidikan</label>
                                        @include('backend.partials._education_select', ['selectedEducation' => $player->education])
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" name="birth_place" class="form-control @error('birth_place') is-invalid @enderror"
                                            value="{{ old('birth_place', $player->birth_place) }}">
                                        @error('birth_place') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror"
                                            value="{{ old('birth_date', $player->birth_date?->format('Y-m-d')) }}">
                                        @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $player->email) }}">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kontak / Telepon</label>
                                        <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                            value="{{ old('contact', $player->contact) }}">
                                        @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                @include('backend.partials._province_city_select')
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header"><h6 class="mb-0">Data Atlet</h6></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">ID Pemain</label>
                                        <input type="text" name="id_number" class="form-control @error('id_number') is-invalid @enderror"
                                            value="{{ old('id_number', $player->id_number) }}">
                                        @error('id_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Klub *</label>
                                        <select name="team_id" class="form-select @error('team_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Klub --</option>
                                            @foreach ($teams as $team)
                                                <option value="{{ $team->id }}"
                                                    {{ old('team_id', $player->team_id) == $team->id ? 'selected' : '' }}>
                                                    {{ $team->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('team_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Posisi</label>
                                        <select name="position" class="form-select @error('position') is-invalid @enderror">
                                            <option value="">-- Pilih Posisi --</option>
                                            <option value="Point Guard" {{ old('position', $player->position) == 'Point Guard' ? 'selected' : '' }}>Point Guard</option>
                                            <option value="Shooting Guard" {{ old('position', $player->position) == 'Shooting Guard' ? 'selected' : '' }}>Shooting Guard</option>
                                            <option value="Small Forward" {{ old('position', $player->position) == 'Small Forward' ? 'selected' : '' }}>Small Forward</option>
                                            <option value="Power Forward" {{ old('position', $player->position) == 'Power Forward' ? 'selected' : '' }}>Power Forward</option>
                                            <option value="Center" {{ old('position', $player->position) == 'Center' ? 'selected' : '' }}>Center</option>
                                        </select>
                                        @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Bergabung</label>
                                        <input type="date" name="joined_at" class="form-control @error('joined_at') is-invalid @enderror"
                                            value="{{ old('joined_at', $player->joined_at?->format('Y-m-d')) }}">
                                        @error('joined_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tinggi Badan (cm)</label>
                                        <input type="number" name="height" class="form-control @error('height') is-invalid @enderror"
                                            value="{{ old('height', $player->height) }}" min="100" max="250">
                                        @error('height') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Berat Badan (kg)</label>
                                        <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                                            value="{{ old('weight', $player->weight) }}" min="30" max="200">
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
                                        <option value="registered" {{ old('status', $player->status) == 'registered' ? 'selected' : '' }}>Registered</option>
                                        <option value="not registered" {{ old('status', $player->status) == 'not registered' ? 'selected' : '' }}>Not Registered</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-2">Perbarui</button>
                                <a href="{{ route('players.index') }}" class="btn btn-secondary w-100">Batal</a>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">Foto</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="img_path" id="imgPath"
                                        class="form-control @error('img_path') is-invalid @enderror"
                                        value="{{ old('img_path', $player->img_path) }}" placeholder="URL gambar" readonly>
                                    <button type="button" class="btn btn-secondary" onclick="openFileManager()">Pilih</button>
                                </div>
                                @error('img_path') <div class="text-danger small">{{ $message }}</div> @enderror
                                <img id="imgPreview" src="{{ \App\Helpers\Media::url(old('img_path', $player->img_path)) }}"
                                    style="max-width:100%; display: {{ $player->img_path ? 'block' : 'none' }}; margin-top:8px;">
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
    @include('backend.partials._province_city_scripts', ['selectedProvince' => $player->province, 'selectedCity' => $player->city])
@endpush
