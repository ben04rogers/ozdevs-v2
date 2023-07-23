/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                customBlue: '#4075dc',
                customDarkBlue: '#204ca3'
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
