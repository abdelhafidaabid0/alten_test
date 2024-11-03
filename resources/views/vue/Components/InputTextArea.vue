<template>
  <div>
    <InputLabel :for="id">{{ label }}</InputLabel>
    <TextInputArea
        class="w-full"
        :value="modelValue"
        @update:modelValue="(value) => $emit('update:modelValue', value)"
        type="text"
        :id="id"
        :name="id"
        :placeholder="placeholder"
        :rows="5"
        :maxlength="maxLength"
        :class="[{'ring-red-500 ring-1':errors[id]}]"
    />
    <InputError :message="errors[id]"></InputError>
  </div>
</template>
<script setup lang="ts">

import InputLabel from "./InputLabel.vue";
import InputError from "./InputError.vue";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import TextInputArea from "./TextInputArea.vue";
import TextInput from "./TextInput.vue";

defineProps({
  modelValue: String,
  id: String,
  placeholder: String,
  label: String,
  maxLength: Number,
});

defineEmits(['update:modelValue']);

const errors = computed(() => usePage().props.errors)
</script>

<style scoped>

</style>