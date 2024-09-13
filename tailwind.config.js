/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                "work-sans": ["Work Sans", "sans-serif"],
            },
            colors: {
                orange: "#A9D1DF", //* rgb(255, 88, 15)
                "dark-blue": "rgb(12, 16, 53)", //*
                yellow: "#A9D1DF", //* rgb(255, 164, 27)
                divid: "rgba(210, 210, 213, 0.15)",
            },
        },
    },
    plugins: [],
};
