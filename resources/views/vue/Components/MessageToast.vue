<script setup>
import { ref, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const show = ref(false);
const style = ref('success');
const message = ref('');

// Watch for changes in flash messages and update the notification accordingly
watchEffect(() => {
  style.value = page.props.jetstream?.flash?.bannerStyle || 'success';
  message.value = page.props.jetstream?.flash?.banner || '';
  show.value = !!message.value;
});

// Map styles to background colors and icons
const styleClasses = {
  success: {
    bg: 'bg-green-500',
    iconBg: 'bg-green-600',
    icon: `
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        `
  },
  danger: {
    bg: 'bg-red-700',
    iconBg: 'bg-red-600',
    icon: `
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
        `
  },
  info: {
    bg: 'bg-blue-500',
    iconBg: 'bg-blue-600',
    icon: `
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h1m0-4h-1a1 1 0 100 2h.5a1 1 0 100-2H11m-.5 10h1a1 1 0 100-2h-1a1 1 0 100 2h.5a1 1 0 000 2h-1a1 1 0 100 2h1m-2-4v2h-1v-2m1-8v2m-1-2h1v-2h-1m0 6h1m1-6v2m-1 4h-1v2m0-6v2" />
        `
  },
  warning: {
    bg: 'bg-yellow-500',
    iconBg: 'bg-yellow-600',
    icon: `
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M9.172 15.172a4 4 0 105.656 0A4 4 0 009.172 15.172zM4.93 4.929A10 10 0 1119.07 19.07 10 10 0 014.93 4.93z" />
        `
  }
};
</script>

<template>
  <div v-if="show && message" :class="styleClasses[style].bg">
    <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between flex-wrap">
        <div class="w-0 flex-1 flex items-center min-w-0">
                    <span class="flex p-2 rounded-lg" :class="styleClasses[style].iconBg">
                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <g v-html="styleClasses[style].icon"></g>
                        </svg>
                    </span>

          <p class="ms-3 font-medium text-sm text-white truncate">
            {{ message }}
          </p>
        </div>

        <div class="shrink-0 sm:ms-3">
          <button
              type="button"
              class="-me-1 flex p-2 rounded-md focus:outline-none sm:-me-2 transition"
              :class="styleClasses[style].iconBg"
              aria-label="Dismiss"
              @click.prevent="show = false"
          >
            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Using Tailwind classes directly in the component */
</style>
