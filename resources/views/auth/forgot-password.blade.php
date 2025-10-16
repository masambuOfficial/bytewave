@extends('layouts.app')

@section('title', 'Forgot Password - BYTEWAVE')

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

    <!-- Forgot Password Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded p-5">
                        <div class="text-center mb-5">
                            <h5 class="text-primary">Forgot Password?</h5>
                            <h1 class="text-warning mb-4">Reset Your Password</h1>
                            <p class="text-muted">Enter your email address and we'll send you a link to reset your password.</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="Your Email"
                                               required 
                                               autofocus>
                                        <label for="email">Email Address</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill">
                                        <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                                    </button>
                                </div>
                                <div class="col-12 text-center">
                                    <a href="{{ route('login') }}" class="text-primary">
                                        <i class="fas fa-arrow-left me-1"></i>Back to Login
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Forgot Password End -->
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

    .alert {
        border: none;
        border-radius: 10px;
    }

    .alert-success {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
</style>
@endsection