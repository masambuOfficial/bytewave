<!-- Footer Start -->
<div class="w-full footer bg-bytewave-blue wow fadeIn" data-wow-delay="0.1s">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ url('/') }}" class="inline-block mb-4 overflow-hidden">
                    <img src="{{ asset('images/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="BYTEWAVE Logo" class="w-64 -ml-4">
                </a>
                <p class="mt-4 text-white">Your trusted technology partner, delivering innovative solutions and driving digital transformation for businesses across Uganda and East Africa.</p>
                <div class="flex gap-3 mt-4">
                    <a href="#" class="social-icon group w-10 h-10 rounded-full border-2 border-white text-white flex items-center justify-center transition-all duration-300 ease-out hover:bg-white hover:text-bytewave-blue hover:-translate-y-1 hover:shadow-lg" title="Facebook" aria-label="Facebook">
                        <i class="fab fa-facebook-f transition-transform duration-300 group-hover:scale-110"></i>
                    </a>
                    <a href="#" class="social-icon group w-10 h-10 rounded-full border-2 border-white text-white flex items-center justify-center transition-all duration-300 ease-out hover:bg-white hover:text-bytewave-blue hover:-translate-y-1 hover:shadow-lg" title="Twitter" aria-label="Twitter">
                        <i class="fab fa-twitter transition-transform duration-300 group-hover:scale-110"></i>
                    </a>
                    <a href="#" class="social-icon group w-10 h-10 rounded-full border-2 border-white text-white flex items-center justify-center transition-all duration-300 ease-out hover:bg-white hover:text-bytewave-blue hover:-translate-y-1 hover:shadow-lg" title="Instagram" aria-label="Instagram">
                        <i class="fab fa-instagram transition-transform duration-300 group-hover:scale-110"></i>
                    </a>
                    <a href="#" class="social-icon group w-10 h-10 rounded-full border-2 border-white text-white flex items-center justify-center transition-all duration-300 ease-out hover:bg-white hover:text-bytewave-blue hover:-translate-y-1 hover:shadow-lg" title="LinkedIn" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in transition-transform duration-300 group-hover:scale-110"></i>
                    </a>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.3s">
                <h3 class="text-white mb-3 text-xl font-bold">Quick Links</h3>
                <span class="block w-10 h-[3px] bg-bytewave-gold mb-5" aria-hidden="true"></span>
                <div class="flex flex-col items-start space-y-2">
                    <a href="{{ url('/about') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>About Us
                    </a>
                    <a href="{{ url('/contact') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>Contact Us
                    </a>
                    <a href="{{ url('/services') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>Our Services
                    </a>
                    <a href="{{ url('/products') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>Our Solutions
                    </a>
                    <a href="{{ url('/portfolios') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>Our Portfolio
                    </a>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.5s">
                <h3 class="text-white mb-3 text-xl font-bold">Our Services</h3>
                <span class="block w-10 h-[3px] bg-bytewave-gold mb-5" aria-hidden="true"></span>
                <div class="flex flex-col items-start space-y-2">
                    <a href="{{ url('/services') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>Software Engineering
                    </a>
                    <a href="{{ url('/services') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>Web Development
                    </a>
                    <a href="{{ route('services.audio-visual') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>Livestreaming
                    </a>
                    <a href="{{ route('services.audio-visual') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>Photography
                    </a>
                    <a href="{{ route('services.audio-visual') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>AV Production
                    </a>
                    <a href="{{ url('/services') }}" class="text-white font-medium inline-block transition-transform duration-300 hover:translate-x-2">
                        <i class="fas fa-angle-right text-bytewave-gold mr-2"></i>ICT Supply
                    </a>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.7s">
                <h3 class="text-white mb-3 text-xl font-bold">Get In Touch</h3>
                <span class="block w-10 h-[3px] bg-bytewave-gold mb-5" aria-hidden="true"></span>
                <div class="text-white flex flex-col space-y-3">
                    <div class="pb-3 border-b border-white/30">
                        <a href="https://maps.google.com" target="_blank" class="text-white flex gap-2 transition-transform duration-300 hover:translate-x-2">
                            <i class="fas fa-map-marker-alt text-bytewave-gold mt-1 flex-shrink-0"></i>
                            <div>
                                <div>P.O. Box 156535 Kampala GPO (U)</div>
                                <div>Tower of Faith Building Level 01</div>
                                <div>Suite No. 01 - West Wing Plot 5134</div>
                            </div>
                        </a>
                    </div>
                    <div class="py-3 border-b border-white/30">
                        <a href="tel:{{ config('company.phone') }}" class="text-white flex gap-2 transition-transform duration-300 hover:translate-x-2">
                            <i class="fas fa-phone-alt text-bytewave-gold mt-1 flex-shrink-0"></i>
                            <span>{{ config('company.phone') }}</span>
                        </a>
                    </div>
                    <div class="py-3 border-b border-white/30">
                        <a href="mailto:info@bytewaveinvestments.com" class="text-white flex gap-2 transition-transform duration-300 hover:translate-x-2">
                            <i class="fas fa-envelope text-bytewave-gold mt-1 flex-shrink-0"></i>
                            <span>info@bytewaveinvestments.com</span>
                        </a>
                    </div>
                    <div class="pt-3">
                        <p class="mb-1 font-semibold">Open Hours:</p>
                        <small class="text-white">
                            Monday - Friday: 9:00 AM - 5:00 PM<br>
                            Saturday: 9:00 AM - 1:00 PM
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-white/30 mt-8 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="text-center md:text-left">
                <span class="text-white">&copy; {{ date('Y') }} <a href="{{ url('/') }}" class="text-white font-bold hover:underline">BYTEWAVE</a>. All rights reserved.</span>
            </div>
            <div class="text-center md:text-right">
                <div class="footer-menu space-x-4">
                    <a href="{{ url('/privacy-policy') }}" class="text-white hover:underline underline-offset-4">Privacy</a>
                    <a href="{{ url('/terms') }}" class="text-white hover:underline underline-offset-4">Terms</a>
                    <a href="{{ url('/faqs') }}" class="text-white hover:underline underline-offset-4">FAQs</a>
                    <a href="{{ url('/help') }}" class="text-white hover:underline underline-offset-4">Help</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="fixed bottom-8 right-8 opacity-0 pointer-events-none bg-bytewave-ink border-2 border-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:-translate-y-1 transition-all duration-300 back-to-top z-50" aria-label="Back to top">
    <i class="fa fa-arrow-up text-bytewave-gold"></i>
</a>

