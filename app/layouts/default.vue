<script>
export default {
  components: {
    AppNav: () => import('@/components/AppNav')
  }
}
</script>

<template lang="pug">
div
  AppNav
  nuxt
</template>
