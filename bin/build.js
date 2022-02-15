#!/usr/bin/env node
const bs = require("browser-sync").create()
const postcss = require('esbuild-postcss')
const cssModulesPlugin = require('esbuild-css-modules-plugin')
const esbuild = require('esbuild')
const config = require('../wptwig.config.json')
const fs = require('fs')

const commonConfig = {
  entryPoints: [
    ...config.assets
  ],
  entryNames: '[dir]/[name]-[hash]',
  bundle: true,
  loader: {
    '.woff': 'file',
    '.woff2': 'file',
  },
  outdir: 'dist',
  metafile: true,
  plugins: [
    postcss(),
    cssModulesPlugin()
  ]
}

const build = () => {
  esbuild.build({
    ...commonConfig
  }).then((result) => {
      const manifest = {};
      for (const output in result.metafile.outputs) {
        if (output.endsWith('js') || output.endsWith('css')) {
          const key = result.metafile.outputs[output]['entryPoint']
          manifest[key] = output;
        }
}
      fs.writeFileSync('manifest.json', JSON.stringify(manifest))
      console.log('[esbuild] files generated')
    }).catch(err => console.error(err))
}


build();
// We just want to build the assets. End execution.
if (process.argv.includes('build')) return 0


bs.watch(config.watchAssets, (event) => {
  if (event !== 'change') return;

  build();
  bs.reload()
})

bs.init({
  ui: false,
  notify: false,
  localOnly: true,
  online: false,
  proxy: "localhost:8080"
})
