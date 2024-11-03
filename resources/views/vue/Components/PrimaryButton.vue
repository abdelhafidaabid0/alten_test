<script setup lang="ts">

import {computed} from "vue";

interface PrimaryButtonProps {
  type?: "primary" | "secondary" | "danger";
  type_button?: "submit" | "reset" | "button";
}

const props = withDefaults(defineProps<PrimaryButtonProps>(), {
  type: "primary",
  type_button: "button",
});

const get_type_style = computed(() => {
  switch (props.type) {
    case "secondary":
      return "secondary";
    case "danger":
      return "danger";
    default:
      return "primary";

  }
})

</script>

<template>
  <button :type="type_button" class="button" :class="[get_type_style]">
    <slot/>
  </button>
</template>
<style scoped lang="scss">
.button {
  @apply cursor-pointer;
  @apply inline-flex items-center px-4 py-2 gap-1 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest disabled:opacity-50 transition ease-in-out duration-150;
}

.primary {
  @apply bg-yellow-800 text-white  hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none;
}

.danger {
  @apply bg-red-500 text-white  hover:bg-red-700 active:bg-red-900 focus:outline-none ;
}

.secondary {
  @apply bg-gray-800 text-white  hover:bg-gray-700 active:bg-gray-900 focus:outline-none ;
}
</style>