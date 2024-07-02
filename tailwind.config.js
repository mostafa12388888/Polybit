import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                "sans": ['Roboto', 'Almarai', ...defaultTheme.fontFamily.sans],
                "sans-ar": ['Almarai', 'Roboto', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.zinc,
                secondary: colors.teal,
                dark: colors.zinc,
            },
        },
    },

    plugins: [forms],
    
    darkMode: 'class',
};
