@extends('backend.layouts.main', ['title' => 'Dashboard'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3 fs-3">Dashboard Setelah Update</h3>
                    <h6 class="op-7 mb-2">Welcome Back {{ Auth::user()->name }}</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    {{-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> --}}
                    {{-- <a href="#" class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Tambah User</a> --}}
                </div>
            </div>
            <div class="row"></div>
        </div>
    </div>
@endsection
