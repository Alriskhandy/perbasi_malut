@extends('backend.layouts.main', ['title' => 'Dashboard'])
@push('css')
    <style>
        .storage-usage-info {
            display: none;
        }
    </style>
@endpush
@push('scripts')
@endpush
@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3 fs-3">Media</h3>
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
                        <a href="#">Media</a>
                    </li>
                    {{-- <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Basic Form</a>
                    </li> --}}
                </ul>
                </ul>
                <div class="ms-md-auto py-2 py-md-0">
                    {{-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> --}}
                    {{-- <a href="#" class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Tambah User</a> --}}
                </div>
            </div>
            <div class="row">
                {{-- Implementasi File Manager --}}
                <div class="col-md-12">
                    <iframe src="{{ url('cms-unkhair-filemanager?type=Files') }}"
                        style="width: 100%; height: 80vh; border: none; overflow: hidden;">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
