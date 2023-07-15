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
                'custom-primary': '#1a56db',
                'custom-secondary': '#fecd1f'
            }
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
