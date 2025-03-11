<div class="group w-full flex flex-col px-8 py-6 flex-grow rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-secondary-200/20 to-secondary-200/60 dark:from-dark-700/50 dark:to-dark-700/80 relative sm:hover:-translate-y-1 transition-transform min-h-36" 
    x-data="{ expanded: false, needsTruncate: false }"
    x-init="$nextTick(function () {
        setTimeout(() => {
            $el.style.minHeight = $el.parentNode.parentNode.offsetHeight + 'px';
        }, 30);
    })">

    <div class="flex items-center gap-3 mb-4">
        <x-curator-glider fallback="user" :media="$testimonial->image" format="webp" width="52" height="52" fit="crop" quality="70" class="w-14 h-14 flex-shrink-0 object-cover rounded-full" />

        <div class="flex flex-col gap-1">
            <p class="font-bold">{{ $testimonial->name }}</p>
            
            @if ($testimonial->job_title)
                <p>{{ $testimonial->job_title }}</p>
            @endif
        </div>
    </div>

    <p class="leading-loose dark:text-dark-200 line-clamp-3" 
        x-init="$nextTick(() => needsTruncate = $el.scrollHeight > $el.clientHeight)"
        :class="expanded ? 'line-clamp-none' : 'line-clamp-3'">{{ $testimonial->body }}</p>
    
    <template x-if="needsTruncate">
        <x-button styling="white" @click="expanded = !expanded" 
            class="text-sm font-semibold w-full bg-white/40 mt-3">
            <span x-text="expanded ? '{{ __('Read Less') }}' : '{{ __('Read More') }}'"></span>
        </x-button>
    </template>
</div>
