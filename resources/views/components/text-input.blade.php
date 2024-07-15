@props(['disabled' => false])

<x-input {{ $attributes->merge(['disabled' => $disabled]) }} />
