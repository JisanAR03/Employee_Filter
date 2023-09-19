/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        inter: ['Inter', 'sans-serif'],
        poppins: ['Poppins', 'sans-serif'],
        roboto: ['Roboto', 'sans-serif'],
      },
      colors: {
        h1Color: "#143E4A",
        h2Color: "#4C4C4C",
        h3Color: "#273240",
        bodyText:  '#646464',
        primary :  '#D1FED1',
        button : '#008D96',
        gradient: '#CDE5E0',
        jobs: "#D8E7FF",
        iconBg: '#D9D9D9',
        lightText: '#777777'
      },
      screens: {
        'sm': '640px',
        // => @media (min-width: 640px) { ... }

        'md': '768px',
        // => @media (min-width: 768px) { ... }

        'lg': '1000px',
        // => @media (min-width: 1024px) { ... }

        'xl': '1366px',
        // => @media (min-width: 1366px) { ... }

        '2xl': '1536px',
        // => @media (min-width: 1536px) { ... }
        '3xl': '1920px',
        // => @media (min-width: 1920px) { ... }
      },
      container: {
        center: true,
      },
    },
  },
  plugins: []
}

