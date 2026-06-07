@extends('backend.layouts.main', ['title' => 'My Profile'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <h3 class="fw-bold mb-3 fs-3">My Profile</h3>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>Password Baru <small>(Kosongkan jika tidak ingin diubah)</small></label>
                            <div class="position-relative">
                                <input type="password" name="password" id="password" class="form-control pr-5">
                                <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y me-3 text-muted toggle-password"
                                    toggle="#password" style="cursor: pointer;"></i>
                            </div>
                            <small id="passwordHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group mt-3">
                            <label>Konfirmasi Password</label>
                            <div class="position-relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control pr-5">
                                <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y me-3 text-muted toggle-password"
                                    toggle="#password_confirmation" style="cursor: pointer;"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = document.querySelector(this.getAttribute('toggle'));
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('text-muted');
                    this.classList.add('text-primary');
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.remove('text-primary');
                    this.classList.add('text-muted');
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });

        // Password strength check
        const passwordInput = document.getElementById('password');
        const passwordHelp = document.getElementById('passwordHelp');

        passwordInput?.addEventListener('input', () => {
            const val = passwordInput.value;
            let message = '';
            let color = 'text-danger';

            if (val.length >= 8 && /[A-Z]/.test(val) && /\d/.test(val) && /[!@#$%^&*]/.test(val)) {
                message = 'Password kuat';
                color = 'text-success';
            } else if (val.length >= 6) {
                message = 'Password sedang';
                color = 'text-warning';
            } else if (val.length > 0) {
                message = 'Password lemah';
                color = 'text-danger';
            }

            passwordHelp.textContent = message;
            passwordHelp.className = `form-text ${color}`;
        });
    </script>
@endpush
