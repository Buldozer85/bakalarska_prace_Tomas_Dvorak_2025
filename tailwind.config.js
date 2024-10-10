/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
  theme: {
      extend: {
          colors: {
              'brand': '#0D8828',
              'brand-darker': "#0B7321"
          },
          maxWidth: {
              'nav': '2100px'
          },
          backgroundImage: {
              'homepage-image': "url('/public/images/1.jpg')",

          }
      },
  },
  plugins: [
      require('@tailwindcss/forms'),
      require('flowbite/plugin')
  ],
}

