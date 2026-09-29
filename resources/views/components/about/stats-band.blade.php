@php
    // Single source of truth for the figures shown on the About page and the homepage.
    // 'target' counts up on scroll; a stat without 'target' is shown as plain text.
    $stats = [
        ['target' => 200,   'suffix' => '+', 'label' => 'Tourism enterprises onboarded to the Eco-Tour Portal'],
        ['target' => 20000, 'suffix' => '+', 'label' => 'Students served through the HESFB portal'],
        ['target' => 1000,  'suffix' => '+', 'label' => 'Guests managed at the UNESCO Engineering Week event'],
        ['text'   => '2024',                 'label' => 'Year incorporated in Uganda'],
    ];
@endphp

<section data-stats-band {{ $attributes->merge(['class' => 'bg-bytewave-blue py-12 md:py-16 relative overflow-hidden']) }} aria-label="BYTEWAVE in numbers">
    <!-- Animated Background Particles -->
    <div class="stats-band-particles absolute inset-0 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($stats as $stat)
                <div class="stats-band-item flex flex-col items-start text-left gap-2">
                    <span class="block w-8 h-[3px] bg-bytewave-gold" aria-hidden="true"></span>
                    @isset($stat['target'])
                        <p class="text-5xl md:text-6xl font-bold text-white" data-stats-counter data-target="{{ $stat['target'] }}" data-suffix="{{ $stat['suffix'] ?? '' }}">0{{ $stat['suffix'] ?? '' }}</p>
                    @else
                        <p class="text-5xl md:text-6xl font-bold text-white">{{ $stat['text'] }}</p>
                    @endisset
                    <p class="text-white text-base font-medium leading-tight">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@once
    <style>
        .stats-band-particles {
            background: none;
        }

        @keyframes stats-band-float {
            0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0.3; }
            50%      { transform: translateY(-20px) translateX(10px); opacity: 0.6; }
        }

        @keyframes stats-band-float-reverse {
            0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0.4; }
            50%      { transform: translateY(20px) translateX(-10px); opacity: 0.7; }
        }

        .stats-band-particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Dividers between stats: horizontal lines when stacked, vertical lines when side by side */
        .stats-band-item {
            border-top: 1px solid rgba(255, 255, 255, 0.55);
            padding-top: 1.5rem;
        }

        .stats-band-item:first-child {
            border-top: 0;
            padding-top: 0;
        }

        @media (min-width: 768px) {
            .stats-band-item:nth-child(2) {
                border-top: 0;
                padding-top: 0;
            }

            .stats-band-item:nth-child(even) {
                border-left: 1px solid rgba(255, 255, 255, 0.55);
                padding-left: 2rem;
            }
        }

        @media (min-width: 1024px) {
            .stats-band-item:nth-child(n+2) {
                border-top: 0;
                padding-top: 0;
                border-left: 1px solid rgba(255, 255, 255, 0.55);
                padding-left: 2rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .stats-band-particle { animation: none !important; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const format = (counter, n) => Math.round(n).toLocaleString('en-US') + (counter.dataset.suffix || '');
            const counters = document.querySelectorAll('[data-stats-counter]');

            // Without IntersectionObserver, show the final figures straight away
            if (!('IntersectionObserver' in window)) {
                counters.forEach((el) => { el.textContent = format(el, +el.dataset.target); });
                return;
            }

            const animateCounter = (counter) => {
                const target = +counter.dataset.target;

                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    counter.textContent = format(counter, target);
                    return;
                }

                const duration = 1800;
                const start = performance.now();
                const tick = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    counter.textContent = format(counter, target * eased);
                    if (progress < 1) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach((el) => observer.observe(el));

            // Floating particles in the band background
            document.querySelectorAll('.stats-band-particles').forEach((container) => {
                for (let i = 0; i < 30; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('stats-band-particle');

                    const size = Math.random() * 12 + 3;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100}%`;

                    const animation = i % 2 === 0 ? 'stats-band-float' : 'stats-band-float-reverse';
                    const duration = Math.random() * 3 + 2;
                    const delay = Math.random() * 2;
                    particle.style.animation = `${animation} ${duration}s ease-in-out ${delay}s infinite`;

                    container.appendChild(particle);
                }
            });
        });
    </script>
@endonce
