@extends('themes.medicio.layouts.main')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="title" content="{{ $page->title }}">
    <meta name="description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta name="keywords" content="{{ implode(',', $page->tags ?? ['blog', 'post']) }}">
    <meta name="author" content="{{ $page->author ?? 'Admin' }}">
    <meta name="robots" content="index, follow">

    <!-- CSRF Token untuk AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta property="og:image" content="{{ $page->image }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="Your Website Name">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($page->content), 160) }}">
    <meta name="twitter:image" content="{{ $page->image }}">
@endpush

@push('styles')
    <style>
        /* ========================================= */
        /* SLIDER VERIFICATION MODAL STYLES */
        /* File: public/css/slider-verification.css */
        /* ========================================= */

        /* Modal Base Styles */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px 12px 0 0;
            padding: 20px 24px 15px;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 600;
            color: #495057;
            margin: 0;
        }

        .modal-body {
            padding: 20px 24px;
        }

        /* Puzzle Container */
        .puzzle-modal-container {
            margin-bottom: 20px;
            position: relative;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            border: 2px dashed #dee2e6;
        }

        .puzzle-image-wrapper {
            position: relative;
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 50%, #90caf9 100%);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .puzzle-background-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
        }

        .puzzle-missing-piece {
            position: absolute;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.8);
            border: 2px dashed #1976d2;
            border-radius: 6px;
            top: 50%;
            right: 30px;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .puzzle-missing-piece::before {
            content: "🎯";
            font-size: 24px;
            opacity: 0.7;
        }

        .puzzle-missing-piece.highlight {
            background: rgba(76, 175, 80, 0.2);
            border-color: #4caf50;
            box-shadow: 0 0 15px rgba(76, 175, 80, 0.3);
        }

        .puzzle-missing-piece.highlight::before {
            content: "✓";
            color: #4caf50;
            font-size: 28px;
            font-weight: bold;
        }

        .puzzle-piece-draggable {
            position: absolute;
            width: 60px;
            height: 60px;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            cursor: grab;
            transition: all 0.3s ease;
            z-index: 10;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .puzzle-piece-draggable:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }

        .puzzle-piece-draggable:active,
        .puzzle-piece-draggable.dragging {
            cursor: grabbing;
            transform: translateY(-50%) scale(1.1);
            z-index: 1000;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .puzzle-piece-img {
            width: 100%;
            height: 100%;
            border-radius: 6px;
            background: linear-gradient(135deg, #1976d2, #1565c0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .puzzle-piece-draggable.success {
            animation: successPulse 0.6s ease-in-out;
        }

        @keyframes successPulse {

            0%,
            100% {
                transform: translateY(-50%) scale(1);
            }

            50% {
                transform: translateY(-50%) scale(1.2);
            }
        }

        /* Slider Track */
        .slider-track-container {
            margin: 20px 0;
        }

        .slider-track {
            position: relative;
            height: 50px;
            background: linear-gradient(90deg, #e8f5e9 0%, #c8e6c9 100%);
            border-radius: 25px;
            border: 1px solid #a5d6a7;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .slider-handle {
            position: absolute;
            left: 2px;
            top: 2px;
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, #4caf50, #388e3c);
            border-radius: 23px;
            cursor: grab;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(76, 175, 80, 0.4);
            z-index: 5;
        }

        .slider-handle:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.5);
        }

        .slider-handle:active,
        .slider-handle.dragging {
            cursor: grabbing;
            transform: scale(1.1);
        }

        .slider-handle.success {
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            animation: successBounce 0.8s ease-in-out;
        }

        @keyframes successBounce {

            0%,
            100% {
                transform: scale(1);
            }

            25% {
                transform: scale(1.2);
            }

            50% {
                transform: scale(1.1);
            }

            75% {
                transform: scale(1.15);
            }
        }

        .slider-text {
            position: absolute;
            top: 50%;
            left: 60px;
            right: 15px;
            transform: translateY(-50%);
            text-align: center;
            color: #4caf50;
            font-size: 14px;
            font-weight: 600;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .slider-text.hidden {
            opacity: 0;
        }

        /* Status Messages */
        .verification-status-modal {
            text-align: center;
            min-height: 30px;
            margin: 15px 0;
        }

        .status-loading,
        .status-success,
        .status-error {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            margin: 5px 0;
        }

        .status-loading {
            background: rgba(33, 150, 243, 0.1);
            color: #1976d2;
        }

        .status-success {
            background: rgba(76, 175, 80, 0.1);
            color: #2e7d32;
        }

        .status-error {
            background: rgba(244, 67, 54, 0.1);
            color: #c62828;
        }

        /* Alert Styles */
        .alert {
            border-radius: 8px;
            border: none;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
        }

        /* Button Styles */
        .modal-footer .btn {
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
            min-width: 100px;
        }

        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        /* Form Integration Styles */
        .verification-status-inline {
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        .verification-pending {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
        }

        .verification-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .verification-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .btn-verify {
            background: #17a2b8;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            transition: background 0.3s ease;
            cursor: pointer;
            margin-right: 10px;
        }

        .btn-verify:hover {
            background: #138496;
        }

        .btn-submit {
            background: #5DB996;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            transition: background 0.3s ease;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #4aa57d;
        }

        .btn-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 20px;
            }

            .puzzle-image-wrapper {
                height: 150px;
            }

            .puzzle-missing-piece,
            .puzzle-piece-draggable {
                width: 50px;
                height: 50px;
            }

            .puzzle-missing-piece::before {
                font-size: 20px;
            }

            .puzzle-piece-img {
                font-size: 20px;
            }

            .slider-track {
                height: 45px;
            }

            .slider-handle {
                width: 41px;
                height: 41px;
                font-size: 14px;
            }

            .slider-text {
                left: 50px;
                font-size: 13px;
            }
        }

        /* Loading Animation */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .spinner-border {
            animation: spin 1s linear infinite;
        }

        /* Shake Animation for Errors */
        @keyframes modalShake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .modal-content.error {
            animation: modalShake 0.5s ease-in-out;
        }

        /* Utility Classes */
        .d-none {
            display: none !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-primary {
            color: #007bff !important;
        }

        .me-1 {
            margin-right: 0.25rem !important;
        }

        .me-2 {
            margin-right: 0.5rem !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        /* Custom Themes */
        .slider-verification-theme-green {
            --primary-color: #059669;
            --success-color: #10b981;
            --error-color: #dc2626;
        }

        .slider-verification-theme-green .puzzle-image-wrapper {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 50%, #6ee7b7 100%);
        }

        .slider-verification-theme-green .slider-handle {
            background: linear-gradient(135deg, #059669, #047857);
        }

        .slider-verification-theme-green .puzzle-piece-img {
            background: linear-gradient(135deg, #059669, #047857);
        }

        .slider-verification-theme-blue {
            --primary-color: #2563eb;
            --success-color: #3b82f6;
            --error-color: #ef4444;
        }

        .slider-verification-theme-blue .puzzle-image-wrapper {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 50%, #93c5fd 100%);
        }

        .slider-verification-theme-blue .slider-handle {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        .slider-verification-theme-blue .puzzle-piece-img {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }
    </style>
@endpush


@push('styles')
    <!-- Slider Verification CSS -->
    <link href="{{ asset('css/slider-verification.css') }}" rel="stylesheet">

    <!-- Page Specific Styles -->
    <style>
        .article-content {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .comments-section {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #5DB996;
            box-shadow: 0 0 0 0.2rem rgba(93, 185, 150, 0.25);
        }

        .btn-submit {
            background: #5DB996;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #4aa57d;
            transform: translateY(-1px);
        }

        .btn-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .btn-verify {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-right: 10px;
            box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
        }

        .btn-verify:hover {
            background: linear-gradient(135deg, #138496, #117a8b);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        }

        .btn-verify:disabled {
            background: #28a745;
            cursor: not-allowed;
            transform: none;
        }

        .verification-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            margin: 20px 0;
        }

        .verification-status-inline {
            margin: 15px 0;
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .verification-pending {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
        }

        .verification-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .verification-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .puzzle-preview {
            margin: 10px 0;
            padding: 15px;
            background: #e9ecef;
            border-radius: 8px;
            text-align: center;
        }

        .puzzle-preview img {
            max-width: 150px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid #dee2e6;
        }

        .puzzle-instructions {
            font-size: 13px;
            color: #6c757d;
            margin-top: 10px;
        }
    </style>
@endpush

@section('main')
    <main id="main">
        <!-- Breadcrumbs -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>{{ $page->title }}</h2>
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li>{{ $page->title }}</li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- Article Section -->
        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <article class="article-content">
                            <img src="{{ $page->image }}" alt="{{ $page->title }}" class="img-fluid rounded mb-4">

                            <div class="content">
                                {!! $page->content !!}
                            </div>
                        </article>

                        @if ($page->comments_is_active)
                            <div class="comments-section">
                                <h3><i class="bi bi-chat-dots me-2"></i>Comments ({{ $comments->count() }})</h3>

                                <!-- Display Messages -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li><i class="bi bi-x-circle me-1"></i>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Display Comments -->
                                <div class="comments-list mt-4">
                                    @forelse ($comments as $comment)
                                        <div class="comment mb-3 p-3 bg-light rounded">
                                            <strong class="text-primary">{{ $comment->name }}</strong>
                                            <span class="text-muted small d-block">
                                                <i
                                                    class="bi bi-clock me-1"></i>{{ $comment->created_at->format('F d, Y h:i A') }}
                                            </span>
                                            <p class="mt-2 mb-0">{{ $comment->content }}</p>
                                        </div>
                                    @empty
                                        <div class="text-center py-4">
                                            <i class="bi bi-chat-square-text fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                                        </div>
                                    @endforelse
                                </div>

                                <!-- Comment Form -->
                                <div class="comment-form mt-5">
                                    <h4 class="mb-4">
                                        <i class="bi bi-pencil-square me-2"></i>
                                        Leave a Comment
                                    </h4>

                                    <form action="{{ route('comments.store') }}" method="POST" id="comment-form">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $page->id }}">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="name">
                                                        <i class="bi bi-person me-1"></i>Name *
                                                    </label>
                                                    <input type="text" name="name" id="name" class="form-control"
                                                        value="{{ old('name') }}" required
                                                        placeholder="Enter your full name">
                                                    @error('name')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="email">
                                                        <i class="bi bi-envelope me-1"></i>Email *
                                                    </label>
                                                    <input type="email" name="email" id="email" class="form-control"
                                                        value="{{ old('email') }}" required
                                                        placeholder="your.email@example.com">
                                                    @error('email')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="content">
                                                <i class="bi bi-chat-text me-1"></i>Comment *
                                            </label>
                                            <textarea name="content" id="content" class="form-control" rows="4" required
                                                placeholder="Write your comment here...">{{ old('content') }}</textarea>
                                            @error('content')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Enhanced Verification Section -->
                                        <div class="verification-section">
                                            <h6 class="mb-3">
                                                <i class="bi bi-shield-check me-2"></i>
                                                Security Verification
                                            </h6>

                                            <!-- Puzzle Preview -->
                                            <div class="puzzle-preview">
                                                <img src="{{ asset('themes/zenblog.png') }}" alt="Puzzle Preview">
                                                <div class="puzzle-instructions">
                                                    <i class="bi bi-info-circle me-1"></i>
                                                    Anda akan diminta untuk menyelesaikan puzzle gambar untuk memverifikasi
                                                    bahwa Anda manusia
                                                </div>
                                            </div>

                                            <!-- Verification Status -->
                                            <div class="verification-status-inline verification-pending"
                                                id="verification-status">
                                                <i class="bi bi-shield-exclamation me-2"></i>
                                                Harap selesaikan verifikasi puzzle untuk melanjutkan
                                            </div>

                                            <!-- Verification Button -->
                                            <button type="button" class="btn-verify" id="verify-btn"
                                                onclick="showSliderVerification()">
                                                <i class="bi bi-puzzle me-2"></i>
                                                Mulai Verifikasi Puzzle
                                            </button>

                                            @error('slider_verification')
                                                <div class="text-danger small mt-2">
                                                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn-submit" id="submit-btn" disabled>
                                                <i class="bi bi-send me-2"></i>
                                                Submit Comment
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        @include('themes.medicio.layouts.sidebar')
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Include Accurate Slider Verification Modal -->
    @include('components.slider-modal', [
        'modalId' => 'sliderVerificationModal',
        'title' => 'Selesaikan Puzzle untuk Verifikasi',
        'theme' => 'default',
        'puzzleImage' => asset('themes/zenblog.png'),
    ])
@endsection

@push('scripts')
    <!-- Enhanced JavaScript for form integration -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('comment-form');
            const submitBtn = document.getElementById('submit-btn');
            const verifyBtn = document.getElementById('verify-btn');
            const statusElement = document.getElementById('verification-status');
            const tokenInput = document.getElementById('slider-token');

            // Form validation with enhanced UX
            form.addEventListener('submit', function(e) {
                if (!tokenInput.value) {
                    e.preventDefault();

                    // Enhanced error feedback
                    statusElement.className = 'verification-status-inline verification-error';
                    statusElement.innerHTML = `
                        <i class="bi bi-shield-exclamation me-2"></i>
                        Verifikasi puzzle diperlukan sebelum mengirim komentar
                    `;

                    // Smooth scroll to verification section
                    statusElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Shake animation for verification button
                    verifyBtn.style.animation = 'shake 0.5s ease-in-out';
                    setTimeout(() => {
                        verifyBtn.style.animation = '';
                    }, 500);

                    return false;
                }

                // Show loading state on submit
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Sending...';
                submitBtn.disabled = true;
            });

            // Enhanced verification button interaction
            verifyBtn.addEventListener('click', function() {
                this.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Loading Puzzle...';
                this.disabled = true;

                setTimeout(() => {
                    this.innerHTML = '<i class="bi bi-puzzle me-2"></i>Mulai Verifikasi Puzzle';
                    this.disabled = false;
                }, 1000);
            });

            // Real-time form validation
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const contentInput = document.getElementById('content');

            [nameInput, emailInput, contentInput].forEach(input => {
                input.addEventListener('input', function() {
                    validateField(this);
                });
            });

            function validateField(field) {
                const value = field.value.trim();
                let isValid = false;

                switch (field.type) {
                    case 'text':
                        isValid = value.length >= 2;
                        break;
                    case 'email':
                        isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
                        break;
                    default:
                        isValid = value.length >= 10;
                }

                field.classList.toggle('is-valid', isValid);
                field.classList.toggle('is-invalid', !isValid && value.length > 0);
            }

            // Auto-save draft functionality
            let draftTimer;
            [nameInput, emailInput, contentInput].forEach(input => {
                input.addEventListener('input', function() {
                    clearTimeout(draftTimer);
                    draftTimer = setTimeout(saveDraft, 2000);
                });
            });

            function saveDraft() {
                const draft = {
                    name: nameInput.value,
                    email: emailInput.value,
                    content: contentInput.value,
                    timestamp: Date.now()
                };
                localStorage.setItem('comment_draft', JSON.stringify(draft));
            }

            // Load draft on page load
            const savedDraft = localStorage.getItem('comment_draft');
            if (savedDraft) {
                try {
                    const draft = JSON.parse(savedDraft);
                    const dayOld = Date.now() - draft.timestamp > 24 * 60 * 60 * 1000;

                    if (!dayOld) {
                        nameInput.value = draft.name || '';
                        emailInput.value = draft.email || '';
                        contentInput.value = draft.content || '';

                        if (draft.name || draft.email || draft.content) {
                            showDraftNotification();
                        }
                    }
                } catch (e) {
                    console.log('Could not load draft');
                }
            }

            function showDraftNotification() {
                const notification = document.createElement('div');
                notification.className = 'alert alert-info';
                notification.innerHTML = `
                    <i class="bi bi-info-circle me-2"></i>
                    Draft komentar telah dipulihkan dari sesi sebelumnya.
                    <button type="button" class="btn-close ms-auto" onclick="this.parentElement.remove()"></button>
                `;
                form.insertBefore(notification, form.firstChild);

                setTimeout(() => {
                    notification.remove();
                }, 5000);
            }

            // Clear draft on successful submission
            form.addEventListener('submit', function() {
                if (tokenInput.value) {
                    localStorage.removeItem('comment_draft');
                }
            });
        });

        // Global function for verification modal
        function showSliderVerification() {
            const modal = new bootstrap.Modal(document.getElementById('sliderVerificationModal'));
            modal.show();
        }

        // Add shake animation CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
            
            .is-valid {
                border-color: #28a745 !important;
                box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
            }
            
            .is-invalid {
                border-color: #dc3545 !important;
                box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            }
        `;
        document.head.appendChild(style);
    </script>
@endpush

@push('scripts')
    <script>
        /**
         * Slider Verification Modal JavaScript
         * File: public/js/slider-verification.js
         * 
         * Dependencies: Bootstrap 5, Bootstrap Icons
         * Author: Your Name
         * Version: 1.0.0
         */

        class SliderVerification {
            constructor(options = {}) {
                this.options = {
                    modalId: 'sliderVerificationModal',
                    tokenInputId: 'slider-token',
                    submitBtnId: 'submit-btn',
                    verifyBtnId: 'verify-btn',
                    statusId: 'verification-status',
                    generateUrl: '/slider-verification/generate',
                    verifyUrl: '/slider-verification/verify',
                    csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    autoCloseDelay: 1500,
                    tolerance: 20,
                    ...options
                };

                this.state = {
                    challenge: null,
                    isVerified: false,
                    isDraggingSlider: false,
                    isDraggingPuzzle: false,
                    startX: 0,
                    currentSliderX: 0,
                    currentPuzzleX: 20
                };

                this.elements = {};
                this.init();
            }

            init() {
                this.cacheElements();
                this.bindEvents();
                this.setupInitialState();
            }

            cacheElements() {
                this.elements = {
                    modal: document.getElementById(this.options.modalId),
                    modalContent: document.querySelector(`#${this.options.modalId} .modal-content`),
                    errorAlert: document.getElementById('modalErrorAlert'),
                    errorMessage: document.getElementById('modalErrorMessage'),
                    puzzlePiece: document.getElementById('puzzlePieceDraggable'),
                    missingPiece: document.getElementById('puzzleMissingPiece'),
                    sliderHandle: document.getElementById('modalSliderHandle'),
                    sliderText: document.querySelector(`#${this.options.modalId} .slider-text`),
                    statusDiv: document.getElementById('modalVerificationStatus'),
                    tokenInput: document.getElementById(this.options.tokenInputId),
                    resetBtn: document.getElementById('modalResetBtn'),
                    submitBtn: document.getElementById(this.options.submitBtnId),
                    verifyBtn: document.getElementById(this.options.verifyBtnId),
                    verificationStatus: document.getElementById(this.options.statusId)
                };
            }

            bindEvents() {
                if (!this.elements.modal) return;

                // Modal events
                this.elements.modal.addEventListener('shown.bs.modal', () => this.initializeChallenge());
                this.elements.modal.addEventListener('hidden.bs.modal', () => this.resetModal());

                // Slider events
                this.bindDragEvents(this.elements.sliderHandle, 'slider');

                // Puzzle events
                this.bindDragEvents(this.elements.puzzlePiece, 'puzzle');

                // Button events
                if (this.elements.resetBtn) {
                    this.elements.resetBtn.addEventListener('click', () => this.handleReset());
                }

                // Form validation
                const form = document.getElementById('comment-form');
                if (form) {
                    form.addEventListener('submit', (e) => this.validateForm(e));
                }
            }

            bindDragEvents(element, type) {
                if (!element) return;

                element.addEventListener('mousedown', (e) => this.startDrag(e, type));
                element.addEventListener('touchstart', (e) => this.startDrag(e, type), {
                    passive: false
                });

                document.addEventListener('mousemove', (e) => this.drag(e, type));
                document.addEventListener('touchmove', (e) => this.drag(e, type), {
                    passive: false
                });

                document.addEventListener('mouseup', (e) => this.endDrag(e, type));
                document.addEventListener('touchend', (e) => this.endDrag(e, type));
            }

            setupInitialState() {
                if (this.elements.submitBtn) {
                    this.elements.submitBtn.disabled = true;
                    this.elements.submitBtn.style.cursor = 'not-allowed';
                }
            }

            async initializeChallenge() {
                try {
                    this.showStatus('loading', 'Memuat...');

                    const response = await fetch(this.options.generateUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': this.options.csrfToken
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }

                    const data = await response.json();
                    this.state.challenge = data;

                    // Set target position
                    const targetPos = (data.target_position / data.slider_width) * 300;
                    if (this.elements.missingPiece) {
                        this.elements.missingPiece.style.right = (30 + (300 - targetPos)) + 'px';
                    }

                    this.hideStatus();
                    this.hideErrorAlert();

                } catch (error) {
                    console.error('Failed to initialize challenge:', error);
                    this.showErrorAlert('Gagal memuat verifikasi: ' + error.message);
                }
            }

            startDrag(e, type) {
                if (this.state.isVerified) return;

                e.preventDefault();

                if (type === 'slider') {
                    this.state.isDraggingSlider = true;
                    this.state.isDraggingPuzzle = false;
                    this.elements.sliderHandle?.classList.add('dragging');
                } else if (type === 'puzzle') {
                    this.state.isDraggingPuzzle = true;
                    this.state.isDraggingSlider = false;
                    this.elements.puzzlePiece?.classList.add('dragging');
                }

                this.state.startX = this.getEventX(e);
                this.elements.sliderText?.classList.add('hidden');
            }

            drag(e, type) {
                const isDragging = (type === 'slider' && this.state.isDraggingSlider) ||
                    (type === 'puzzle' && this.state.isDraggingPuzzle);

                if (!isDragging || this.state.isVerified) return;

                e.preventDefault();

                if (type === 'slider') {
                    this.dragSlider(e);
                } else if (type === 'puzzle') {
                    this.dragPuzzle(e);
                }

                this.checkProximity();
            }

            dragSlider(e) {
                const currentEventX = this.getEventX(e);
                this.state.currentSliderX = currentEventX - this.state.startX;

                // Constrain movement
                const maxMove = 300;
                this.state.currentSliderX = Math.max(0, Math.min(this.state.currentSliderX, maxMove));

                if (this.elements.sliderHandle) {
                    this.elements.sliderHandle.style.transform = `translateX(${this.state.currentSliderX}px)`;
                }

                // Sync puzzle piece
                const puzzlePos = (this.state.currentSliderX / maxMove) * 260;
                this.state.currentPuzzleX = 20 + puzzlePos;

                if (this.elements.puzzlePiece) {
                    this.elements.puzzlePiece.style.left = this.state.currentPuzzleX + 'px';
                }
            }

            dragPuzzle(e) {
                if (!this.elements.puzzlePiece || !this.elements.modal) return;

                const rect = this.elements.modal.querySelector('.puzzle-image-wrapper')?.getBoundingClientRect();
                if (!rect) return;

                const x = this.getEventX(e) - rect.left - 30;
                const maxX = 260;
                const constrainedX = Math.max(0, Math.min(x, maxX));

                this.state.currentPuzzleX = 20 + constrainedX;
                this.elements.puzzlePiece.style.left = this.state.currentPuzzleX + 'px';

                // Sync slider
                const sliderPos = (constrainedX / maxX) * 300;
                this.state.currentSliderX = sliderPos;

                if (this.elements.sliderHandle) {
                    this.elements.sliderHandle.style.transform = `translateX(${sliderPos}px)`;
                }
            }

            endDrag(e, type) {
                const wasDragging = (type === 'slider' && this.state.isDraggingSlider) ||
                    (type === 'puzzle' && this.state.isDraggingPuzzle);

                if (!wasDragging || this.state.isVerified) return;

                this.state.isDraggingSlider = false;
                this.state.isDraggingPuzzle = false;

                this.elements.sliderHandle?.classList.remove('dragging');
                this.elements.puzzlePiece?.classList.remove('dragging');

                this.verifyPosition();
            }

            checkProximity() {
                if (!this.elements.missingPiece) return;

                const targetRight = parseInt(this.elements.missingPiece.style.right) || 30;
                const modalWidth = 350;
                const targetLeft = modalWidth - targetRight - 60;

                if (Math.abs(this.state.currentPuzzleX - targetLeft) < this.options.tolerance) {
                    this.elements.missingPiece.classList.add('highlight');
                } else {
                    this.elements.missingPiece.classList.remove('highlight');
                }
            }

            async verifyPosition() {
                if (!this.state.challenge) {
                    this.showError('Challenge not loaded');
                    return;
                }

                try {
                    this.showStatus('loading', 'Memverifikasi...');

                    const relativePosition = ((this.state.currentPuzzleX - 20) / 260) *
                        (this.state.challenge.slider_width - this.state.challenge.puzzle_width);

                    const response = await fetch(this.options.verifyUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': this.options.csrfToken
                        },
                        body: JSON.stringify({
                            token: this.state.challenge.token,
                            position: relativePosition + 20
                        })
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }

                    const result = await response.json();

                    if (result.success) {
                        this.showSuccess();
                    } else {
                        this.showError(result.message || 'Verifikasi gagal');
                    }

                } catch (error) {
                    console.error('Verification failed:', error);
                    this.showError('Terjadi kesalahan: ' + error.message);
                }
            }

            showSuccess() {
                this.state.isVerified = true;
                this.hideErrorAlert();
                this.showStatus('success', 'Verifikasi berhasil!');

                // Visual feedback
                this.elements.sliderHandle?.classList.add('success');
                this.elements.puzzlePiece?.classList.add('success');
                this.elements.missingPiece?.classList.add('highlight');

                if (this.elements.sliderText) {
                    this.elements.sliderText.innerHTML = '<i class="bi bi-check-circle me-2"></i>Berhasil!';
                    this.elements.sliderText.classList.remove('hidden');
                }

                // Update token
                if (this.elements.tokenInput && this.state.challenge) {
                    this.elements.tokenInput.value = this.state.challenge.token;
                }

                // Auto close modal
                setTimeout(() => {
                    this.closeModal();
                    this.updateVerificationStatus('success');
                }, this.options.autoCloseDelay);
            }

            showError(message) {
                this.elements.modalContent?.classList.add('error');
                this.showErrorAlert(message);
                this.showStatus('error', message);

                setTimeout(() => {
                    this.elements.modalContent?.classList.remove('error');
                    this.resetPositions();
                }, 1000);
            }

            resetPositions() {
                this.state.currentSliderX = 0;
                this.state.currentPuzzleX = 20;

                if (this.elements.sliderHandle) {
                    this.elements.sliderHandle.style.transform = 'translateX(0)';
                }

                if (this.elements.puzzlePiece) {
                    this.elements.puzzlePiece.style.left = '20px';
                }

                this.elements.missingPiece?.classList.remove('highlight');

                if (this.elements.sliderText) {
                    this.elements.sliderText.innerHTML = '<i class="bi bi-arrow-right me-2"></i>Coba Lagi';
                    this.elements.sliderText.classList.remove('hidden');
                }

                this.hideStatus();
            }

            showStatus(type, message) {
                if (!this.elements.statusDiv) return;

                // Hide all status elements
                this.elements.statusDiv.querySelectorAll('div').forEach(div => div.classList.add('d-none'));

                // Show specific status
                const statusElement = this.elements.statusDiv.querySelector(`.status-${type}`);
                if (statusElement) {
                    if (type === 'error') {
                        const errorTextElement = statusElement.querySelector('.error-text');
                        if (errorTextElement) {
                            errorTextElement.textContent = message;
                        }
                    }
                    statusElement.classList.remove('d-none');
                }
            }

            hideStatus() {
                if (this.elements.statusDiv) {
                    this.elements.statusDiv.querySelectorAll('div').forEach(div => div.classList.add('d-none'));
                }
            }

            showErrorAlert(message) {
                if (this.elements.errorMessage) {
                    this.elements.errorMessage.textContent = message;
                }

                if (this.elements.errorAlert) {
                    this.elements.errorAlert.classList.remove('d-none');
                }
            }

            hideErrorAlert() {
                if (this.elements.errorAlert) {
                    this.elements.errorAlert.classList.add('d-none');
                }
            }

            updateVerificationStatus(status) {
                if (!this.elements.verificationStatus) return;

                if (status === 'success') {
                    this.elements.verificationStatus.className = 'verification-status-inline verification-success';
                    this.elements.verificationStatus.innerHTML =
                        '<i class="bi bi-shield-check me-2"></i>Verifikasi berhasil! Anda dapat mengirim komentar sekarang.';

                    if (this.elements.submitBtn) {
                        this.elements.submitBtn.disabled = false;
                        this.elements.submitBtn.style.cursor = 'pointer';
                    }

                    if (this.elements.verifyBtn) {
                        this.elements.verifyBtn.innerHTML =
                            '<i class="bi bi-check-circle me-2"></i>Sudah Terverifikasi';
                        this.elements.verifyBtn.disabled = true;
                        this.elements.verifyBtn.style.background = '#28a745';
                        this.elements.verifyBtn.style.cursor = 'not-allowed';
                    }
                } else if (status === 'error') {
                    this.elements.verificationStatus.className = 'verification-status-inline verification-error';
                    this.elements.verificationStatus.innerHTML =
                        '<i class="bi bi-shield-exclamation me-2"></i>Verifikasi gagal, silakan coba lagi.';

                    if (this.elements.submitBtn) {
                        this.elements.submitBtn.disabled = true;
                        this.elements.submitBtn.style.cursor = 'not-allowed';
                    }
                }
            }

            handleReset() {
                this.state.isVerified = false;
                this.elements.sliderHandle?.classList.remove('success');
                this.elements.puzzlePiece?.classList.remove('success');
                this.resetPositions();
                this.closeModal();
            }

            resetModal() {
                if (!this.state.isVerified && this.elements.tokenInput) {
                    this.elements.tokenInput.value = '';
                }

                // Reset all states
                this.state.isVerified = false;
                this.state.isDraggingSlider = false;
                this.state.isDraggingPuzzle = false;

                this.elements.sliderHandle?.classList.remove('success', 'dragging');
                this.elements.puzzlePiece?.classList.remove('success', 'dragging');
                this.resetPositions();
                this.hideErrorAlert();
            }

            closeModal() {
                if (this.elements.modal) {
                    const bsModal = bootstrap.Modal.getInstance(this.elements.modal);
                    if (bsModal) {
                        bsModal.hide();
                    }
                }
            }

            validateForm(e) {
                if (!this.elements.tokenInput || !this.elements.tokenInput.value) {
                    e.preventDefault();
                    this.updateVerificationStatus('error');

                    // Scroll to verification section
                    if (this.elements.verificationStatus) {
                        this.elements.verificationStatus.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }

                    return false;
                }
                return true;
            }

            getEventX(e) {
                return e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
            }

            // Public methods
            show() {
                if (this.elements.modal) {
                    const bsModal = new bootstrap.Modal(this.elements.modal);
                    bsModal.show();
                }
            }

            isVerified() {
                return this.state.isVerified && this.elements.tokenInput?.value;
            }

            getToken() {
                return this.elements.tokenInput?.value || null;
            }

            reset() {
                this.handleReset();
            }

            // Static method to create instance
            static create(options = {}) {
                return new SliderVerification(options);
            }
        }

        // Global functions for backward compatibility
        let sliderVerificationInstance = null;

        function initSliderVerification(options = {}) {
            if (!sliderVerificationInstance) {
                sliderVerificationInstance = SliderVerification.create(options);
            }
            return sliderVerificationInstance;
        }

        function showSliderVerification() {
            if (!sliderVerificationInstance) {
                sliderVerificationInstance = initSliderVerification();
            }
            sliderVerificationInstance.show();
        }

        function resetSliderVerification() {
            if (sliderVerificationInstance) {
                sliderVerificationInstance.reset();
            }
        }

        function isSliderVerified() {
            return sliderVerificationInstance ? sliderVerificationInstance.isVerified() : false;
        }

        function getSliderToken() {
            return sliderVerificationInstance ? sliderVerificationInstance.getToken() : null;
        }

        // Auto-initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Check if modal exists before initializing
            if (document.getElementById('sliderVerificationModal')) {
                initSliderVerification();
            }
        });

        // Export for module usage
        if (typeof module !== 'undefined' && module.exports) {
            module.exports = SliderVerification;
        }

        // AMD support
        if (typeof define === 'function' && define.amd) {
            define([], function() {
                return SliderVerification;
            });
        }
    </script>
@endpush
