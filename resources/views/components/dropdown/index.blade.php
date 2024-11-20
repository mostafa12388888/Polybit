@props(['align' => 'end', 'width' => '48', 'contentClasses' => '', 'dropdownClasses' => '', 'wrapperClasses' => 'relative', 'triggerClasses' => 'flex-grow flex flex-wrap', 'openOnHover' => false])

@php
switch ($align) {
    case 'start':
        $alignmentClasses = 'origin-top-left left-0 rtl:origin-top-right rtl:right-0 rtl:left-auto';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'none':
    case 'false':
        $alignmentClasses = '';
        break;
    case 'end':
    default:
        $alignmentClasses = 'origin-top-right right-0 rtl:origin-top-left rtl:left-0 rtl:right-auto';
        break;
}
@endphp

<div class="{{ $wrapperClasses }}" 
    x-data="{
        id: null,
        open: false,
        expanded: false,
        shouldBeExpanded: false,
        toggleOpen () {
            this.open = ! this.open
            this.expanded = this.open
        },
        expand () {
            this.shouldBeExpanded = true
            setTimeout(() => {
                if(this.shouldBeExpanded) 
                    this.expanded = true
                $dispatch('dropdown-expanded', this.id)
            }, 100); 
        },
        collapse () {
            this.shouldBeExpanded = false
            setTimeout(() => {
                if(! this.shouldBeExpanded) 
                    this.expanded = false
            }, 100);
        },
        close () {
            this.collapse()
            this.open = false
        }
    }" 
    @click.away="close" 
    @close.stop="close"
    x-trap.inert.noautofocus="open || expanded"
    @keydown.down="$focus.wrap().next()"
    @keydown.up="$focus.wrap().previous()"
    @dropdown-expanded.window="if($event.detail != id) open = expanded = shouldBeExpanded = false"
    @keyup.escape.window="close"
    @if ($openOnHover)
        @pointerenter.self="if($event.pointerType == 'mouse') expand()" 
        @mouseleave="collapse"
    @endif
    x-init="id = Math.random().toString(36).substr(2)"
>
    <div class="{{ $triggerClasses }}" @click="toggleOpen">
        {{ $trigger }}
    </div>

    <div x-bind:class="{'!block': open || expanded}"
        {{ $attributes->only(['x-transition:enter', 'x-transition:enter-start', 'x-transition:enter-end', 'x-transition:leave', 'x-transition:leave-start', 'x-transition:leave-end'])->merge([
            'x-transition:enter' => 'transition ease-out duration-200',
            'x-transition:enter-start' => 'transform opacity-0 scale-95',
            'x-transition:enter-end' => 'transform opacity-100 scale-100',
            'x-transition:leave' => 'transition ease-in duration-75',
            'x-transition:leave-start' => 'transform opacity-100 scale-100',
            'x-transition:leave-end' => 'transform opacity-0 scale-95',
        ]) }}
        class="hidden absolute z-50 rounded-md shadow {{ $alignmentClasses }} {{ $dropdownClasses }} max-h-[calc(100vh-80px)] overflow-y-auto">
        <div class="rounded-md bg-white dark:bg-dark-700 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
