@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <button disabled aria-disabled="true" aria-label="{{ __('pagination.previous') }}" 
                    class="relative inline-flex items-center px-5 py-3 text-sm font-medium text-gray-400 bg-white border border-gray-100 cursor-default leading-5 rounded-md dark:text-gray-500 dark:bg-zinc-700 dark:border-zinc-600/50">
                    {!! __('pagination.previous') !!}
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-5 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-100 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-zinc-700 dark:border-zinc-600/50 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-5 py-3 ms-3 text-sm font-medium text-gray-700 bg-white border border-gray-100 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-zinc-700 dark:border-zinc-600/50 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <button disabled aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                    class="relative inline-flex items-center px-5 py-3 ms-3 text-sm font-medium text-gray-400 bg-white border border-gray-100 cursor-default leading-5 rounded-md dark:text-gray-500 dark:bg-zinc-700 dark:border-zinc-600/50">
                    {!! __('pagination.next') !!}
                </button>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex items-center justify-center">
            <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <button disabled aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span class="relative inline-flex items-center px-3 py-3 text-sm font-medium text-gray-400 bg-white border border-gray-100 cursor-default rounded-l-md leading-5 dark:bg-zinc-700 dark:border-zinc-600/50" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-3 text-sm font-medium text-gray-500 bg-white border border-gray-100 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-zinc-700 dark:border-zinc-600/50 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.previous') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <button disabled aria-disabled="true">
                            <span class="relative inline-flex items-center px-5 py-3 -ms-px text-sm font-medium text-gray-700 bg-white border border-gray-100 cursor-default leading-5 dark:bg-zinc-700 dark:border-zinc-600/50">{{ $element }}</span>
                        </button>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button aria-current="page">
                                    <span class="relative inline-flex items-center px-5 py-3 -ms-px text-sm font-medium text-gray-400 bg-white border border-gray-100 cursor-default leading-5 dark:bg-zinc-700 dark:border-zinc-600/50">{{ $page }}</span>
                                </button>
                            @else
                                <a href="{{ $url }}" class="relative inline-flex items-center px-5 py-3 -ms-px text-sm font-medium text-gray-700 bg-white border border-gray-100 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-zinc-700 dark:border-zinc-600/50 dark:text-gray-200 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-3 -ms-px text-sm font-medium text-gray-500 bg-white border border-gray-100 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-zinc-700 dark:border-zinc-600/50 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.next') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <button disabled aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span class="relative inline-flex items-center px-3 py-3 -ms-px text-sm font-medium text-gray-400 bg-white border border-gray-100 cursor-default rounded-r-md leading-5 dark:bg-zinc-700 dark:border-zinc-600/50" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                @endif
            </span>
        </div>
    </nav>
@endif
