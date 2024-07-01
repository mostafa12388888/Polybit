@props(['size' => 'md', 'type' => 'modal', 'countdown' => 0])

@php
    $classes = 'bg-white dark:bg-dark-700 w-full mx-0 rounded-[1.4rem] sm:mx-4 flex flex-col overflow-hidden shadow-lg shadow-black/30 outline-0';
    $classes .= $type == 'modal' ? ' mx-1' : '';
    $classes .= $type == 'screen' ? ' sm:min-h-0' : '';
    
    switch ($size) {
        case 'xs': $classes .= ' sm:max-w-xs'; break;
        case 'sm': $classes .= ' sm:max-w-sm'; break;
        case 'md': $classes .= ' sm:max-w-md'; break;
        case 'lg': $classes .= ' sm:max-w-lg'; break;
        case 'xl': $classes .= ' sm:max-w-xl'; break;
        case '2xl': $classes .= ' sm:max-w-2xl'; break;
        case '3xl': $classes .= ' sm:max-w-3xl'; break;
        case '4xl': $classes .= ' sm:max-w-4xl'; break;
        case '5xl': $classes .= ' sm:max-w-5xl'; break;
        case '6xl': $classes .= ' sm:max-w-6xl'; break;
        case '7xl': $classes .= ' sm:max-w-7xl'; break;
        case 'container': $classes .= ' container'; break;
    }
@endphp

<div 
    x-data="{ 
        isOpen: false,
        countdownInit: {{ $countdown }},
        countdown: {{ $countdown }},
        modalData: {},
        open: function(){
            this.countdown = this.countdownInit;
            this.isOpen = true;
            this.startCountdown()
        },
        close: function(){
            if(this.isOpen && ! this.countdown){
                this.isOpen = false;
            }
        },
        toggle: function(){
            this.isOpen ? this.close() : this.open();
        },
        startCountdown: function(){
            countdownInterval = setInterval(() => { 
                this.countdown = this.countdown > 0 ? this.countdown - 1 : this.countdown

                if(! this.countdown) {
                    clearInterval(countdownInterval)
                }
            }, 1000)
        }
    }" 
    @keyup.escape.window="close"
    @open-modal.window="
        if($event.detail === $refs.modalDialog.getAttribute('id') || $event.detail.modal == $refs.modalDialog.getAttribute('id')){
            modalData = $event.detail; 
            open();
        }
    "
>
    <div @click="toggle">{{ $trigger ?? '' }}</div>

    <div 
        x-show="isOpen" 
        x-cloak
        x-id="['modal']"
        x-transition.opacity
        x-trap.inert.noscroll="isOpen"
        class="fixed h-full top-0 right-0 left-0 bg-black/60 overflow-auto z-50"
        @click="close"
        @open-modal.window="setTimeout(function(){ $focus.wrap().next() }, 300)"
    >
        <div class="w-full h-auto min-h-full flex justify-center {{ $type == 'modal' ? 'items-center' : 'sm:items-center' }} sm:py-5">
            <div 
                x-show="isOpen"
                x-transition
                @click.stop
                tabindex="-1" 
                role="dialog"
                x-ref="modalDialog"
                :aria-labelledby="$id('modal')"
                {!! $attributes->merge(['class' => $classes]) !!}
            >

                <div class="relative flex flex-row-reverse w-full dark:bg-dark-700 bg-gray-100 justify-between items-center">
                    <div>
                        <p class="text-xl font-semibold py-5 px-7" x-show="countdown" x-ref="countdown" x-text="countdown"></p>

                        <x-elements.button size='' @click="close" x-show="! countdown" x-ref="close" styling="link" 
                            class="text-gray-500 text-2xl p-5" 
                            aria-label="Close" aria-hidden="true">
                            <x-icons.close />
                            <span class="sr-only">{{ __('Close') }}</span>
                        </x-elements.button>
                    </div>
                    
                    <p :id="$id('modal')" class="p-5" {!! ($header ?? null) ? '' : 'x-html="modalData.header"' !!}>{{ $header ?? null }}</p>
                </div>
                
                <div class="flex flex-grow flex-col w-full items-center dark:bg-dark-700">
                    <div class="flex flex-grow flex-col w-full" {!! ($header ?? null) ? '' : 'x-html="modalData.body"' !!}>{{ $slot }}</div>
                </div>
                
                @if (isset($footer))
                    <div>{{ $footer }}</div>
                @endif
            </div>
        </div>
    </div>
</div >