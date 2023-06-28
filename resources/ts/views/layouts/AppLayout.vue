<template>
    <component :is="layout">
        <slot />
    </component>
</template>

<script setup>
import AppLayoutDefault from './AppLayoutDefault.vue'
import { ref, markRaw, watch, computed } from 'vue'
import { useRoute } from 'vue-router'

const layout = ref()
const route = useRoute()

watch(
    () => route.meta,
    async meta => {
        try {
            const component = meta.layout && await import(`./App${meta.layout}.vue`)

            layout.value = markRaw(component?.default || AppLayoutDefault)
        } catch (e) {
            layout.value = markRaw(AppLayoutDefault)
        }
    },
    { immediate: true }
);
</script>

<style scoped>

</style>
