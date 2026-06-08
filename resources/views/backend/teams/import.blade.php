@extends('backend.layouts.main', ['title' => 'Import Data Klub'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3 fs-3">Import Data — {{ $team->name }}</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('dashboard') }}"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('teams.index') }}">Semua Klub</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Import</a></li>
                </ul>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Upload File Excel</h5>
                            <p class="text-muted small mb-4">
                                File harus berformat <strong>.xlsx</strong> dengan 3 sheet:
                                <code>DATA ATLET</code>, <code>DATA PELATIH</code>, dan <code>DATA OFFICIAL</code>.
                                Data lama tidak dihapus — data baru akan ditambahkan.
                            </p>

                            <div class="alert alert-info d-flex align-items-start gap-2 mb-4" role="alert">
                                <i class="fas fa-info-circle mt-1"></i>
                                <div>
                                    Belum punya template?
                                    <a href="{{ route('teams.import.template') }}" class="alert-link fw-semibold">
                                        Download template import (.zip)
                                    </a>
                                    kemudian isi data dan upload kembali.
                                </div>
                            </div>

                            <form action="{{ route('teams.import', $team->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4">
                                    <label for="file" class="form-label fw-semibold">
                                        File Excel <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" name="file" id="file"
                                        class="form-control @error('file') is-invalid @enderror"
                                        accept=".xlsx,.xls,.csv" required>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Maksimal 50 MB. Format: .xlsx atau .xls</div>
                                </div>

                                <div class="mb-3 p-3 bg-light rounded border">
                                    <p class="mb-2 fw-semibold small text-muted text-uppercase">Format kolom yang dibutuhkan</p>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <p class="mb-1 fw-semibold small">Sheet: <span class="text-danger">DATA ATLET</span></p>
                                            <ul class="list-unstyled small text-muted mb-0">
                                                <li><code>nama</code> <span class="text-danger">*</span></li>
                                                <li><code>jenis_kelamin</code> (L/P)</li>
                                                <li><code>tinggi_badan</code> (cm)</li>
                                                <li><code>berat_badan</code> (kg)</li>
                                                <li><code>posisi</code></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1 fw-semibold small">Sheet: <span class="text-danger">DATA PELATIH</span></p>
                                            <ul class="list-unstyled small text-muted mb-0">
                                                <li><code>nama</code> <span class="text-danger">*</span></li>
                                                <li><code>email</code></li>
                                                <li><code>kontak</code></li>
                                                <li><code>alamat</code></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1 fw-semibold small">Sheet: <span class="text-danger">DATA OFFICIAL</span></p>
                                            <ul class="list-unstyled small text-muted mb-0">
                                                <li><code>nama</code> <span class="text-danger">*</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-upload me-1"></i> Import Data
                                    </button>
                                    <a href="{{ route('teams.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
