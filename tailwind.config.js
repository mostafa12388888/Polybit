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

    theme: {
        extend: {
            fontFamily: {
                "header": ['Nunito', 'Almarai', ...defaultTheme.fontFamily.sans],
                "sans": ['Nunito', 'Almarai', ...defaultTheme.fontFamily.sans],
                "sans-ar": ['Almarai', 'Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primarys: {
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
                primary: colors.zinc,
                secondary: colors.teal,
                dark: colors.zinc,
            },
        },
    },

    plugins: [forms, typography],
    
    darkMode: 'class',
};
