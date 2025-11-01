@props(['blog', 'parentId' => null])

<div class="bg-gray-50 rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">{{ $parentId ? 'Reply to comment' : 'Leave a comment' }}</h3>
    
    <form action="{{ route('blog.comments.store', $blog->slug) }}" method="POST">
        @csrf
        
        @if($parentId)
            <input type="hidden" name="parent_id" value="{{ $parentId }}">
        @endif
        
        @guest
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        @endguest
        
        <div class="mb-4">
            <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Comment *</label>
            <textarea 
                id="body" 
                name="body" 
                rows="4" 
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Share your thoughts..."
            >{{ old('body') }}</textarea>
            @error('body')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <button 
            type="submit"
            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors"
        >
            Post Comment
        </button>
    </form>
</div>
