const defaultTheme = require('tailwindcss/defaultTheme')

const plugins = [
  require('postcss-import'),
  require('tailwindcss/nesting')(require('postcss-nesting')),
  require('tailwindcss')({
    content: [ './*.php', './templates/**/*.php',  './woocommerce/**/*.php'],
    safelist: ['!block', 'grid-cols-3', 'grid-cols-4', 'text-[17px]' ,'text-sm', 'text-red', 'font-black'],
    theme: {
      screens: {
        sm: { raw: '(--sm)' },
        md: { raw: '(--md)' },
        lg: { raw: '(--lg)' },
        xl: { raw: '(--xl)' },
        xxl: { raw: '(--xxl)' },
      },
      colors: {
        primary: 'var(--primary)',
        secondary: 'var(--secondary)',
        black: 'var(--black, #000000)',
        white: 'var(--white, #ffffff)',
        gray: 'var(--gray, #555555)',
        dark: 'var(--dark, #555555)',
        pale: 'var(--pale)',
        transparent: 'transparent',
        'neutral-3': 'var(--neutral-3)',
        'neutral-4': 'var(--neutral-4)',
        'neutral-5': 'var(--neutral-5)',
        'neutral-6': 'var(--neutral-6)',
        'neutral-7': 'var(--neutral-7)',
        'neutral-9': 'var(--neutral-9)',
        'gray-8': 'var(--gray-8)',
        'gray-10': 'var(--neutral-10)',
        'red-1': 'var(--red-1)',
        'red-2': 'var(--red-2)',
        'red-9': 'var(--red-9)',
        red: 'var(--red)'
      },
      fontFamily: {
        sans: ['var(--font-sans)', ...defaultTheme.fontFamily.sans],
        serif: ['var(--font-serif)', ...defaultTheme.fontFamily.serif],
        mono: ['var(--font-mono)', ...defaultTheme.fontFamily.mono],
      },
      extend: {
        spacing: {
          site: 'var(--site-margin)',
          sm: 'var(--spacing-sm)',
          md: 'var(--spacing-md)',
          lg: 'var(--spacing-lg)',
          xl: 'var(--spacing-xl)',
        },
        fontSize: {
          xs: 'var(--wp--preset--font-size--xs)',
          md: 'var(--wp--preset--font-size--md)',
          lg: 'var(--wp--preset--font-size--lg)',
          xl: 'var(--wp--preset--font-size--xl)',
        }
      },
    },
    corePlugins: {
      preflight: false,
      accessibility: false
    }
  }),
  require('postcss-preset-env')({
    stage: 0,
    autoprefixer: false,
    features: {
      'nesting-rules': false,
      'custom-media-queries': true,
    },
  }),
  require('postcss-pxtorem')({
    rootValue: 16,
    mediaQuery: true,
    propList: ['*', '!border*'],
    unitPrecision: 1,
    minPixelValue: 10,
  }),
  require('autoprefixer'),
]

if (process.env.NODE_ENV === 'production') {
  plugins.push(
    require('@fullhuman/postcss-purgecss')({
      extractors: [
        {
          extractor: content => content.match(/[^<>"'`\s]*[^<>"'`\s:]/g) || [],
          extensions: [ 'twig' ]
        }
      ],
      content: ['./templates/**/*.twig'],
    }),
  )

}

module.exports = (ctx) => {
  return { plugins }
};
