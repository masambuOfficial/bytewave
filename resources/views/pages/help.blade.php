@extends('layouts.app')

@section('title', 'Help Center - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">Help Center</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-warning active" aria-current="page">Help</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Help Center Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Quick Help Section -->
            <div class="row g-4 mb-5">
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fas fa-headset text-white fs-4"></i>
                        </div>
                        <h4 class="mb-3">Live Support</h4>
                        <p class="mb-4">Get immediate assistance from our expert support team during business hours.</p>
                        <a class="btn btn-warning px-4 py-2 rounded-pill" href="#" onclick="initLiveChat()">
                            <i class="fas fa-comments me-2"></i>Start Chat
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded h-100 p-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fas fa-ticket-alt text-white fs-4"></i>
                        </div>
                        <h4 class="mb-3">Support Ticket</h4>
                        <p class="mb-4">Create a support ticket for technical issues or complex inquiries.</p>
                        <a class="btn btn-warning px-4 py-2 rounded-pill" href="{{ url('/contact') }}">
                            <i class="fas fa-paper-plane me-2"></i>Submit Ticket
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item bg-light rounded h-100 p-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fas fa-book text-white fs-4"></i>
                        </div>
                        <h4 class="mb-3">Knowledge Base</h4>
                        <p class="mb-4">Browse our extensive collection of guides, tutorials, and FAQs.</p>
                        <a class="btn btn-warning px-4 py-2 rounded-pill" href="{{ url('/faqs') }}">
                            <i class="fas fa-search me-2"></i>Browse Articles
                        </a>
                    </div>
                </div>
            </div>

            <!-- Popular Topics -->
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="text-warning mb-4">Popular Topics</h2>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="bg-light rounded p-4">
                                <h5 class="mb-3">Getting Started</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <a href="#" class="text-secondary">
                                            <i class="fas fa-angle-right text-primary me-2"></i>How to request a quote
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-secondary">
                                            <i class="fas fa-angle-right text-primary me-2"></i>Project development process
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-secondary">
                                            <i class="fas fa-angle-right text-primary me-2"></i>Payment methods
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-secondary">
                                            <i class="fas fa-angle-right text-primary me-2"></i>Service level agreements
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light rounded p-4">
                                <h5 class="mb-3">Technical Support</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <a href="#" class="text-secondary">
                                            <i class="fas fa-angle-right text-primary me-2"></i>Website maintenance
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-secondary">
                                            <i class="fas fa-angle-right text-primary me-2"></i>Mobile app updates
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-secondary">
                                            <i class="fas fa-angle-right text-primary me-2"></i>Cloud hosting services
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-secondary">
                                            <i class="fas fa-angle-right text-primary me-2"></i>Security measures
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <h2 class="text-warning mb-4">Contact Information</h2>
                    <div class="bg-light rounded p-4">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-warning rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fas fa-phone text-white"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-1">Phone</h5>
                                        <p class="mb-0">+256 123 456 789</p>
                                        <small class="text-muted">Monday - Friday, 9:00 AM - 5:00 PM EAT</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-warning rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-1">Email</h5>
                                        <p class="mb-0">support@bytewave.com</p>
                                        <small class="text-muted">We usually respond within 24 hours</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-warning rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fas fa-map-marker-alt text-white"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-1">Office</h5>
                                        <p class="mb-0">Plot 123, Kampala Road</p>
                                        <small class="text-muted">Kampala, Uganda</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Help Center End -->
@endsection

@section('scripts')
<script>
    function initLiveChat() {
        // Initialize live chat functionality
        alert('Live chat feature coming soon!');
    }
</script>
@endsection
