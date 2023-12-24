module.exports = {
  content: [
    "./src/**/*.{html,js}",
    "./views/**/*.{php,html,js}",
    "./**/*.{php,html,js}",
  ],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/forms")],
};
