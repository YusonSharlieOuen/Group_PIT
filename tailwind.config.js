import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
<<<<<<< HEAD
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

=======
        "./resources/**/*.blade.php", // This is the most important line!
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
>>>>>>> dbfb10bd143c43cf372d70d28fa8545023c6c51b
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
<<<<<<< HEAD
    },

    plugins: [forms],
};
=======
},

    plugins: [],
};
>>>>>>> dbfb10bd143c43cf372d70d28fa8545023c6c51b
