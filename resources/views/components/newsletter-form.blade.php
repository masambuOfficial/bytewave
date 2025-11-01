@props(['title' => 'Subscribe to our newsletter', 'description' => 'Get the latest articles and updates delivered to your inbox.'])

<div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-8 text-white">
    <div class="max-w-2xl mx-auto text-center">
        <h3 class="text-2xl font-bold mb-2">{{ $title }}</h3>
        <p class="text-blue-100 mb-6">{{ $description }}</p>
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-500 rounded-lg">
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
                class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-white focus:outline-none"
                value="{{ old('email') }}"
            >
            
            <button 
                type="submit"
                class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors"
            >
                Subscribe
            </button>
        </form>
        
        @error('email')
            <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
        @enderror
        
        <p class="mt-4 text-xs text-blue-200">
            By subscribing, you agree to our Privacy Policy and consent to receive updates from BYTEWAVE.
        </p>
    </div>
</div>
