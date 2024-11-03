<template>
  <div class="relative flex items-center cursor-pointer" @click="toggleDropdown">
    <!-- Cart Icon with Badge -->
    <i class="fas fa-shopping-cart text-2xl"></i>
    <span v-if="products.length > 0"
          class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs font-bold px-2">
            {{ nombre }}
        </span>

    <!-- Dropdown Menu for Cart Items -->
    <div v-if="showDropdown && products.length > 0"
         class="absolute top-0 right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
      <h3 class="p-3 font-bold border-b border-gray-200">Panier</h3>
      <ul class="max-h-48 overflow-y-auto">
        <li v-for="item in products" :key="item.id" class="flex items-center p-3 border-b border-gray-100">
          <img :src="item.image" alt="Product image" class="w-12 h-12 object-cover rounded mr-3"/>
          <div class="flex-grow">
            <span class="block font-bold text-sm">{{ item.name }}</span>
            <span class="block text-gray-600 text-xs">x{{ item.quantity }}</span>
            <span class="block text-gray-800 text-sm">{{ item.price }} €</span>
          </div>
        </li>
      </ul>
      <div class="p-3 text-center border-t border-gray-200">
        <span class="block font-bold text-lg mb-2">Total: {{ total_prix }} €</span>
        <button @click="goToCart"
                class="w-full bg-green-500 text-white rounded-lg py-2 font-semibold hover:bg-green-600">
          Voir le panier
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import {ref} from 'vue';
import {Cart} from "../../../scripts/Interfaces/cart";
import {router} from "@inertiajs/vue3";

defineProps<Cart>();

const showDropdown = ref(false);

// Toggle the dropdown menu
const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value;
};

// Navigate to the cart page
const goToCart = () => {
  router.push({name: 'cart'}); // Assumes a named route 'cart' exists
  showDropdown.value = false; // Close dropdown after navigating
};
</script>

<!-- No additional CSS is needed with Tailwind CSS -->
