// tailwind.config.js
module.exports = {
  content: ["./src/**/*.{html,js}",
  './node_modules/flowbite/**/*.js',

  ],
  theme: {
    extend: {
      animation: {
        border: 'background ease infinite',
      },
      keyframes: {
        background: {
          '0%, 100%': { backgroundPosition: '0% 50%' },
          '50%': { backgroundPosition: '100% 50%' },
        },
      },
    },
  },
  plugins: [
    require('flowbite/plugin'),
  ],
  daisyui: {
    themes: ["light", "dark", "cupcake", "pastel", "retro"],
  },
}