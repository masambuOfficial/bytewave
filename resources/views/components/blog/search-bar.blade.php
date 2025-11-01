@props(['value' => ''])

<div class="relative" x-data="{ focused: false }">
    <form action="{{ route('blog.all') }}" method="GET" class="relative">
        <input 
            type="text" 
            name="search" 
            value="{{ $value }}"
            placeholder="Search articles..."
            class="w-full px-4 py-3 pl-12 pr-4 text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            @focus="focused = true"
            @blur="focused = false"
        >
        <svg 
            class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 transition-colors"
            :class="focused ? 'text-blue-500' : 'text-gray-400'"
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </form>
</div>
