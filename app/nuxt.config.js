export default {
  modern: true,

  css: ['~assets/stylus/main.styl'],
  modules: ['@nuxtjs/style-resources'],
  styleResources: { stylus: './assets/stylus/variables.styl' },

  build: {
    parallel: true,
    cssSourceMap: false,
    extend(config, ctx) {
      // Run ESLint on save
      if (ctx.isDev && ctx.isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  },

  render: {
    // resourceHints: false,
    http2: { push: true }
  }
}
