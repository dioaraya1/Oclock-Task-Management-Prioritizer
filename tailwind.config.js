/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php", // Semua file PHP
    "./*.php", // File PHP di root
    "./**/*.html", // File HTML
    "./assets/js/**/*.js", // File JS
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
