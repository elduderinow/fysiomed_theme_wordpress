/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: 'jit',
    content: ["../**/*.{html.twig,twig,php}"],
    theme: {
      extend: {
        aspectRatio: {
          '4/3': '4 / 3',
        },
      }
    },
    plugins: [],
  };