module.exports = {
  purge: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        indigo: '#1f2553',
        lightblue: '#6392cc',
        darkgrey: '#30393f',
        dovegrey: '#e4e2e8',
        gold: '#f9c100',
        orange: '#f4640b',
        softgreen: '#61bea3',
        purple: '#a7509f'
      },
      minHeight: {
        '12': '3rem'
      }
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
