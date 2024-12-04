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
              'brand-darker': '#0B7321',
              'brand-yellow': '#FFD700',
              'brand-black': '#333333',
              'brand-brown-red': '#88280D',
              'brand-reserved':'#E52200'
          },
          maxWidth: {
              'nav': '2100px'
          },
          backgroundImage: {
              'homepage-image': "url('/public/images/1.jpg')",

          },
          keyframes: {
              slideInFade: {
                  '0%': { transform: 'translateY(-100%)', opacity: '0' },
                  '100%': { transform: 'translateY(0)', opacity: '1' },
              },
              slideOutFade: {
                  '0%': { transform: 'translateY(0)', opacity: '1' },
                  '100%': { transform: 'translateY(-100%)', opacity: '0' },
              },

          },
          animation: {
              slideIn: 'slideInFade 0.5s ease-out',
              slideOut: 'slideOutFade 1.5s ease-in',
          },
      },
  },
  plugins: [
      require('@tailwindcss/forms'),
      require('flowbite/plugin')
  ],
}

