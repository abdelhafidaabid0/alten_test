<template>
  <div class="flex items-center">
    <Fa6Icon
        v-for="star in maxRating"
        :key="star"
        :class="star <= rating ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300'"
        class="text-lg mr-1"
        name="star"/>
  </div>
</template>

<script setup lang="ts">
// Props to receive the product rating
import { defineProps } from 'vue';
import Fa6Icon from "./Fa6Icon.vue";

// Define the props for the rating and maximum rating
const props = defineProps<{
  rating: number;
  maxRating?: number;
}>();

// Set the default maximum rating if not provided
const maxRating = props.maxRating || 5;
</script>

