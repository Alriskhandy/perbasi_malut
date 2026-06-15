@extends('backend.layouts.main', ['title' => 'DPD Kab/Kota'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">Semua DPD Kab/Kota</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('districts.create') }}" class="btn btn-label-info btn-round me-2">
                        <i class="fa fa-plus"></i> Tambah DPD Kab/Kota
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
                                            <th>Nama</th>
                                            <th>Slug</th>
                                            <th>PIC</th>
                                            <th>Kontak</th>
                                            <th>Tim</th>
                                            <th>Wasit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($districts as $district)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($district->img_path)
                                                        <img src="{{ \App\Helpers\Media::url($district->img_path) }}" alt="{{ $district->name }}"
                                                            style="max-height: 45px; object-fit: cover;">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $district->name }}</strong>
                                                    @if ($district->district_name)
                                                        <br><small class="text-muted">{{ $district->district_name }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($district->slug)
                                                        <code class="text-muted small">{{ $district->slug }}</code>
                                                    @else
                                                        <span class="badge badge-warning">belum ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $district->pic ?? '-' }}
                                                    @if ($district->pic_position)
                                                        <br><small class="text-muted">{{ $district->pic_position }}</small>
                                                    @endif
                                                </td>
                                                <td>{{ $district->contact ?? '-' }}</td>
                                                <td><span class="badge badge-info">{{ $district->teams_count }}</span></td>
                                                <td><span class="badge badge-secondary">{{ $district->referees_count }}</span></td>
                                                <td>
                                                    <a href="{{ route('districts.edit', $district->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $district->id }}"
                                                        action="{{ route('districts.destroy', $district->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $district->id }})">
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
