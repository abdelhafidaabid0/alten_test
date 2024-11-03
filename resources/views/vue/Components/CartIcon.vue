<template>
  <div class="relative flex items-center " :class="{'cursor-pointer':products && products.length > 0}"
  >
    <!-- Cart Icon with Badge -->
    <Fa6Icon name="shopping-cart" class="text-2xl" @click="toggleDropdown"/>
    <span v-if="products && products.length > 0"
          class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs font-bold px-2">
            {{ total_quantities }}
        </span>

    <!-- Dropdown Menu for Cart Items -->
    <div v-if="showDropdown && products && products.length > 0"
         v-on-click-outside="() => showDropdown = false"
         class="absolute top-0 right-0 mt-2 w-72 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
      <div class="p-3 font-bold border-b border-gray-200 flex items-center justify-between">
        <span class="">Panier</span>
        <span class="text-sm">Nombre de produits : {{ total_quantities }}</span>
      </div>
      <ul class="max-h-48 overflow-y-auto">
        <li v-for="item in products" :key="item.id" class="flex items-center p-3 border-b border-gray-100">
          <img :src="item.image" alt="Product image" class="w-12 h-12 object-cover rounded mr-3"/>
          <div class="flex-grow relative">
            <span class="block font-bold text-sm">{{ item.name }}</span>
            <span class="block text-yellow-600 text-xs">x{{ quantities[item.id] }}</span>
            <span class="block text-green-700 text-sm">{{ item.price }} €</span>
            <!-- Remove Button -->
            <PrimaryButton type="danger" class="absolute top-1 right-1" @click="remove_from_cart(item.id)">
              <Fa6Icon name="trash"/>
            </PrimaryButton>

          </div>
        </li>
      </ul>
      <div class="p-3 text-center border-t border-gray-200">
        <span class="block font-bold text-lg mb-2">Total: {{ total_price }} €</span>
        <div class="flex items-center justify-center gap-2">
          <PrimaryButton type="secondary" @click="go_to_cart">Voir le panier</PrimaryButton>
          <PrimaryButton type="primary" @click="go_to_cart">Procéder au paiment</PrimaryButton>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import {ref} from 'vue';
import {Cart} from "../../../scripts/Interfaces/cart";
import {router} from "@inertiajs/vue3";

import {vOnClickOutside} from '@vueuse/components';
import PrimaryButton from "./PrimaryButton.vue";
import {route} from "ziggy-js";
import Fa6Icon from "./Fa6Icon.vue";


const props = defineProps<Cart>();

const showDropdown = ref(false);

// Toggle the dropdown menu
const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value;
};

// Navigate to the cart page
const go_to_cart = () => {
  showDropdown.value = false; // Close dropdown after navigating
  router.get(route("cart")); // Assumes a named route 'cart' exists
};

const remove_from_cart = (product_id: number) => {
  router.post(route('cart.remove_from_cart', product_id), {}, {replace: true, preserveScroll: true})
  if (props?.products?.length === 1) {
    showDropdown.value = false;
  }
}
</script>

