const defaultTheme = require('tailwindcss/defaultTheme')

const plugins = [
  require('postcss-import'),
  require('tailwindcss/nesting')(require('postcss-nesting')),
  require('tailwindcss')({
    content: [ './*.php', './templates/**/*.php',  './woocommerce/**/*.php'],
    theme: {
      screens: {
        sm: { raw: '(--sm)' },
        md: { raw: '(--md)' },
        lg: { raw: '(--lg)' },
        xl: { raw: '(--xl)' },
        xxl: { raw: '(--xxl)' },
      },
      colors: {
        primary: 'var(--color-primary)',
        secondary: 'var(--color-secondary)',
        black: 'var(--color-black, #000000)',
        white: 'var(--color-white, #ffffff)',
        gray: 'var(--color-gray, #555555)',
        dark: 'var(--color-dark, #555555)',
        pale: 'var(--color-pale)',
        transparent: 'transparent'
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
