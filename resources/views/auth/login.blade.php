<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — {{ config('app.name', 'Perbasi Malut') }}</title>

    <link rel="icon" href="{{ asset('backend/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            background: #F8F9FA;
        }

        /* ── Left panel ── */
        .panel-brand {
            width: 45%;
            background: linear-gradient(145deg, #8a1c28 0%, #A92333 45%, #c72b3f 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        /* geometric accent circles */
        .panel-brand::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            border: 60px solid rgba(255,255,255,0.06);
            top: -100px;
            right: -100px;
        }
        .panel-brand::after {
            content: '';
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            border: 40px solid rgba(255,255,255,0.05);
            bottom: -60px;
            left: -60px;
        }

        .brand-logo {
            width: 110px;
            height: 110px;
            object-fit: contain;
            border-radius: 50%;
            background: #fff;
            padding: 10px;
            margin-bottom: 28px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            position: relative;
            z-index: 1;
        }

        .brand-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: #ffffff;
            text-align: center;
            line-height: 1.2;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.3px;
        }

        .brand-subtitle {
            font-size: 0.88rem;
            color: rgba(255,255,255,0.75);
            text-align: center;
            line-height: 1.6;
            max-width: 280px;
            position: relative;
            z-index: 1;
        }

        .brand-divider {
            width: 48px;
            height: 3px;
            background: rgba(255,255,255,0.5);
            border-radius: 2px;
            margin: 20px auto;
            position: relative;
            z-index: 1;
        }

        /* ── Right panel ── */
        .panel-form {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 32px;
            background: #F8F9FA;
        }

        .form-card {
            width: 100%;
            max-width: 400px;
        }

        .form-card h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #1A1D20;
            margin-bottom: 6px;
        }

        .form-card p.lead-text {
            font-size: 0.88rem;
            color: #6c757d;
            margin-bottom: 32px;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #1A1D20;
            margin-bottom: 6px;
            display: block;
        }

        .form-control {
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 0.9rem;
            color: #1A1D20;
            background: #fff;
            width: 100%;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-control:focus {
            border-color: #A92333;
            box-shadow: 0 0 0 3px rgba(169, 35, 51, 0.12);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .password-wrap {
            position: relative;
        }

        .password-wrap .form-control {
            padding-right: 44px;
        }

        .btn-eye {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            padding: 0;
            cursor: pointer;
            color: #aaa;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }

        .btn-eye:hover { color: #A92333; }

        .btn-login {
            width: 100%;
            background: #A92333;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.92rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: #8a1c28;
            box-shadow: 0 4px 16px rgba(169,35,51,0.3);
        }

        .btn-login:active { transform: scale(0.98); }

        .alert-danger {
            background: #fff0f2;
            border: 1px solid #f5c2c7;
            border-radius: 8px;
            color: #842029;
            font-size: 0.83rem;
            padding: 10px 14px;
            margin-bottom: 16px;
        }

        .form-footer {
            text-align: center;
            margin-top: 28px;
            font-size: 0.8rem;
            color: #aaa;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .panel-brand {
                width: 100%;
                padding: 36px 24px 28px;
            }
            .brand-logo { width: 72px; height: 72px; margin-bottom: 16px; }
            .brand-title { font-size: 1.3rem; }
            .panel-form { padding: 32px 20px; }
        }
    </style>
</head>
<body>

    {{-- ── Left: Brand panel ── --}}
    <div class="panel-brand">
        <img src="{{ asset('backend/assets/img/logo-perbasi.png') }}" alt="Logo Perbasi Malut" class="brand-logo">
        <h1 class="brand-title">PERBASI<br>MALUKU UTARA</h1>
        <p class="brand-subtitle">MALUT BISA, MALUT JUARA</p>
    </div>

    {{-- ── Right: Form panel ── --}}
    <div class="panel-form">
        <div class="form-card">
            <h2>Selamat Datang</h2>
            <p class="lead-text">Masuk ke panel admin Website Perbasi Malut</p>

            {{-- Session status --}}
            @if (session('status'))
                <div class="alert-danger">{{ session('status') }}</div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        required autofocus autocomplete="username" placeholder="Email">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Kata Sandi</label>
                    <div class="password-wrap">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            required autocomplete="current-password" placeholder="Kata Sandi">
                        <button type="button" class="btn-eye" onclick="togglePassword(this)" aria-label="Toggle password">
                            {{-- eye icon (visible) --}}
                            <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12.5a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                            </svg>
                            {{-- eye-off icon (hidden) --}}
                            <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24" style="display:none">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-5 0-9.27-3.11-11-7.5a10.06 10.06 0 0 1 2.34-3.81M6.53 6.53A9.97 9.97 0 0 1 12 4.5c5 0 9.27 3.11 11 7.5a10.06 10.06 0 0 1-4.13 5.23M1 1l22 22M9.9 9.9a3 3 0 0 0 4.2 4.2"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">MASUK</button>
            </form>

            <div class="form-footer">
                &copy; {{ date('Y') }} Perbasi Maluku Utara. All rights reserved.
            </div>
        </div>
    </div>

    <script>
        function togglePassword(btn) {
            var input   = document.getElementById('password');
            var iconOn  = document.getElementById('icon-eye');
            var iconOff = document.getElementById('icon-eye-off');
            if (input.type === 'password') {
                input.type    = 'text';
                iconOn.style.display  = 'none';
                iconOff.style.display = 'block';
            } else {
                input.type    = 'password';
                iconOn.style.display  = 'block';
                iconOff.style.display = 'none';
            }
        }
    </script>
</body>
</html>
