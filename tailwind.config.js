/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'bakrie-gold': '#F5A623',
        'bakrie-dark': '#1A1A2E',
        'bakrie-red': '#E94560',
      },
      fontFamily: {
        'heading': ['Montserrat', 'sans-serif'],
        'body': ['Open Sans', 'sans-serif'],
      }
    },
  },
  plugins: [],
}