@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-gray-700 dark:text-dark-200']) }}>
    {{ $value ?? $slot }}

    @if(isset($required) && $required != false)
        <span class="text-red-400 p-1 text-lg">*</span>
    @endif
</label>
