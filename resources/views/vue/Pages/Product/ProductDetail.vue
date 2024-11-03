<template>
  <div v-if="product" class="flex flex-col p-4 bg-white shadow-md rounded-lg border border-gray-200 w-full gap-2">
    <!-- Add to Cart and Quantity Controls -->
    <img :src="product.image" :alt="product.name" class="w-full h-72 object-contain rounded mb-4"/>

    <div class="flex justify-between">
      <!-- Stock Status Badge -->
      <ProductInventoryStatut :inventory_status="product.inventory_status" />

      <!-- Rating -->
      <ProductRating :rating="product.rating" />
    </div>

    <!-- Product Information -->
    <h2 class="text-lg font-semibold text-gray-800">{{ product.name }}</h2>
    <p class="text-green-600 text-3xl font-semibold text-center border border-gray-200 rounded p-4">{{ product.price }} €</p>
    <p class="text-gray-500">Quantité disponible: {{ product.quantity }}</p>
    <p class="text-gray-600 text-sm mt-2">{{ product.description }}</p>
    <div class="flex flex-wrap self-center gap-2 p-2 rounded bg-gray-100" v-if="product.quantity > 0">
      <div class="flex items-center justify-center gap-2 w-fit">
        <Fa6Icon name="plus" @click="quantity< product.quantity && quantity++" class="cursor-pointer hover:opacity-75"></Fa6Icon>
        <TextInput class="w-6/12" type="number" v-model="quantity" :min="1" :max="product.quantity"></TextInput>
        <Fa6Icon name="minus" @click="quantity > 1 && quantity--" class="cursor-pointer hover:opacity-75"></Fa6Icon>
      </div>
      <PrimaryButton @click="add_to_cart">
        <Fa6Icon name="plus"></Fa6Icon>
        <span>Ajouter au panier</span>
      </PrimaryButton>
      <PrimaryButton @click="close_detail" type="secondary" class="w-fit">
        <span>Fermer</span>
      </PrimaryButton>
    </div>
    <PrimaryButton v-else @click="close_detail" type="secondary" class="w-fit self-end">
      <span>Fermer</span>
    </PrimaryButton>
  </div>
</template>

<script setup lang="ts">
import {defineEmits, defineProps, ref} from 'vue';
import ProductInventoryStatut from "../../Components/ProductInventoryStatut.vue";
import ProductRating from "../../Components/ProductRating.vue";
import {Product} from "../../../../scripts/Interfaces/product";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import Fa6Icon from "../../Components/Fa6Icon.vue";
import TextInput from "../../Components/TextInput.vue";
// Props to receive the product details
const props = defineProps<{ product: Product }>();

// Define emitted events
const emit = defineEmits<{
  'add-to-cart': (product: Product, quantity: number) => void;
  'close-detail': () => void;
}>();

// Reactive state for quantity
const quantity = ref(1);

// Methods to handle quantity adjustment
const increaseQuantity = () => {
  quantity.value++;
};

const decreaseQuantity = () => {
  if (quantity.value > 1) {
    quantity.value--;
  }
};

// Methods to emit events
const add_to_cart = () => {
  emit('add-to-cart', props.product, quantity.value);
};

const close_detail = () => {
  emit('close-detail');
};
</script>

<style scoped>
/* Using Tailwind CSS for styling */
</style>
