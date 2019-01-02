<script>
  export default {
    components: {
      AppNav: () => import('@/components/AppNav'),
      AppToast: () => import('@/components/AppToast')
    },

    mounted () {
      window.addEventListener('load', () =>
        this.$store.commit('connection', navigator.onLine ? true : false)
      )

      window.addEventListener('online', () =>
        this.$store.commit('connection', true)
      )

      window.addEventListener('offline', () =>
        this.$store.commit('connection', false)
      )
    }
  }
</script>

<template lang="pug">
.default
  AppToast
  AppNav
  nuxt
</template>

<style lang="stylus">
#__nuxt
#__layout
  height 100%
.default
  min-height 100%
@media (max-width 512px)
  .default
    padding 0 16px
</style>
