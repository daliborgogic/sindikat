<template lang="pug">
.toast Keširanje završeno, naredne posete će raditi i bez internet konekcije.
</template>

<style lang="stylus" scoped>
.toast
  width 512px + 32px
  margin 0 auto
  padding 12px 16px
  background-color #000
  position fixed
  bottom 32px
  left calc(50% - calc(512px / 2 + 16px))
  font-size 14px
  color #fff
  border-radius 4px
  // width 600px
  min-height 48px
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23)
@media (max-width 576px)
  .toast
    width calc(100% - 32px)
    left 16px
    right 16px
    bottom 16px
</style>
