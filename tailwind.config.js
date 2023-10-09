const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Product Sans"],
            },
            colors: {
                transparent: "transparent",
                current: "currentColor",
                premier: "#02c1ef",
                sekunder: "#F4801D",
                tersier: "#94C83E",
                dark: "#161616",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
