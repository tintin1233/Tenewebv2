import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#001840",

                    secondary: "#102A71",

                    accent: "#F5C400",

                    neutral: "#001840",

                    "base-100": "#FFFDF0",

                    info: "#0088a1",

                    success: "#00e33e",

                    warning: "#f07900",

                    error: "#ff6689",
                },
            },
        ],
    },

    plugins: [forms, require("daisyui")],
};
