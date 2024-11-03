<template>
  <div class="flex flex-col gap-px">
    <InputLabel :for="id">{{ label }}</InputLabel>
    <TextInput
        class="w-full"
        :value="modelValue"
        @update:modelValue="(value) => $emit('update:modelValue', value)"
        type="text"
        :id="id"
        :name="id"
        :placeholder="placeholder"
        :class="[{'ring-red-500 ring-1':errors[id]}]"
    />
    <InputError :message="errors[id]"></InputError>
  </div>
</template>
<script setup lang="ts">

import InputLabel from "./InputLabel.vue";
import InputError from "./InputError.vue";
import TextInput from "./TextInput.vue";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
  modelValue: String,
  id: String,
  placeholder: String,
  label: String,
});

defineEmits(['update:modelValue']);

const errors = computed(() => usePage().props.errors)
</script>

<style scoped>

</style>