<!-- Footer Start -->
<div class="container-fluid footer bg-primary wow fadeIn" data-wow-delay="0.1s">
    <div class="container pt-5 pb-4">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ url('/') }}" class="d-inline-block">
                    <h1 class="text-white fw-bold">BYTE<span class="text-warning">WAVE</span></h1>
                </a>
                <p class="mt-4 text-light">Your trusted technology partner, delivering innovative solutions and driving digital transformation for businesses across Uganda and East Africa.</p>
                <div class="d-flex hightech-link">
                    <a href="#" class="btn-light nav-fill btn btn-square rounded-circle me-2 social-icon" title="Facebook">
                        <i class="fab fa-facebook-f text-primary"></i>
                    </a>
                    <a href="#" class="btn-light nav-fill btn btn-square rounded-circle me-2 social-icon" title="Twitter">
                        <i class="fab fa-twitter text-primary"></i>
                    </a>
                    <a href="#" class="btn-light nav-fill btn btn-square rounded-circle me-2 social-icon" title="Instagram">
                        <i class="fab fa-instagram text-primary"></i>
                    </a>
                    <a href="#" class="btn-light nav-fill btn btn-square rounded-circle me-0 social-icon" title="LinkedIn">
                        <i class="fab fa-linkedin-in text-primary"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <h3 class="text-warning mb-4">Quick Links</h3>
                <div class="d-flex flex-column short-link">
                    <a href="{{ url('/about') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>About Us
                    </a>
                    <a href="{{ url('/contact') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>Contact Us
                    </a>
                    <a href="{{ url('/services') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>Our Services
                    </a>
                    <a href="{{ url('/products') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>Our Solutions
                    </a>
                    <a href="{{ url('/portfolios') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>Our Portfolio
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <h3 class="text-warning mb-4">Our Services</h3>
                <div class="d-flex flex-column help-link">
                    <a href="{{ url('/services#web-development') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>Web Development
                    </a>
                    <a href="{{ url('/services#mobile-apps') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>Mobile Apps
                    </a>
                    <a href="{{ url('/services#cloud-solutions') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>Cloud Solutions
                    </a>
                    <a href="{{ url('/services#digital-marketing') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>Digital Marketing
                    </a>
                    <a href="{{ url('/services#it-consulting') }}" class="mb-2 text-white">
                        <i class="fas fa-angle-right text-warning me-2"></i>IT Consulting
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <h3 class="text-warning mb-4">Get In Touch</h3>
                <div class="text-white d-flex flex-column contact-link">
                    <a href="https://maps.google.com" target="_blank" class="pb-3 text-light border-bottom border-primary">
                        <i class="fas fa-map-marker-alt text-warning me-2"></i>
                        Plot 123, Kampala Road
                        Kampala, Uganda
                    </a>
                    <a href="tel:+256123456789" class="py-3 text-light border-bottom border-primary">
                        <i class="fas fa-phone-alt text-warning me-2"></i>
                        +256 123 456 789
                    </a>
                    <a href="mailto:info@bytewaveinvestments.com" class="py-3 text-light border-bottom border-primary">
                        <i class="fas fa-envelope text-warning me-2"></i>
                        info@bytewaveinvestments.com
                    </a>
                    <div class="pt-3">
                        <p class="mb-1">Open Hours:</p>
                        <small class="text-light">
                            Monday - Friday: 9:00 AM - 5:00 PM<br>
                            Saturday: 9:00 AM - 1:00 PM
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <hr class="text-light mt-5 mb-4">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <span class="text-light">&copy; {{ date('Y') }} <a href="{{ url('/') }}" class="text-warning">BYTEWAVE</a>. All rights reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="footer-menu">
                    <a href="{{ url('/privacy-policy') }}" class="text-light me-3">Privacy</a>
                    <a href="{{ url('/terms') }}" class="text-light me-3">Terms</a>
                    <a href="{{ url('/faqs') }}" class="text-light me-3">FAQs</a>
                    <a href="{{ url('/help') }}" class="text-light">Help</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-warning btn-square rounded-circle back-to-top">
    <i class="fa fa-arrow-up text-white"></i>
</a>