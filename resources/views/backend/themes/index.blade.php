@extends('backend.layouts.main', ['title' => 'Themes'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="page-header">
                    <h3 class="fw-bold mb-3 fs-3">Themes</h3>
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
                            <a href="#">Themes</a>
                        </li>
                    </ul>
                    <div class="ms-md-auto py-2 py-md-0">
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($themes as $theme)
                    <div class="col-md-4 mb-4">
                        <div class="card theme-card">
                            <div class="theme-image-container">
                                <img src="{{ asset($theme->image) }}" alt="{{ $theme->name }}"
                                    class="card-img-top img-fluid">
                                <div class="theme-overlay">
                                    <div class="theme-details">
                                        <h4>{{ $theme->name }}</h4>
                                        {{-- @if (!$theme->active)
                                            <a href="{{ route('ganti.tema', $theme->id) }}" class="btn btn-light">
                                                <i class="fa fa-check"></i> Aktifkan Tema
                                            </a>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="numbers">
                                            <h4 class="card-title">{{ $theme->name }}</h4>
                                            <h4 class="card-title">
                                                @if ($theme->active)
                                                    <span class="btn btn-success" style="cursor: default;">
                                                        <span class="btn-label">
                                                            <i class="fa fa-check"></i>
                                                        </span>
                                                        Sedang Aktif
                                                    </span>
                                                @else
                                                    <a class="btn btn-warning" href="{{ route('ganti.tema', $theme->id) }}">
                                                        <span class="btn-label">
                                                            <i class="fa fa-exclamation-circle"></i>
                                                        </span>
                                                        Aktifkan
                                                    </a>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .theme-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .theme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .theme-image-container {
            position: relative;
            overflow: hidden;
        }

        .theme-image-container img {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .theme-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .theme-details {
            text-align: center;
            color: white;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .theme-details h4 {
            margin-bottom: 15px;
            color: white;
        }

        .theme-card:hover .theme-overlay {
            opacity: 1;
        }

        .theme-card:hover .theme-details {
            transform: translateY(0);
        }

        .theme-card:hover .theme-image-container img {
            transform: scale(1.1);
        }

        .btn-light {
            background: white;
            color: #000;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background: #f8f9fa;
            transform: scale(1.05);
        }

        .btn-success,
        .btn-warning {
            transition: all 0.3s ease;
        }

        .btn-success:hover,
        .btn-warning:hover {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            margin-bottom: 1rem;
            color: #1a2035;
        }
    </style>
@endsection
