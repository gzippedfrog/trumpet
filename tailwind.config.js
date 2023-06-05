/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/views/**/*.view.php"],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ]
}

