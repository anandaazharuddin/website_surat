<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        .custom-card {
            border-radius: 20px; /* Membulatkan tepi card */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Efek shadow */
            overflow: hidden;
        }
        .card-header {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        .form-control {
            border-radius: 10px; /* Membulatkan input */
        }
        .btn {
            border-radius: 10px; /* Membulatkan tombol */
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card w-50 shadow-lg custom-card">
            <div class="card-header text-center bg-primary text-white">
                <h4 class="mb-0">REGISTER</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required autofocus value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>

                <div class="text-center mt-3">
                    <small>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login</a></small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
