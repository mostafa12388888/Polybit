<span>
    @if($items_count)
        @if ($bottom_navbar)
            <span class="font-bold text-xs w-5 h-5 bg-dark-500 text-white rounded-full flex items-center justify-center absolute -top-3 ltr:left-3 rtl:right-3">
                {{ $items_count }}
            </span>
        @else
            <span class="text-xs w-6 h-6 bg-dark-500 text-white rounded-full flex items-center justify-center absolute -top-2 ltr:-left-1 rtl:-right-1">
                {{ $items_count }}
            </span>
        @endif
    @endif
</span>
