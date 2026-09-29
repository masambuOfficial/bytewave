@props(['title' => 'Subscribe to our newsletter', 'description' => 'Get the latest articles and updates delivered to your inbox.'])

<div class="bg-bytewave-blue rounded-2xl p-8 text-white">
    <div class="max-w-2xl mx-auto text-center">
        <h3 class="text-2xl font-bold mb-2">{{ $title }}</h3>
        <p class="text-white mb-6">{{ $description }}</p>
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-bytewave-success rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            
            <input 
                type="email" 
                name="email" 
                placeholder="Enter your email"
                required
                class="flex-1 px-4 py-3 rounded-lg text-bytewave-ink focus:ring-2 focus:ring-white focus:outline-none"
                value="{{ old('email') }}"
            >
            
            <x-cta-button type="submit" text="Subscribe" variant="light" size="sm" class="justify-between sm:justify-start" />
        </form>
        
        @error('email')
            <p class="mt-2 text-sm text-white">{{ $message }}</p>
        @enderror
        
        <p class="mt-4 text-xs text-white">
            By subscribing, you agree to our Privacy Policy and consent to receive updates from BYTEWAVE.
        </p>
    </div>
</div>
