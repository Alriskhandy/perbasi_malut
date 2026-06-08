@extends('backend.layouts.main', ['title' => 'Wasit'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">Semua Wasit</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('referees.create') }}" class="btn btn-label-info btn-round me-2">
                        <i class="fa fa-plus"></i> Tambah Wasit
                    </a>
                </div>
            </div>

            <!-- Filter -->
            <form method="GET" action="{{ route('referees.index') }}" class="row g-2 mb-3">
                <div class="col-md-3">
                    <select name="district_id" class="form-select form-select-sm">
                        <option value="">Semua Kab/Kota</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    <a href="{{ route('referees.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="bulk-form" action="{{ route('referees.bulk_action') }}" method="POST">
                                @csrf
                                <div class="d-flex mb-3 gap-2">
                                    <select name="action" class="form-select" style="width:220px">
                                        <option value="" disabled selected>Pilih Tindakan Bulk</option>
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
                                                <th>Kab / Kota</th>
                                                <th>Tanggal Ditambahkan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($referees as $referee)
                                                <tr>
                                                    <td><input type="checkbox" name="selected_ids[]" value="{{ $referee->id }}"></td>
                                                    <td>
                                                        @if ($referee->img_path)
                                                            <img src="{{ $referee->img_path }}" alt="{{ $referee->name }}"
                                                                style="max-height:45px;object-fit:cover;">
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $referee->name }}</td>
                                                    <td>{{ $referee->district->name ?? '-' }}</td>
                                                    <td>{{ $referee->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('referees.edit', $referee->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $referee->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                            @foreach ($referees as $referee)
                                <form id="delete-form-{{ $referee->id }}"
                                    action="{{ route('referees.destroy', $referee->id) }}"
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
    @include('backend.partials._bulk_scripts', ['formId' => 'bulk-form', 'entity' => 'Wasit'])
@endpush
