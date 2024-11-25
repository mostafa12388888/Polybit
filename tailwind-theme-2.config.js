import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/*.php',
    ],

    safelist: [
      'js-image-zoom__zoomed-image',
      'js-image-zoom__zoomed-area',
      'filament-tiptap-grid',
      'filament-tiptap-grid-builder',
    ],

    theme: {
        extend: {
            fontFamily: {
                "header": ['Klavika', 'Almarai', ...defaultTheme.fontFamily.sans],
                "sans": ['Klavika', 'Almarai', ...defaultTheme.fontFamily.sans],
                "sans-ar": ['Almarai', 'Klavika', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.red,
                secondary: colors.neutral,
                dark: colors.neutral,
            },
        },
    },

    plugins: [forms, typography],
    
    darkMode: 'class',
};
