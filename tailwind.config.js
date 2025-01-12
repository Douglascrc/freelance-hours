import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './resources/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Segoe UI', 'sans-serif'],
            },
        },
    },
    plugins: [],
};
