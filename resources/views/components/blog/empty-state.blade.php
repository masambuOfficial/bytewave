@props(['message' => 'No articles found'])

<div class="text-center py-16">
    <svg class="mx-auto h-24 w-24 text-bytewave-blue/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
    </svg>
    <h3 class="mt-4 text-lg font-medium text-bytewave-ink">{{ $message }}</h3>
    <p class="mt-2 text-sm text-bytewave-ink/70">Try adjusting your search or filter to find what you're looking for.</p>
    <div class="mt-6 flex justify-center">
        <x-cta-button :href="route('blog.all')" text="View all articles" size="sm" />
    </div>
</div>
