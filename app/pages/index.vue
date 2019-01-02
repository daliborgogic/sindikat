<script>
import r2 from 'r2'
export default {
  async asyncData () {
    const page = await r2(`${process.env.cms}/wp-json/wp/v2/posts/6`).json
    return { page }
  },

  methods: {
    time (value) {
      const event = new Date(value)
      const options = {
        day: 'numeric',
        month: 'long',
        weekday: 'short',
        // hour: 'numeric',
        // minute: 'numeric',
        // timeZoneName: 'short',
        // timeZone: 'America/Los_Angeles',
      }
      return new Intl.DateTimeFormat('sr-Latn', options).format(event)
    }
  }
}
</script>

<template lang="pug">
  .page
    h1(v-html="page.title.rendered")
    time {{ time(page.date) }}
    div(v-html="page.content.rendered")
    //- pre {{ page }}
</template>

<style lang="stylus" scoped>
.page
  max-width 512px
  margin 0 auto
h1
  // font-weight 400
  font-size 32px
  line-height 1
time
  color #999
  font-size 12px
>>> p
  font-size 14px
  line-height 1.8
>>> .wp-block-file
  margin 16px 0
  &.pdf
    a::after
      content "pdf"
  a
    font-size 16px
    padding-right 100px
    display block
    color #067df7
    text-decoration none
    &::before
      content "-"
      display inline-block
      position absolute
      margin-left -16px
    &::after
      margin-left 1em
      border 1px solid rgba(#000, 0.12)
      font-size 10px
      padding 2px 8px
      border-radius 4px
      color #999
      content "word"
      text-transform uppercase
      display inline-flex
      align-items center
      justify-content center
</style>
