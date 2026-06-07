@extends('backend.layouts.main', ['title' => 'Dashboard'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">O</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    {{-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> --}}
                    {{-- <a href="#" class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Tambah User</a> --}}
                </div>
            </div>
            <div class="row">
                <form id="uploadForm" action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data"
                    onsubmit="return confirmSubmit()">
                    @csrf
                    <input type="file" name="file" id="fileInput" style="display:none;">
                    <button type="button" onclick="openFileManager()">Select File</button>
                    <input type="hidden" name="file_url" id="fileUrl">
                    <button type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include Laravel Filemanager JS -->
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        function openFileManager() {
            let route_prefix = "/filemanager";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');
            window.SetUrl = function(items) {
                let file_url = items[0].url;
                document.getElementById('fileUrl').value = file_url;
                document.getElementById('fileInput').value = ''; // Clear file input value
            };
        }

        // function confirmSubmit() {
        //     return confirm('Are you sure you want to upload this file?');
        // }
    </script>
@endpush
