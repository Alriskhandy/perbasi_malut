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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
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
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($player->img_path)
                                                        <img src="{{ $player->img_path }}" alt="{{ $player->name }}"
                                                            style="max-height: 45px; object-fit: cover;">
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
                                                    <form id="delete-form-{{ $player->id }}"
                                                        action="{{ route('players.destroy', $player->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $player->id }})">
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
