@props(['values', 'value', 'default' => ''])

<div class="w-full">
    <input type="hidden" {!! $attributes->except(['values', 'value']) !!} />
    
    <div wire:ignore class="w-[calc(100%-20px)] relative left-2.5 rtl:left-auto rtl:right-2.5">
        <span x-init="
            new rSlider({
                target: $el,
                values: [{{ implode(', ', array_reverse($values ?? [])) }}],
                range: true,
                labels: false,
                scale: false,
                tooltip: true,
                set: [{{ implode(', ', array_reverse($value ?? [])) }}],
                onChange: function (value) {
                    value = value.split(',').reverse().join('-');
                    input = $el.parentNode.previousElementSibling;

                    if(input.value != value && value != '{{ $default }}') {
                        input.value = value;
                        input.dispatchEvent(new Event('input'));
                    }
                }
            })
        "></span>
    </div>

    <div class="flex justify-between gap-2 text-sm -mt-3 px-4">
        <span>{{ array_shift($values) }}</span>
        <span>{{ array_pop($values) }}</span>
    </div>
</div>
