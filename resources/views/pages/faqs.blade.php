@extends('layouts.app')

@section('title', 'Frequently Asked Questions - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">FAQs</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-warning active" aria-current="page">FAQs</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- FAQs Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <!-- General Questions -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="text-warning mb-4">General Questions</h2>
                    <div class="accordion" id="accordionGeneral">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="general1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeneral1">
                                    What services does BYTEWAVE offer?
                                </button>
                            </h2>
                            <div id="collapseGeneral1" class="accordion-collapse collapse show" data-bs-parent="#accordionGeneral">
                                <div class="accordion-body">
                                    BYTEWAVE offers a comprehensive range of digital services including web development, mobile app development, cloud solutions, digital marketing, and IT consulting. We specialize in creating custom solutions tailored to your business needs.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="general2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeneral2">
                                    How long has BYTEWAVE been in business?
                                </button>
                            </h2>
                            <div id="collapseGeneral2" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                                <div class="accordion-body">
                                    BYTEWAVE has been providing digital solutions in Uganda and East Africa for over 5 years. Our team has extensive experience in the technology sector and has successfully delivered numerous projects across various industries.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="general3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeneral3">
                                    What makes BYTEWAVE different from other companies?
                                </button>
                            </h2>
                            <div id="collapseGeneral3" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                                <div class="accordion-body">
                                    We stand out through our commitment to quality, innovative solutions, local expertise, and dedicated customer support. Our team stays up-to-date with the latest technologies to deliver cutting-edge solutions that drive business growth.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technical Questions -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h2 class="text-warning mb-4">Technical Questions</h2>
                    <div class="accordion" id="accordionTechnical">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="technical1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech1">
                                    What technologies do you use?
                                </button>
                            </h2>
                            <div id="collapseTech1" class="accordion-collapse collapse show" data-bs-parent="#accordionTechnical">
                                <div class="accordion-body">
                                    We use a wide range of modern technologies including Laravel, React, Vue.js, Flutter, AWS, and more. Our technology stack is chosen based on project requirements to ensure the best possible solution for each client.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="technical2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech2">
                                    How do you ensure project security?
                                </button>
                            </h2>
                            <div id="collapseTech2" class="accordion-collapse collapse" data-bs-parent="#accordionTechnical">
                                <div class="accordion-body">
                                    We implement industry-standard security practices including SSL encryption, secure coding practices, regular security audits, and data encryption. We also provide security training to our team and stay updated on the latest security threats.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="technical3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTech3">
                                    Do you provide maintenance and support?
                                </button>
                            </h2>
                            <div id="collapseTech3" class="accordion-collapse collapse" data-bs-parent="#accordionTechnical">
                                <div class="accordion-body">
                                    Yes, we offer comprehensive maintenance and support packages. Our support team is available during business hours, and we provide emergency support for critical issues. We also offer regular updates and monitoring services.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="col-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded p-5 mt-4">
                        <div class="row g-4">
                            <div class="col-lg-8">
                                <h3 class="text-warning mb-4">Still Have Questions?</h3>
                                <p class="mb-4">Can't find the answer you're looking for? Please contact our friendly team.</p>
                            </div>
                            <div class="col-lg-4 text-lg-end d-flex align-items-center">
                                <a href="{{ url('/contact') }}" class="btn btn-warning rounded-pill py-3 px-5">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs End -->
@endsection

@section('styles')
<style>
    .accordion-button:not(.collapsed) {
        color: var(--bs-warning);
        background-color: rgba(var(--bs-warning-rgb), 0.1);
    }

    .accordion-button:focus {
        border-color: var(--bs-warning);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-warning-rgb), 0.25);
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffc107'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
</style>
@endsection
