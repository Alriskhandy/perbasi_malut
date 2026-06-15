@extends('backend.layouts.main', ['title' => 'Klub'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">Semua Klub</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0 d-flex flex-wrap gap-2">
                    <a href="{{ route('teams.import.template') }}" class="btn btn-outline-secondary btn-round">
                        <i class="fa fa-download"></i> Download Template Import
                    </a>
                    <a href="{{ route('teams.create') }}" class="btn btn-label-info btn-round">
                        <i class="fa fa-plus"></i> Tambah Klub
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Logo</th>
                                            <th>Nama Klub</th>
                                            <th>Slug</th>
                                            <th>DPD</th>
                                            <th>Kontak</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teams as $team)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($team->img_path)
                                                        <img src="{{ \App\Helpers\Media::url($team->img_path) }}" alt="{{ $team->name }}"
                                                            style="max-height: 45px; object-fit: cover;">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $team->name }}</td>
                                                <td>
                                                    @if ($team->slug)
                                                        <code class="text-muted small">{{ $team->slug }}</code>
                                                    @else
                                                        <span class="badge badge-warning">belum ada</span>
                                                    @endif
                                                </td>
                                                <td>{{ $team->district->name ?? '-' }}</td>
                                                <td>{{ $team->contact ?? '-' }}</td>
                                                <td>
                                                    @if ($team->status === 'aktif')
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('teams.edit', $team->id) }}"
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('teams.import.form', $team->id) }}"
                                                        class="btn btn-info btn-sm" title="Import Data Excel" tooltip="Import Data Excel">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $team->id }}"
                                                        action="{{ route('teams.destroy', $team->id) }}"
                                                        method="POST" style="display:inline;" tooltip="Hapus Klub" title="Hapus">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $team->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
