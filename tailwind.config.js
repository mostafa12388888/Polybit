import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const colors = require('tailwindcss/colors')
let theme = {};

try {
    theme = require('./theme.json')
} catch(e) {}

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
            colors: theme.colors ? theme.colors : {
                primary: colors.zinc,
                secondary: {
                    DEFAULT: '#B2D1DE',
                    50: '#F9FCFD',
                    100: '#EBF3F6',
                    200: '#CFE2EA',
                    300: '#B2D1DE',
                    400: '#8BBACD',
                    500: '#63A2BC',
                    600: '#4687A2',
                    700: '#35667B',
                    800: '#244654',
                    900: '#13252C',
                    950: '#0B1519'
                },
                dark: colors.zinc,
            },
        },
    },

    plugins: [forms, typography],
    
    darkMode: 'class',
};
