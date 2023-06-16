<template>
  App.concac ../ đồ lỏ dãy @ đâu
  roi do đm ngựa ngựa @/ đồ máy cùi đm
  từ từ sao biết lúc set up lúc @/ lúc @ đm biết khi nào cái nào n chạy đc
  dùng @ được r
  e làm nhanh bấm lụi
  qua aloiox chớ e chạy bth
  thôi thôi ông đừng có àm mồm điêu
  <router-view></router-view>
</template>

<script lang="ts" setup>
import { UserStore, useUserStore } from '@/stores/UserStore'
import { onMounted } from 'vue'

const userStore: UserStore = useUserStore()

onMounted(() => {
  userStore.getList()
})
</script>

<style scoped>

</style>
