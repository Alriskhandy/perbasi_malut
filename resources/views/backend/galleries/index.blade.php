@extends('backend.layouts.main', ['title' => 'Galleries'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">All Galleries</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('galleries.create') }}" class="btn btn-label-info btn-round me-2">
                        <i class="fa fa-plus"></i> Tambah Galeri
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
                                            <th>Image</th>
                                            <th>Name</th>
                                            {{-- <th>Order</th> --}}
                                            <th>Status</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleries as $gallery)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <!-- Menampilkan gambar -->
                                                <td>
                                                    @if ($gallery->image)
                                                        <img src="{{ $gallery->image }}" alt="{{ $gallery->name }}"
                                                            class="img-fluid" style="max-height: 50px;">
                                                    @else
                                                        <span>No Image</span>
                                                    @endif
                                                </td>

                                                <!-- Nama Galeri -->
                                                <td>
                                                    {{ $gallery->name }}
                                                </td>

                                                <!-- Order -->
                                                {{-- <td>{{ $gallery->order }}</td> --}}

                                                <!-- Status -->
                                                <td>
                                                    @if ($gallery->status === 'active')
                                                        <span
                                                            class="badge badge-success">{{ ucfirst($gallery->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger">{{ ucfirst($gallery->status) }}</span>
                                                    @endif
                                                </td>

                                                <!-- Tanggal Dibuat -->
                                                <td>{{ $gallery->created_at->format('d M Y') }}</td>

                                                <!-- Aksi -->
                                                <td>
                                                    <a href="{{ route('galleries.edit', $gallery->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <!-- Tombol Hapus dengan SweetAlert -->
                                                    <form id="delete-form-{{ $gallery->id }}"
                                                        action="{{ route('galleries.destroy', $gallery->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $gallery->id }})">
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
