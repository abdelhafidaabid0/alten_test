<template>
  <div class="p-4 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Votre Panier</h2>

    <!-- Check if there are items in the cart -->
    <div v-if="cart_info && cart_info?.products?.length && cart_info?.products?.length> 0">
      <ul class="space-y-4">
        <li v-for="product in cart_info.products" :key="product.id"
            class="grid grid-cols-3 items-center p-4 bg-gray-50 rounded-lg shadow">
          <div class="flex justify-center">
            <img :src="product.image" alt="Image du produit" class="aspect-square p-4 h-52 w-52"/>
          </div>
          <div>
            <p class="font-semibold text-lg text-gray-800">{{ product.name }}</p>
            <p class="text-gray-500">Prix unité : {{ product.price }} €</p>
            <p class="text-yellow-600">Quantité: {{ cart_info.quantities[product.id] }}</p>
            <p class="text-green-600 font-semibold">Total:
              {{ (product.price * cart_info.quantities[product.id]).toFixed(2) }} €</p>
          </div>
          <!-- Remove Button -->
          <div class="flex justify-end">
            <PrimaryButton type="danger" @click="removeItem(product.id)">
              <Fa6Icon name="trash"></Fa6Icon>
              <span>Supprimer du panier</span>
            </PrimaryButton>
          </div>
        </li>
      </ul>

      <!-- Cart Totals -->
      <div class="mt-6 border-t pt-4 flex items-center justify-between">
        <div>
          <p class="text-lg font-semibold text-yellow-700">Total des produits : {{ cart_info.total_quantities }}</p>
          <p class="text-lg font-semibold text-green-700">Total prix : {{ cart_info.total_price }} €</p>
        </div>
        <PrimaryButton>Procéder au paiment</PrimaryButton>
      </div>
    </div>

    <!-- Empty Cart Message -->
    <p v-else class="text-center text-gray-500">Votre panier est vide.</p>
  </div>
</template>

<script setup lang="ts">
import {computed, ComputedRef} from 'vue';
import {router, usePage} from "@inertiajs/vue3";
import {Cart} from "../../../../scripts/Interfaces/cart";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import Fa6Icon from "../../Components/Fa6Icon.vue";
import {route} from "ziggy-js";

const cart_info: ComputedRef<Cart> = computed(() => usePage().props.cart_info as Cart);

const removeItem = (productId: number) => {
  router.post(route('cart.remove_from_cart', productId), {}, {replace: true, preserveScroll: true})
};

</script>
