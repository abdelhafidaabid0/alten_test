<template>
  <div class="relative flex items-center" :class="{'cursor-pointer':products && products.length > 0}">
    <!-- Cart Icon with Badge -->
    <Fa6Icon name="shopping-cart" class="text-2xl" @click.stop="toggleDropdown"/>
    <span v-if="products && products.length > 0"
          class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs font-bold px-2">
            {{ total_quantities }}
    </span>

    <!-- Dropdown Menu for Cart Items -->
    <div v-if="showDropdown && products && products.length > 0"
         v-on-click-outside="() => showDropdown = false"
         class="absolute top-0 right-0 mt-2 w-72 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
      <div class="p-3 font-bold border-b border-gray-200 flex items-center justify-between">
        <span>Panier</span>
        <span class="text-sm">Nombre de produits : {{ total_quantities }}</span>
      </div>
      <ul class="max-h-48 overflow-y-auto">
        <li v-for="item in products" :key="item.id" class="flex items-center p-3 border-b border-gray-100">
          <img :src="item.image" alt="Product image" class="w-12 h-12 object-cover rounded mr-3"/>
          <div class="flex-grow relative">
            <span class="block font-bold text-sm">{{ item.name }}</span>
            <span class="block text-yellow-600 text-xs">x{{ quantities[item.id] }}</span>
            <span class="block text-green-700 text-sm">{{ item.price }} €</span>
            <!-- Quantity Controls -->
            <div class="flex items-center gap-2 mt-1">
              <button @click.stop="decrease_quantity(item.id)" class="px-2 py-1 bg-gray-200 rounded cursor-pointer hover:opacity-75">-</button>
              <span>{{ quantities[item.id] }}</span>
              <button @click.stop="increase_quantity(item.id)" class="px-2 py-1 bg-gray-200 rounded cursor-pointer hover:opacity-75">+</button>
            </div>
            <!-- Remove Button -->
            <PrimaryButton type="danger" class="absolute top-1 right-1" @click.stop="remove_from_cart(item.id)">
              <Fa6Icon name="trash"/>
            </PrimaryButton>
          </div>
        </li>
      </ul>
      <div class="p-3 text-center border-t border-gray-200">
        <span class="block font-bold text-lg mb-2">Total: {{ total_price }} €</span>
        <div class="flex items-center justify-center gap-2">
          <PrimaryButton type="secondary" @click.stop="go_to_cart">Voir le panier</PrimaryButton>
          <PrimaryButton type="primary" @click.stop="go_to_cart">Procéder au paiement</PrimaryButton>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import {ref} from 'vue';
import {router} from "@inertiajs/vue3";

import {vOnClickOutside} from '@vueuse/components';
import PrimaryButton from "./PrimaryButton.vue";
import {route} from "ziggy-js";
import Fa6Icon from "./Fa6Icon.vue";
import {Cart} from "../../../scripts/Interfaces/cart";


const props = defineProps<Cart>();

const showDropdown = ref(false);

// Fonction pour basculer le menu déroulant
const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value;
};

// Fonction pour aller à la page du panier
const go_to_cart = () => {
  showDropdown.value = false; // Fermer le menu après navigation
  router.get(route("cart")); // Suppose une route nommée 'cart'
};

// Fonction pour supprimer un produit du panier
const remove_from_cart = (product_id: number) => {
  router.post(route('cart.remove_from_cart', product_id), {}, {replace: true, preserveScroll: true});
  if (props?.products?.length === 1) {
    showDropdown.value = false;
  }
};

// Fonction pour augmenter la quantité d'un produit
const increase_quantity = (product_id: number) => {
  router.post(route('cart.update_cart_product_quantity', {
    product_id,
    quantity: Number(props.quantities[product_id]) + 1
  }), {}, {replace: true, preserveScroll: true});
};

// Fonction pour diminuer la quantité d'un produit
const decrease_quantity = (product_id: number) => {
  if (props.quantities[product_id] > 1) { // S'assurer que la quantité ne soit pas inférieure à 1
    router.post(route('cart.update_cart_product_quantity', {
      product_id,
      quantity: Number(props.quantities[product_id]) - 1
    }), {}, {replace: true, preserveScroll: true});
  }
};
</script>
