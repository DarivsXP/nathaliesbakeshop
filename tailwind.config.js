import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                display: ['Fraunces', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                ube: {
                    DEFAULT: '#6B3FA0',
                    dark: '#553280',
                    light: '#8B5FC0',
                },
                cream: '#FFF8F0',
                gold: '#E8B86D',
                charcoal: '#2D2A32',
            },
        },
    },

    plugins: [forms],
};
