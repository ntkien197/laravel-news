<template>
  <h1>layout auth</h1>
    <div class="auth-wrapper">
        <div id="login">
            <div class="bg-img">
<!--                <img class="w-100 h-100" :srcset="require('@desktop/assets/images/background-timebit.png')+ ' 2x'" alt="">-->
                    <img srcset="@/assets/logo.svg 2x" />

            </div>
            <div class="login-wrapper">
<!--                <form-login />-->
                <slot></slot>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">
</script>

<style scoped>

</style>
