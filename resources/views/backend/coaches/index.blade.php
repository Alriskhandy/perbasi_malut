@extends('backend.layouts.main', ['title' => 'Pelatih'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">Semua Pelatih</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('coaches.create') }}" class="btn btn-label-info btn-round me-2">
                        <i class="fa fa-plus"></i> Tambah Pelatih
                    </a>
                </div>
            </div>

            <!-- Filter -->
            <form method="GET" action="{{ route('coaches.index') }}" class="row g-2 mb-3">
                <div class="col-md-3">
                    <select name="team_id" class="form-select form-select-sm">
                        <option value="">Semua Klub</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" {{ request('team_id') == $team->id ? 'selected' : '' }}>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="license" class="form-select form-select-sm">
                        <option value="">Semua Lisensi</option>
                        <option value="LEVEL A" {{ request('license') === 'LEVEL A' ? 'selected' : '' }}>Level A</option>
                        <option value="LEVEL B" {{ request('license') === 'LEVEL B' ? 'selected' : '' }}>Level B</option>
                        <option value="LEVEL C" {{ request('license') === 'LEVEL C' ? 'selected' : '' }}>Level C</option>
                        <option value="FIBA" {{ request('license') === 'FIBA' ? 'selected' : '' }}>FIBA</option>
                        <option value="Non-Lisensi" {{ request('license') === 'Non-Lisensi' ? 'selected' : '' }}>Non-Lisensi</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="registered"     {{ request('status') === 'registered'     ? 'selected' : '' }}>Registered</option>
                        <option value="not registered" {{ request('status') === 'not registered' ? 'selected' : '' }}>Not Registered</option>
                    </select>
                </div>
                <div class="col-auto d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    <a href="{{ route('coaches.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="bulk-form" action="{{ route('coaches.bulk_action') }}" method="POST">
                                @csrf
                                <div class="d-flex mb-3 gap-2">
                                    <select name="action" class="form-select" style="width:220px">
                                        <option value="" disabled selected>Pilih Tindakan Bulk</option>
                                        <option value="registered">Register</option>
                                        <option value="not_registered">Unregister</option>
                                        <option value="hapus">Hapus</option>
                                    </select>
                                    <button type="button" class="btn btn-primary btn-apply-bulk">Terapkan</button>
                                </div>
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover" style="white-space:nowrap">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="select-all-cb"></th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Klub</th>
                                                <th>Kontak</th>
                                                <th>Lisensi</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($coaches as $coach)
                                                <tr>
                                                    <td><input type="checkbox" name="selected_ids[]" value="{{ $coach->id }}"></td>
                                                    <td>
                                                        @if ($coach->img_path)
                                                            <img src="{{ \App\Helpers\Media::url($coach->img_path) }}" alt="{{ $coach->name }}"
                                                                style="max-height:45px;object-fit:cover;">
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $coach->name }}</td>
                                                    <td>{{ $coach->team->name ?? '-' }}</td>
                                                    <td>{{ $coach->contact ?? '-' }}</td>
                                                    <td>{{ $coach->license ?? 'Non-Lisensi' }}</td>
                                                    <td>
                                                        @if ($coach->status === 'registered')
                                                            <span class="badge badge-success">Registered</span>
                                                        @else
                                                            <span class="badge badge-danger">Not Registered</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('coaches.edit', $coach->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $coach->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                            @foreach ($coaches as $coach)
                                <form id="delete-form-{{ $coach->id }}"
                                    action="{{ route('coaches.destroy', $coach->id) }}"
                                    method="POST" style="display:none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('backend.partials._bulk_scripts', ['formId' => 'bulk-form', 'entity' => 'Pelatih'])
@endpush
