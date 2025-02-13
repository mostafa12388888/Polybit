@php
    $whatsapp_number = setting('whatsapp');
    $whatsapp_number = str_replace('+', '', $whatsapp_number);
@endphp

<x-link x-init="setTimeout(() => {$el.classList.remove('opacity-0');}, 1000);" 
    href="https://wa.me/{{ $whatsapp_number }}" 
    class="opacity-0 transition-opacity duration-700 fixed bottom-[5.4rem] sm:bottom-4 rtl:left-4 ltr:right-4 !rounded-full w-14 h-14 sm:w-16 sm:h-16 bg-[#25D366] flex justify-center items-center border-2 border-dark-100 z-10">
    <span class="text-white absolute w-4 h-4 sm:w-5 sm:h-5 flex justify-center items-center bg-red-500 top-0 text-xs font-bold rounded-full right-0 shadow-xs">1</span>
    <x-icons.whatsapp class="!w-6 !h-6 sm:!w-7 sm:!h-7 text-white" />
</x-link>