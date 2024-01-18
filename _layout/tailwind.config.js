/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./template/*.{html,js}','template/js/*.js','template/css/styles.css', 'index.html'],
  theme: {
    extend: {
        fontFamily: {
            'nunito': ['Nunito', 'sans-serif'],
            'rubik': ['Rubik', 'sans-serif'],
            'poppins': ['Poppins', 'sans-serif'],
            'merriweather': ['Merriweather', 'sans-serif'],
            'lato': ['Lato', 'sans-serif'],
            'montserrat': ['Montserrat', 'sans-serif'],
            'noto': ['Noto Sans', 'sans-serif'],
            'roboto': ['Roboto', 'sans-serif'],
            'oswald': ['Oswald', 'sans-serif'],
            'aleo': ['Aleo', 'sans-serif'],
            'mulish': ['Mulish', 'sans-serif'],
            'asap-condensed': ['Asap Condensed', 'sans-serif'],
            'open-sans': ['Open Sans', 'sans-serif'],
            'barlow': ['Open Sans', 'sans-serif']
        },
    },
  },
  plugins: [],
}

