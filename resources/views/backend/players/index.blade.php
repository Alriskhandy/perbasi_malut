@extends('backend.layouts.main', ['title' => 'Atlet'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">Semua Atlet</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('players.create') }}" class="btn btn-label-info btn-round me-2">
                        <i class="fa fa-plus"></i> Tambah Atlet
                    </a>
                </div>
            </div>

            <!-- Filter -->
            <form method="GET" action="{{ route('players.index') }}" class="row g-2 mb-3">
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
                    <select name="gender" class="form-select form-select-sm">
                        <option value="">Semua Gender</option>
                        <option value="L" {{ request('gender') === 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                        <option value="P" {{ request('gender') === 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-auto d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    <a href="{{ route('players.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- Bulk form: TIDAK boleh ada nested <form> di dalamnya --}}
                            <form id="bulk-form" action="{{ route('players.bulk_action') }}" method="POST">
                                @csrf
                                <div class="d-flex mb-3 gap-2">
                                    <select name="action" class="form-select" style="width:220px">
                                        <option value="" disabled selected>Pilih Tindakan Bulk</option>
                                        <option value="aktifkan">Aktifkan</option>
                                        <option value="nonaktifkan">Nonaktifkan</option>
                                        <option value="hapus">Hapus</option>
                                    </select>
                                    <button type="button" class="btn btn-primary btn-apply-bulk">Terapkan</button>
                                </div>
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="select-all-cb"></th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Tim</th>
                                                <th>Gender</th>
                                                <th>Posisi</th>
                                                <th>TB/BB</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($players as $player)
                                                <tr>
                                                    <td><input type="checkbox" name="selected_ids[]" value="{{ $player->id }}"></td>
                                                    <td>
                                                        @if ($player->img_path)
                                                            <img src="{{ \App\Helpers\Media::url($player->img_path) }}" alt="{{ $player->name }}"
                                                                style="max-height:45px;object-fit:cover;">
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $player->name }}</td>
                                                    <td>{{ $player->team->name ?? '-' }}</td>
                                                    <td>{{ $player->gender }}</td>
                                                    <td>{{ $player->position ?? '-' }}</td>
                                                    <td>
                                                        {{ $player->height ? $player->height . ' cm' : '-' }}
                                                        /
                                                        {{ $player->weight ? $player->weight . ' kg' : '-' }}
                                                    </td>
                                                    <td>
                                                        @if ($player->status === 'active')
                                                            <span class="badge badge-success">Aktif</span>
                                                        @else
                                                            <span class="badge badge-danger">Tidak Aktif</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('players.edit', $player->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        {{-- Tombol hapus individual — form-nya di luar bulk form --}}
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $player->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                            {{-- Form hapus individual ditempatkan di luar bulk form agar tidak nested --}}
                            @foreach ($players as $player)
                                <form id="delete-form-{{ $player->id }}"
                                    action="{{ route('players.destroy', $player->id) }}"
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
    @include('backend.partials._bulk_scripts', ['formId' => 'bulk-form', 'entity' => 'Atlet'])
@endpush
