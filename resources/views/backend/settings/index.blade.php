@extends('backend.layouts.main', ['title' => 'Settings'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-1 fs-3">Settings</h3>
                    <p class="mb-0 text-muted">Versi Saat Ini: <strong>{{ $currentVersion }}</strong></p>
                </div>

                <div class="ms-md-auto py-2 py-md-0">
                    {{-- Tombol update --}}
                    <form id="updateForm" action="{{ route('admin.update.app') }}" method="POST" class="mt-3">
                        @csrf
                        <button id="updateButton" type="submit" class="btn btn-warning d-flex align-items-center"
                            @if (version_compare($remoteVersion, $currentVersion, '<=')) disabled style="opacity: 0.5; cursor: not-allowed;" @endif>
                            <span class="spinner-border spinner-border-sm me-2 d-none" id="updateSpinner" role="status"
                                aria-hidden="true"></span>
                            @if (version_compare($remoteVersion, $currentVersion, '<='))
                                ✅ Sudah versi paling terbaru
                            @else
                                🔄 Perbarui Aplikasi ke Versi {{ $remoteVersion }}
                            @endif
                        </button>
                    </form>

                </div>
            </div>

            {{-- Card untuk Settings --}}
            <div class="card">
                <div class="card-body">

                    {{-- Tab Navigasi --}}
                    <ul class="nav nav-pills nav-secondary mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="site-tab" data-bs-toggle="pill" href="#site" role="tab"
                                aria-controls="site" aria-selected="true">
                                <i class="fa fa-globe me-2"></i> Site
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="logo-tab" data-bs-toggle="pill" href="#logo" role="tab"
                                aria-controls="logo" aria-selected="false">
                                <i class="fa fa-image me-2"></i> Logo
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="email-tab" data-bs-toggle="pill" href="#email" role="tab"
                                aria-controls="email" aria-selected="false">
                                <i class="fa fa-envelope me-2"></i> Email
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="database-tab" data-bs-toggle="pill" href="#database" role="tab"
                                aria-controls="database" aria-selected="false">
                                <i class="fa fa-database me-2"></i> Database
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" id="seo-tab" data-bs-toggle="pill" href="#seo" role="tab"
                                aria-controls="seo" aria-selected="false">
                                <i class="fa fa-search me-2"></i> SEO
                            </a>
                        </li>
                    </ul>


                    {{-- Form Settings --}}
                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="pills-tabContent">

                            {{-- Site Settings --}}
                            <div class="tab-pane fade show active" id="site" role="tabpanel"
                                aria-labelledby="site-tab">
                                <h4 class="mb-3"><i class="fa fa-globe me-2"></i> Site Settings</h4>
                                <div class="mb-3">
                                    <label for="site_name" class="form-label">Nama Situs</label>
                                    <input type="text" class="form-control" id="site_name" name="site_name"
                                        value="{{ $settings['site_name'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="footer_text" class="form-label">Footer Text</label>
                                    <input type="text" class="form-control" id="footer_text" name="footer_text"
                                        value="{{ $settings['footer_text'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="app_url" class="form-label">App URL</label>
                                    <input type="text" class="form-control" id="app_url" name="app_url"
                                        value="{{ $settings['app_url'] ?? '' }}">
                                </div>
                            </div>

                            {{-- Logo Settings --}}
                            <div class="tab-pane fade" id="logo" role="tabpanel" aria-labelledby="logo-tab">
                                <h4 class="mb-3"> <i class="fa fa-image me-2"></i> Logo Settings</h4>
                                <div class="mb-3">
                                    <label for="site_logo" class="form-label">Upload Logo</label>
                                    <input type="file" class="form-control" id="site_logo" name="site_logo"
                                        accept="image/*">
                                    @if (isset($settings['site_logo']))
                                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo"
                                            class="mt-3" style="max-height: 100px;">
                                    @endif
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="loader_image" class="form-label">Loader Image</label>
                                    <input type="text" class="form-control" id="loader_image" name="loader_image"
                                        value="{{ $settings['loader_image'] ?? '' }}">
                                </div> --}}
                            </div>

                            {{-- Email Settings --}}
                            <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                                <h4 class="mb-3"> <i class="fa fa-envelope me-2"></i> Email Settings</h4>
                                <div class="mb-3">
                                    <label for="site_email" class="form-label">Site Email</label>
                                    <input type="email" class="form-control" id="site_email" name="site_email"
                                        value="{{ $settings['site_email'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="mail_mailer" class="form-label">Mailer</label>
                                    <input type="text" class="form-control" id="mail_mailer" name="mail_mailer"
                                        value="{{ $settings['mail_mailer'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="mail_host" class="form-label">Mail Host</label>
                                    <input type="text" class="form-control" id="mail_host" name="mail_host"
                                        value="{{ $settings['mail_host'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="mail_port" class="form-label">Mail Port</label>
                                    <input type="text" class="form-control" id="mail_port" name="mail_port"
                                        value="{{ $settings['mail_port'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="mail_username" class="form-label">Mail Username</label>
                                    <input type="text" class="form-control" id="mail_username" name="mail_username"
                                        value="{{ $settings['mail_username'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="mail_password" class="form-label">Mail Password</label>
                                    <input type="password" class="form-control" id="mail_password" name="mail_password"
                                        value="{{ $settings['mail_password'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="mail_encryption" class="form-label">Mail Encryption</label>
                                    <input type="text" class="form-control" id="mail_encryption"
                                        name="mail_encryption" value="{{ $settings['mail_encryption'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="mail_from_address" class="form-label">From Address</label>
                                    <input type="email" class="form-control" id="mail_from_address"
                                        name="mail_from_address" value="{{ $settings['mail_from_address'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="mail_from_name" class="form-label">From Name</label>
                                    <input type="text" class="form-control" id="mail_from_name" name="mail_from_name"
                                        value="{{ $settings['mail_from_name'] ?? '' }}">
                                </div>
                            </div>

                            {{-- Database Settings --}}
                            <div class="tab-pane fade" id="database" role="tabpanel" aria-labelledby="database-tab">
                                <h4 class="mb-3"><i class="fa fa-database me-2"></i> Database Settings</h4>
                                <div class="mb-3">
                                    <label for="database_connection" class="form-label">Database Connection</label>
                                    <input type="text" class="form-control" id="database_connection"
                                        name="database_connection" value="{{ $settings['database_connection'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="database_host" class="form-label">Database Host</label>
                                    <input type="text" class="form-control" id="database_host" name="database_host"
                                        value="{{ $settings['database_host'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="database_port" class="form-label">Database Port</label>
                                    <input type="text" class="form-control" id="database_port" name="database_port"
                                        value="{{ $settings['database_port'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="database_name" class="form-label">Database Name</label>
                                    <input type="text" class="form-control" id="database_name" name="database_name"
                                        value="{{ $settings['database_name'] ?? '' }}">
                                </div>
                            </div>

                            {{-- SEO Settings --}}
                            <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                <h4 class="mb-3"><i class="fa fa-search me-2"></i> SEO Settings</h4>
                                <div class="mb-3">
                                    <label for="seo_title" class="form-label">SEO Title</label>
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                        value="{{ $settings['seo_title'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="seo_description" class="form-label">SEO Description</label>
                                    <textarea class="form-control" id="seo_description" name="seo_description" rows="3">{{ $settings['seo_description'] ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="seo_keywords" class="form-label">SEO Keywords</label>
                                    <textarea class="form-control" id="seo_keywords" name="seo_keywords" rows="2">{{ $settings['seo_keywords'] ?? '' }}</textarea>
                                </div>
                            </div>


                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-round">
                                Simpan Semua Pengaturan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
