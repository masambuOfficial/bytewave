@extends('layouts.app')

@section('title', 'Contact Us - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">Contact Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-warning active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto" style="max-width: 600px;">
                <h5 class="text-primary fw-medium">Get In Touch</h5>
                <h1 class="mb-4 text-warning">Contact Us for Any Query</h1>
                <p class="mb-5 text-muted">Have questions about our services? Need technical support? Want to discuss a project? We're here to help!</p>
            </div>

            <!-- Contact Info Cards -->
            <div class="row gy-4 mb-5">
                <div class="col-md-4">
                    <div class="contact-info-card h-100">
                        <div class="icon-box">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4>Our Location</h4>
                        <p>Kampala, Uganda</p>
                        <a href="https://goo.gl/maps/yourlink" target="_blank" class="text-primary">Get Directions <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card h-100">
                        <div class="icon-box">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h4>Call Us</h4>
                        <p class="mb-2">24/7 Support Line</p>
                        <a href="0782440907" class="text-primary">+25673448069/+256782440907</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card h-100">
                        <div class="icon-box">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h4>Email Us</h4>
                        <p class="mb-2">For General Inquiries</p>
                        <a href="mailto:info@bytewave.com" class="text-primary">info@bytewave.com</a>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                <!-- Map -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                    <div class="h-100">
                        <div class="map-container rounded overflow-hidden">
                            <iframe class="position-relative w-100 h-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7538176143337!2d32.58561661475455!3d0.3152859997438399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbb0932c4cd25%3A0x2f4c1fb25bc80b73!2sKampala%2C%20Uganda!5e0!3m2!1sen!2sus!4v1675946338901!5m2!1sen!2sus"
                                style="min-height: 450px; border: 0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                    <div class="contact-form-wrapper">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" placeholder="Your Name" 
                                               value="{{ old('name') }}" required>
                                        <label for="name">Your Name</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" placeholder="Your Email"
                                               value="{{ old('email') }}" required>
                                        <label for="email">Your Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                               id="subject" name="subject" placeholder="Subject"
                                               value="{{ old('subject') }}" required>
                                        <label for="subject">Subject</label>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                                  id="message" name="message" placeholder="Leave a message here" 
                                                  style="height: 150px" required>{{ old('message') }}</textarea>
                                        <label for="message">Message</label>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-warning py-3 px-5" type="submit">
                                        <i class="fas fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@section('styles')
<style>
    /* Page Header */
    .page-header {
        background: linear-gradient(rgba(0, 0, 0, .65), rgba(0, 0, 0, .65)), url('{{ asset('css/img/bg-1.jpg') }}') center center no-repeat;
        background-size: cover;
    }

    .page-header .breadcrumb-item + .breadcrumb-item::before {
        color: #fff;
    }

    .page-header .breadcrumb-item,
    .page-header .breadcrumb-item a {
        font-size: 1.1rem;
        color: #fff;
    }

    /* Contact Info Cards */
    .contact-info-card {
        background: #fff;
        padding: 2rem;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 0 45px rgba(0, 0, 0, .08);
        transition: .5s;
    }

    .contact-info-card:hover {
        transform: translateY(-10px);
    }

    .contact-info-card .icon-box {
        width: 65px;
        height: 65px;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 25px;
    }

    .contact-info-card .icon-box i {
        color: #fff;
        font-size: 1.5rem;
    }

    .contact-info-card h4 {
        font-size: 1.2rem;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .contact-info-card p {
        color: #666;
        margin-bottom: 5px;
    }

    /* Contact Form */
  

    .form-floating {
        position: relative;
    }

    .form-floating > .form-control {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }

    .form-floating > textarea.form-control {
        height: auto;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        opacity: .65;
        transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .form-floating > label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        padding: 1rem 0.75rem;
        pointer-events: none;
        border: 1px solid transparent;
        transform-origin: 0 0;
        transition: opacity .1s ease-in-out, transform .1s ease-in-out;
    }

    /* Map */
    .map-container {
        position: relative;
        padding-top: 56.25%;
        height: 0;
        box-shadow: 0 0 45px rgba(0, 0, 0, .08);
    }

    .map-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .contact-info-card {
            margin-bottom: 1.5rem;
        }
    }
</style>
@endsection