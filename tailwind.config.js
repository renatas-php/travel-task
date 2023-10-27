/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      borderRadius: {
        'none': '0',
        'button': '35px',
      },
      spacing: {
        '16px': '16px',
        '50px': '50px',
        'container-mobile': '32px',
        'container': '104px',
      },
    },
  },
  plugins: [],
}

