<script setup lang="ts">
interface Props {
  name: string,
}

defineProps<Props>()
</script>

<template>
  <i :class="[`fa-solid fa-${name}`]"></i>
</template>

<style scoped>

</style>