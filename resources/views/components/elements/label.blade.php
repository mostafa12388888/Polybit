@props(['value', 'required'])

<label {{ $attributes->merge(['class' => 'block']) }}>
    {{ $value ?? $slot }}
    
    @if(isset($required) && $required != false)
        <span class="text-red-400 p-1 text-lg">*</span>
    @endif
</label>
