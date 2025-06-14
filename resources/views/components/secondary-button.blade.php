<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-dark-800 border border-secondary-300 dark:border-dark-500 rounded-md font-semibold text-xs text-gray-700 dark:text-dark-200 uppercase tracking-widest shadow-sm hover:bg-secondary-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
