import {} from 'dotenv/config'
const { CMS_DOMAIN, APP_DOMAIN } = process.env
const schema = {
  '@context': 'http://schema.org/',
  "@type": "Organization",
  "name": "###",
  "legalName": "###",
  "description": "###",
  "url": APP_DOMAIN,
  "logo": APP_DOMAIN + '/logo.png',
  "email": 'support@' + APP_DOMAIN,
  "founder": {
    "@context": "http://schema.org",
    "@type": "Person",
    "givenName": "###",
    "familyName": "###",
    "gender": "Male",
    "jobTitle": "###",
    "image": APP_DOMAIN + "/founder.png"
  },
  "foundingDate": "2015-11-03T12:00:00-08:00",
  "foundingLocation": {
    "@context": "http://schema.org",
    "@type": "Place",
    "address": {
      "@context": "http://schema.org",
      "@type": "PostalAddress",
      "addressLocality": "San Francisco",
      "addressRegion": "CA"
    }
  },
  "sameAs": [
    "https://twitter.com/###",
    "https://www.facebook.com/###"
  ]
}

export default {
  modern: true,

  env: {
    cms: CMS_DOMAIN,
    app: APP_DOMAIN
  },

  head: {
    htmlAttrs: { lang: 'sr', },
    title: '###',
    titleTemplate: '%s - ###',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' }
    ],
    // __dangerouslyDisableSanitizers: ['script'],
    script: [
      { type: 'application/ld+json', innerHTML: JSON.stringify(schema, null, 0) }
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
