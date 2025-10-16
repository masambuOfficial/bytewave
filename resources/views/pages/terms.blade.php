@extends('layouts.app')

@section('title', 'Terms of Service - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">Terms of Service</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-warning active" aria-current="page">Terms of Service</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Terms Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="wow fadeInUp" data-wow-delay="0.1s">
                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Agreement to Terms</h3>
                            <p>By accessing or using BYTEWAVE's services, you agree to be bound by these Terms of Service. If you disagree with any part of the terms, you may not access our services.</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Our Services</h3>
                            <p>BYTEWAVE provides the following digital services:</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Web Development & Design</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Mobile App Development</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Cloud Solutions</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Digital Marketing</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>IT Consulting</li>
                            </ul>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Intellectual Property</h3>
                            <p>The service and its original content, features, and functionality are owned by BYTEWAVE and are protected by international copyright, trademark, patent, trade secret, and other intellectual property laws.</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">User Responsibilities</h3>
                            <div class="bg-light p-4 rounded mb-4">
                                <h5 class="text-primary mb-3">You agree to:</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Provide accurate and complete information</li>
                                    <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Maintain the security of your account</li>
                                    <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Use services in compliance with applicable laws</li>
                                    <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Respect intellectual property rights</li>
                                </ul>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Payment Terms</h3>
                            <p>For services requiring payment:</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Payments are due as specified in service agreements</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>All fees are non-refundable unless stated otherwise</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Late payments may incur additional charges</li>
                            </ul>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Limitation of Liability</h3>
                            <p>BYTEWAVE shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of our services.</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Changes to Terms</h3>
                            <p>We reserve the right to modify these terms at any time. We will notify users of any material changes via email or through our website.</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Contact Information</h3>
                            <div class="bg-light p-4 rounded">
                                <p class="mb-2">For questions about these Terms, please contact us:</p>
                                <p class="mb-2"><i class="fas fa-envelope text-primary me-2"></i>Email: legal@bytewave.com</p>
                                <p class="mb-2"><i class="fas fa-phone text-primary me-2"></i>Phone: +256 123 456 789</p>
                                <p class="mb-0"><i class="fas fa-map-marker-alt text-primary me-2"></i>Address: Plot 123, Kampala Road, Kampala, Uganda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Terms End -->
@endsection
