/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./public/js/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                classicBlue: {
                    50: "#616eb0",
                    100: "#5764a6",
                    200: "#4d5a9c",
                    300: "#435092",
                    400: "#394688",
                    500: "#2f3c7e",
                    600: "#253274",
                    700: "#1b286a",
                    800: "#111e60",
                    900: "#071456",
                },
                classicPink: {
                    300: "#fffeff",
                    400: "#fff4f5",
                    500: "#fbeaeb",
                    600: "#f1e0e1",
                    700: "#e7d6d7",
                    800: "#ddcccd",
                    900: "#d3c2c3",
                },
            },
        },
    },
    plugins: [],
};
