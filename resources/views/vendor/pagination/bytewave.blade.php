@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="inline-flex items-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="@lang('pagination.previous')" class="inline-flex items-center justify-center h-10 px-4 rounded-full border border-gray-200 text-gray-400 bg-white/60 cursor-not-allowed">
                <span class="text-sm font-medium">@lang('pagination.previous')</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="inline-flex items-center justify-center h-10 px-4 rounded-full border border-bytewave-blue/20 text-bytewave-blue bg-white hover:bg-bytewave-blue hover:text-white transition-colors">
                <span class="text-sm font-medium">@lang('pagination.previous')</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="hidden sm:inline-flex items-center gap-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true" class="inline-flex items-center justify-center h-10 px-4 rounded-full border border-gray-200 text-gray-400 bg-white">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="inline-flex items-center justify-center h-10 min-w-10 px-4 rounded-full bg-bytewave-gold text-white shadow-sm">
                                <span class="text-sm font-semibold">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $url }}" class="inline-flex items-center justify-center h-10 min-w-10 px-4 rounded-full border border-gray-200 text-gray-700 bg-white hover:border-bytewave-gold/40 hover:text-bytewave-blue hover:bg-bytewave-gold/10 transition-colors" aria-label="@lang('Go to page :page', ['page' => $page])">
                                <span class="text-sm font-medium">{{ $page }}</span>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="inline-flex items-center justify-center h-10 px-4 rounded-full border border-bytewave-blue/20 text-bytewave-blue bg-white hover:bg-bytewave-blue hover:text-white transition-colors">
                <span class="text-sm font-medium">@lang('pagination.next')</span>
            </a>
        @else
            <span aria-disabled="true" aria-label="@lang('pagination.next')" class="inline-flex items-center justify-center h-10 px-4 rounded-full border border-gray-200 text-gray-400 bg-white/60 cursor-not-allowed">
                <span class="text-sm font-medium">@lang('pagination.next')</span>
            </span>
        @endif
    </nav>
@endif
