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
                "sans": ['Figtree', ...defaultTheme.fontFamily.sans],
                "sans-ar": ['IBM Plex Sans Arabic', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.zinc,
                secondary: colors.teal,
                // dark: {
                //     DEFAULT: '#465062',
                //     50: '#FFFFFF',
                //     100: '#F9FAFB',
                //     200: '#D2DADF',
                //     300: '#ABB9C4',
                //     400: '#8596A8',
                //     500: '#617389',
                //     600: '#45546E',
                //     650: '#3B485E',
                //     700: '#333d52',
                //     750: '#2D3548',
                //     800: '#222a3f',
                //     850: '#151A28',
                //     900: '#0E101B',
                //     950: '#07080D'
                // },
                dark: colors.zinc,

            },
        },
    },

    plugins: [forms],
    
    darkMode: 'class',
};
