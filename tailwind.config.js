/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors:{
                'primary': '#232429',
                'secondary': '#1D1F27',
            },
        },
    },
    plugins: [],
}

