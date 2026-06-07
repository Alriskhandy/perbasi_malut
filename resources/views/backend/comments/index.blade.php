@extends('backend.layouts.main', ['title' => 'Comments'])
@push('css')
    <style>
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
@endpush
@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">All Comments</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{ route('dashboard') }}">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">All Comments</a>
                        </li>
                    </ul>
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
                                            <th>Comments</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Dikirim Pada</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $comment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($comment->read == 0)
                                                        <span class="dot bg-primary me-2"></span>
                                                    @endif
                                                    {{ $comment->post->title }}
                                                </td>

                                                <td>{{ $comment->name }}</td>
                                                <td>{{ $comment->email }}</td>
                                                <td>
                                                    @if ($comment->status === 'pending')
                                                        <span
                                                            class="badge badge-warning">{{ ucfirst($comment->status) }}</span>
                                                    @elseif ($comment->status === 'approved')
                                                        <span
                                                            class="badge badge-success">{{ ucfirst($comment->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger">{{ ucfirst($comment->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $comment->created_at->format('d M Y') }}</td>
                                                <td class="d-flex flex-wrap gap-2">
                                                    <a href="{{ route('comments.edit', $comment->id) }}"
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $comment->id }})" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <!-- Form Hapus -->
                                                    <form id="delete-form-{{ $comment->id }}"
                                                        action="{{ route('comments.destroy', $comment->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify.js/0.4.2/notify.min.js"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        function copyComment(content) {
            navigator.clipboard.writeText(content).then(function() {
                alert("Komentar telah disalin ke clipboard!");
            }, function(err) {
                alert("Gagal menyalin komentar: ", err);
            });
        }
    </script>
@endpush
