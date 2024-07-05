<nav class="sm:hidden">
    <div class="mt-[4.5rem]"></div>
    
    <div class="fixed bottom-0 left-0 z-50 w-full h-[4.5rem] bg-white border-t border-dark-200 dark:bg-dark-700 dark:border-dark-800/40">
        <div class="dark:bg-dark-800/70 h-full">
            <div class="grid h-full max-w-lg grid-cols-5 mx-auto font-medium">
                <x-link class="inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none" href="{{ route('home') }}">
                    <x-icons.home class="!w-5 !h-5" />
                    <span class="text-sm">Home</span>
                </x-link>
                <x-link class="inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none" href="#">
                    <x-icons.store class="!w-5 !h-5" />
                    <span class="text-sm">Store</span>
                </x-link>
                <x-link class="inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none" href="#">
                    <div class="relative inline-flex">
                        <span class="font-bold text-xs w-5 h-5 bg-dark-500 text-white rounded-full flex items-center justify-center absolute -top-3 ltr:left-3 rtl:right-3">{{ rand(1, 20) }}</span>
                        <x-icons.cart class="!w-5 !h-5" />
                    </div>
                    <span class="text-sm">Cart</span>
                </x-link>
                <x-link class="inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none" href="#">
                    <x-icons.envelope class="!w-5 !h-5" />
                    <span class="text-sm">Contact <span class="max-[400px]:hidden">Us</span></span>
                </x-link>
                <x-link class="inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none" href="{{ route('login') }}">
                    <x-icons.user class="!w-5 !h-5" />
                    <span class="text-sm">Login</span>
                </x-link>
            </div>
        </div>
    </div>
</nav>
