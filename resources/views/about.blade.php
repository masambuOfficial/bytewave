@extends('layouts.app')

@section('title', 'About Us - BYTEWAVE')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->



    <!-- About Start -->
    <div class="container-fluid py-5 my-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                    <div class="h-100 position-relative">
                        <img src="{{ asset('css/img/20210430_151808.jpg') }}" class="img-fluid w-75 rounded" alt=""
                             style="margin-bottom: 25%;">
                        <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                            <img src="{{ asset('img/about-2.jpg') }}" class="img-fluid w-100 rounded" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                    <h5 class="text-primary">About Us</h5>
                    <h1 class="mb-4 text-warning">About BYTEWAVE And Its Innovative IT Solutions</h1>
                    <p>At BYTEWAVE, we are passionate about leveraging technology to empower businesses and drive
                        innovation. Founded by Masambu Emanuel and Kasaija Gavin, we bring together a team of experts
                        dedicated to providing cutting-edge IT solutions tailored to your unique needs.</p>
                    <p class="mb-4">We believe in building strong partnerships with our clients, working closely with
                        you to understand your challenges and goals. Our commitment to excellence and customer
                        satisfaction sets us apart. Let us help you navigate the ever-evolving digital landscape and
                        achieve sustainable growth.</p>
                    <a href="{{ url('/contact') }}" class="btn btn-primary rounded-pill px-5 py-3 text-white">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

            <!-- Team Start -->
    <div class="container-fluid pb-5 mb-5 team">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Our Team</h5>
                <h1 class="text-warning">Meet Our Expert Team</h1>
            </div>

            <div class="row g-4 justify-content-center">  <!-- Center the boxes and add gap -->
                <!-- Masambu Emanuel -->
                <div class="col-md-4 wow fadeIn" data-wow-delay=".5s">  <!-- Smaller column width -->
                    <div class="rounded team-item">
                        <div class="team-content">
                            <div class="team-img-icon">
                                <div class="team-img rounded-circle mx-auto" style="width: 150px; height: 150px;"> <!-- Smaller image size -->
                                    <img src="{{ asset('img/team-1.jpg') }}" class="img-fluid w-100 rounded-circle"
                                         alt="Masambu Emanuel">
                                </div>
                                <div class="team-name text-center py-3">
                                    <h4 class="">Masambu Emanuel</h4>
                                    <p class="m-0">Founder</p>
                                </div>
                                <div class="team-icon d-flex justify-content-center pb-4">
                                    <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href="#"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href="#"><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href="#"><i
                                            class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href="#"><i
                                            class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kasaija Gavin -->
                <div class="col-md-4 wow fadeIn" data-wow-delay=".7s">  <!-- Smaller column width -->
                    <div class="rounded team-item">
                        <div class="team-content">
                            <div class="team-img-icon">
                                <div class="team-img rounded-circle mx-auto" style="width: 150px; height: 150px;"> <!-- Smaller image size -->
                                    <img src="{{ asset('css/img/gavin.jpg') }}" class="img-fluid w-100 rounded-circle"
                                         alt="Kasaija Gavin">
                                </div>
                                <div class="team-name text-center py-3">
                                    <h4 class="">Kasaija Gavin</h4>
                                    <p class="m-0">Co-Founder</p>
                                </div>
                                <div class="team-icon d-flex justify-content-center pb-4">
                                    <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href="#"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href="#"><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href="#"><i
                                            class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href="#"><i
                                            class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

          <!-- Fact Start -->
          <div class="container-fluid bg-warning py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".1s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-primary counter-value">99</h1>
                        <h5 class="text-white mt-1">Success in getting happy customer</h5>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".3s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-primary counter-value">25</h1>
                        <h5 class="text-white mt-1">Thousands of successful business</h5>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".5s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-primary counter-value">120</h1>
                        <h5 class="text-white mt-1">Total clients who love HighTech</h5>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".7s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-primary counter-value">5</h1>
                        <h5 class="text-white mt-1">Stars reviews given by satisfied clients</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact End -->


@endsection

@section('styles')
    <style>
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url('{{ asset('css/img/bg-1.jpg') }}') center center no-repeat;
            background-size: cover;
        }

        .page-header .breadcrumb-item + .breadcrumb-item::before {
            color: var(--bs-white);
        }

      
    </style>
@endsection