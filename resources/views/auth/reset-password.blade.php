@extends('layouts.app')

@section('title', 'Reset Password - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">Reset Password</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Login</a></li>
                    <li class="breadcrumb-item text-warning active" aria-current="page">Reset Password</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Reset Password Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded p-5">
                        <div class="text-center mb-5">
                            <h5 class="text-primary">Create New Password</h5>
                            <h1 class="text-warning mb-4">Set Your New Password</h1>
                            <p class="text-muted">Please create a strong password that you haven't used before.</p>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $request->email) }}" 
                                               placeholder="Your Email"
                                               required 
                                               readonly>
                                        <label for="email">Email Address</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating password-field">
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               placeholder="New Password"
                                               required>
                                        <label for="password">New Password</label>
                                        <button type="button" class="btn btn-link password-toggle" onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating password-field">
                                        <input type="password" 
                                               class="form-control"
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               placeholder="Confirm Password"
                                               required>
                                        <label for="password_confirmation">Confirm Password</label>
                                        <button type="button" class="btn btn-link password-toggle" onclick="togglePassword('password_confirmation')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill">
                                        <i class="fas fa-key me-2"></i>Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reset Password End -->
@endsection

@section('styles')
<style>
    .page-header {
        background: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url('{{ asset('css/img/bg-1.jpg') }}') center center no-repeat;
        background-size: cover;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: var(--bs-primary);
    }

    .form-control:focus {
        border-color: var(--bs-warning);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-warning-rgb), 0.25);
    }

    .password-field {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        background: none;
        border: none;
        color: var(--bs-primary);
        padding: 0;
        opacity: 0.7;
    }

    .password-toggle:hover {
        opacity: 1;
        color: var(--bs-warning);
    }

    .form-floating input:-webkit-autofill,
    .form-floating input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0 1000px white inset !important;
        -webkit-text-fill-color: #212529 !important;
    }
</style>
@endsection

@section('scripts')
<script>
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const icon = event.currentTarget.querySelector('i');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection