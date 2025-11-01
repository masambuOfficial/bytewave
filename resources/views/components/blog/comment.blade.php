@props(['comment'])

<div class="flex space-x-4" id="comment-{{ $comment->id }}">
    <div class="flex-shrink-0">
        @if($comment->user)
            <img 
                src="{{ $comment->user->avatar ?? asset('images/default-avatar.png') }}" 
                alt="{{ $comment->author_name }}"
                class="w-10 h-10 rounded-full"
            >
        @else
            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-semibold">
                {{ substr($comment->name, 0, 1) }}
            </div>
        @endif
    </div>
    
    <div class="flex-1">
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center justify-between mb-2">
                <h4 class="font-semibold text-gray-900">{{ $comment->author_name }}</h4>
                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            
            <p class="text-gray-700">{{ $comment->body }}</p>
        </div>
        
        <div class="mt-2 flex items-center space-x-4 text-sm">
            <button 
                @click="replyTo = replyTo === {{ $comment->id }} ? null : {{ $comment->id }}"
                class="text-blue-600 hover:text-blue-700 font-medium"
            >
                Reply
            </button>
        </div>
        
        <!-- Reply Form -->
        <div x-show="replyTo === {{ $comment->id }}" x-cloak class="mt-4">
            <x-blog.comment-form :blog="$comment->blog" :parentId="$comment->id" />
        </div>
        
        <!-- Replies -->
        @if($comment->replies && $comment->replies->isNotEmpty())
            <div class="mt-4 space-y-4 pl-6 border-l-2 border-gray-200">
                @foreach($comment->replies as $reply)
                    <x-blog.comment :comment="$reply" />
                @endforeach
            </div>
        @endif
    </div>
</div>
