/** @type {import('tailwindcss').Config} */
module.exports = {
  content: {
    transform: (content) => content.replace(/taos:/g, ''),
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
      './node_modules/flowbite/**/*.js'
    ],
  },
  theme: {
    extend: {},
    colors: {
      'gold-800' : '#B99F78',
      'darkblue-800' : '#183754',
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require("daisyui"),
    require('taos/plugin'),
  ],
  daisyui: {
    themes: ["light"],
  },
  safelist: [
    '!duration-0',
    '!delay-0',
    'html.js :where([class*="taos:"]:not(.taos-init))'
  ]
}
