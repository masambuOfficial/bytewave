@extends('layouts.app')

@section('title', 'Login - BYTEWAVE')

@section('content')
    <!-- Modern Login Section -->
    <section class="login-section py-12 md:py-20 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="login-grid">
                <!-- Left Side - Branding & Message -->
                <div class="login-branding">
                    <div class="branding-content">
                        <div class="logo-wrapper">
                            <i class="fas fa-wave-square"></i>
                        </div>
                        <h2 class="brand-title">BYTEWAVE</h2>
                        <p class="brand-tagline">Innovative IT Solutions</p>
                        <div class="feature-list">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Secure Authentication</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Enterprise Grade</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>24/7 Support</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="login-form-wrapper">
                    <div class="form-container">
                        <div class="form-header">
                            <h1>Welcome Back</h1>
                            <p>Sign in to your account to continue</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-minimal" role="alert">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $errors->first() }}</span>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-envelope"></i>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        class="form-input @error('email') input-error @enderror" 
                                        value="{{ old('email') }}" 
                                        placeholder="you@example.com"
                                        required 
                                        autofocus>
                                </div>
                                @error('email')
                                    <span class="error-message">
                                        <i class="fas fa-times-circle"></i> {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group">
                                <div class="label-wrapper">
                                    <label for="password" class="form-label">Password</label>
                                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot?</a>
                                </div>
                                <div class="input-wrapper">
                                    <i class="fas fa-lock"></i>
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        class="form-input @error('password') input-error @enderror" 
                                        placeholder="••••••••"
                                        required>
                                </div>
                                @error('password')
                                    <span class="error-message">
                                        <i class="fas fa-times-circle"></i> {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="form-group checkbox-group">
                                <input type="checkbox" id="remember" name="remember" class="checkbox-input">
                                <label for="remember" class="checkbox-label">Remember me for 30 days</label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="login-button">
                                <span>Sign In</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>

                            <!-- Divider -->
                            <div class="divider">
                                <span>Don't have an account?</span>
                            </div>

                            <!-- Sign Up Link -->
                            <a href="#" class="signup-button" disabled onclick="return false;">
                                <span>Create Account</span>
                                <i class="fas fa-user-plus"></i>
                            </a>
                        </form>

                        <!-- Footer -->
                        <div class="form-footer">
                            <p>By signing in, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .login-section {
        position: relative;
        overflow: hidden;
        min-height: calc(100vh - 200px);
    }

    /* Animated background elements */
    .login-section::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        top: -200px;
        left: -200px;
        animation: float 20s ease-in-out infinite;
    }

    .login-section::after {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -150px;
        right: -150px;
        animation: float 25s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(30px); }
    }

    .login-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(148, 163, 184, 0.1);
        position: relative;
        z-index: 10;
    }

    /* Left Side - Branding */
    .login-branding {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.4) 0%, rgba(59, 130, 246, 0.2) 100%);
        padding: 60px 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-right: 1px solid rgba(148, 163, 184, 0.1);
    }

    .branding-content {
        text-align: center;
    }

    .logo-wrapper {
        font-size: 60px;
        color: #3b82f6;
        margin-bottom: 20px;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.8; }
    }

    .brand-title {
        font-size: 32px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }

    .brand-tagline {
        font-size: 14px;
        color: #94a3b8;
        margin-bottom: 40px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .feature-list {
        text-align: left;
    }

    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        color: #cbd5e1;
        font-size: 14px;
    }

    .feature-item i {
        color: #10b981;
        margin-right: 12px;
        font-size: 16px;
    }

    /* Right Side - Form */
    .login-form-wrapper {
        padding: 60px 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-container {
        width: 100%;
        max-width: 350px;
    }

    .form-header {
        margin-bottom: 40px;
    }

    .form-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 8px;
    }

    .form-header p {
        font-size: 14px;
        color: #94a3b8;
    }

    /* Alert */
    .alert-minimal {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fca5a5;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .alert-minimal i {
        font-size: 16px;
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 24px;
    }

    .label-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #cbd5e1;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .forgot-link {
        font-size: 12px;
        color: #3b82f6;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .forgot-link:hover {
        color: #60a5fa;
    }

    /* Input Wrapper */
    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-wrapper i {
        position: absolute;
        left: 16px;
        color: #64748b;
        font-size: 16px;
        pointer-events: none;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px 14px 48px;
        background: rgba(30, 41, 59, 0.8);
        border: 1px solid rgba(148, 163, 184, 0.2);
        border-radius: 10px;
        color: #ffffff;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-input::placeholder {
        color: #64748b;
    }

    .form-input:focus {
        outline: none;
        background: rgba(30, 41, 59, 1);
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input.input-error {
        border-color: #ef4444;
    }

    .form-input.input-error:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .error-message {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #fca5a5;
        font-size: 12px;
        margin-top: 6px;
    }

    /* Checkbox */
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 28px;
    }

    .checkbox-input {
        width: 18px;
        height: 18px;
        accent-color: #3b82f6;
        cursor: pointer;
    }

    .checkbox-label {
        font-size: 13px;
        color: #94a3b8;
        cursor: pointer;
        margin: 0;
    }

    /* Buttons */
    .login-button {
        width: 100%;
        padding: 14px 16px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    .login-button:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
    }

    .login-button:active {
        transform: translateY(0);
    }

    /* Divider */
    .divider {
        text-align: center;
        margin-bottom: 20px;
        font-size: 13px;
        color: #64748b;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: rgba(148, 163, 184, 0.2);
        z-index: 0;
    }

    .divider span {
        position: relative;
        background: rgba(15, 23, 42, 0.8);
        padding: 0 10px;
        z-index: 1;
    }

    /* Sign Up Button */
    .signup-button {
        width: 100%;
        padding: 14px 16px;
        background: transparent;
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .signup-button:hover {
        background: rgba(59, 130, 246, 0.1);
        border-color: rgba(59, 130, 246, 0.6);
        color: #60a5fa;
    }

    .signup-button[disabled] {
        opacity: 0.5;
        cursor: not-allowed;
        border-color: rgba(59, 130, 246, 0.15);
    }

    .signup-button[disabled]:hover {
        background: transparent;
        border-color: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
    }

    /* Form Footer */
    .form-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 11px;
        color: #64748b;
    }

    .form-footer a {
        color: #3b82f6;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .form-footer a:hover {
        color: #60a5fa;
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-grid {
            grid-template-columns: 1fr;
        }

        .login-branding {
            padding: 40px 30px;
            border-right: none;
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
            min-height: 250px;
        }

        .login-form-wrapper {
            padding: 40px 30px;
        }

        .form-container {
            max-width: 100%;
        }

        .brand-title {
            font-size: 24px;
        }

        .form-header h1 {
            font-size: 24px;
        }

        .feature-list {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .login-branding {
            padding: 30px 20px;
        }

        .login-form-wrapper {
            padding: 30px 20px;
        }

        .form-input {
            padding: 12px 14px 12px 44px;
            font-size: 16px;
        }

        .login-button,
        .signup-button {
            padding: 12px 14px;
            font-size: 13px;
        }
    }
</style>
@endsection