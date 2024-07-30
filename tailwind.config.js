/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: 'jit',
  content: [
      "./assets/**/*.js",
      "./templates/**/*.{html,twig}",
      './src/**/*.php',
  ],
  theme: {
    extend: {
        colors: {
            'gold': '#C5AB6B',
            'light': '#ece7d9',
            'dark': '#1A1C20',
            'dark-transparent': '#1A1C20BF'
        },

        fontFamily: {
          'title': 'Rouge Script, cursive',
          'sub-title': 'Quintessential, serif',
          'text': 'Raleway, sans-serif',
          'digital': 'Digital Clock'
        },

        borderRadius: {
          'card': '15px'
        },
/*
        backgroundImage: {
            'history': "url('../assets/images/history-background.jpg')",
        },
 */

        boxShadow: {
            'filter-dark': 'inset 0 0 0 1000px #1A1C20BF',
            'card-shadow': '5px 5px 5px #1A1C2066'
        },

        spacing: {
            18: '4.5rem',
            19: '4.75rem',
        }
},


  },
}

