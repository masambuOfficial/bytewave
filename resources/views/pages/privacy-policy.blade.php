@extends('layouts.app')

@section('title', 'Privacy Policy - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">Privacy Policy</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-warning active" aria-current="page">Privacy Policy</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Privacy Policy Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="wow fadeInUp" data-wow-delay="0.1s">
                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Introduction</h3>
                            <p>At BYTEWAVE, we take your privacy seriously. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Information We Collect</h3>
                            <p>We collect information that you provide directly to us when you:</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Fill out forms on our website</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Subscribe to our newsletter</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Request a quote or consultation</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Contact us via email or phone</li>
                            </ul>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">How We Use Your Information</h3>
                            <p>We use the information we collect to:</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Provide and maintain our services</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Improve our website and services</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Communicate with you about our services</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Send you marketing communications (with your consent)</li>
                            </ul>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Data Security</h3>
                            <p>We implement appropriate technical and organizational security measures to protect your personal information. However, please note that no method of transmission over the internet is 100% secure.</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Your Rights</h3>
                            <p>You have the right to:</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Access your personal information</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Correct inaccurate information</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Request deletion of your information</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Opt-out of marketing communications</li>
                            </ul>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Contact Us</h3>
                            <p>If you have any questions about this Privacy Policy, please contact us at:</p>
                            <div class="bg-light p-4 rounded">
                                <p class="mb-2"><i class="fas fa-envelope text-primary me-2"></i>Email: privacy@bytewave.com</p>
                                <p class="mb-2"><i class="fas fa-phone text-primary me-2"></i>Phone: +256 123 456 789</p>
                                <p class="mb-0"><i class="fas fa-map-marker-alt text-primary me-2"></i>Address: Plot 123, Kampala Road, Kampala, Uganda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Privacy Policy End -->
@endsection
