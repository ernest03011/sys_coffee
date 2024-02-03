module.exports = {
  content: [
    "./src/**/*.{html,js}",
    "./views/**/*.{php,html,js}",
    "./**/*.{php,html,js}",
  ],
  theme: {
    extend: {
      fontFamily: {
        playfair: ["Playfair Display", "serif"],
        opensans: ["Open Sans", "sans-serif"],
      },
    },
  },
  plugins: [require("@tailwindcss/forms")],
};
