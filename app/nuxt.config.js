import {} from 'dotenv/config'
const { CMS_DOMAIN, APP_DOMAIN } = process.env

export default {
  modern: true,

  env: {
    cms: CMS_DOMAIN,
    app: APP_DOMAIN
  },

  head: {
    htmlAttrs: { lang: 'sr', },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' }
    ]
  },

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
