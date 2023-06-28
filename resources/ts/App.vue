<template>
  <AppLayout>
    <router-view></router-view>
  </AppLayout>
</template>

<script lang="ts" setup>
import AppLayout from '@/views/layouts/AppLayout.vue'
import { UserStore, useUserStore } from '@/stores/UserStore'
import { onMounted } from 'vue'

const userStore: UserStore = useUserStore()

onMounted(() => {
  userStore.getList()
})
</script>

<style scoped>

</style>
