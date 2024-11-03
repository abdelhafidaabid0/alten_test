<template>
  <div class="relative flex flex-col justify-between items-center border shadow-xl rounded h-full w-full ">
    <div class="flex gap-2 p-2 rounded bg-gray-100" v-if="product.quantity > 0">
      <PrimaryButton @click="add_to_cart">
        <Fa6Icon name="plus"></Fa6Icon>
        <span>Ajouter au panier</span>
      </PrimaryButton>
      <div class="flex items-center justify-center gap-2 w-fit">
        <Fa6Icon name="plus" @click="quantity< product.quantity && quantity++"
                 class="cursor-pointer hover:opacity-75"></Fa6Icon>
        <TextInput class="w-6/12" type="number" v-model="quantity" :min="1" :max="product.quantity"></TextInput>
        <Fa6Icon name="minus" @click="quantity > 1 && quantity--" class="cursor-pointer hover:opacity-75"></Fa6Icon>
      </div>

    </div>
    <div class="relative grid place-content-center p-4 w-full h-full">
      <ProductInventoryStatut
          :inventory_status="product.inventory_status" class="absolute top-2 left-2"/>
      <ProductRating :rating="product.rating" class="absolute top-2 right-2"/>
      <div>
        <img :src="product.image" alt="Image du produit" class="aspect-square p-4 h-52 w-52"/>
      </div>
    </div>
    <div class="flex flex-col items-center gap-1 w-full px-1">
      <div class="flex justify-between items-center gap-2 w-full">
        <span class="capitalize text-lg text-yellow-700">{{ product.name }}</span>
        <span class="text-2xl text-green-700 whitespace-nowrap">{{ product.price }} €</span>
      </div>
      <div class=" flex justify-between items-center gap-2 w-full px-1" v-if="product.quantity > 0">
        <span class="text-xs">Quantité disponible</span>
        <span class="text-2xl text-green-700 whitespace-nowrap">{{ quantite_dispo }}</span>
      </div>
      <div class="w-full px-1">
        <p class="truncate text-sm">{{ product.description }}</p>
      </div>
    </div>
    <div class="flex flex-col items-center gap-2  p-2 rounded">
      <PrimaryButton @click="consulte_product" type="secondary">
        <Fa6Icon name="eye"></Fa6Icon>
        <span>Consulter</span>
      </PrimaryButton>
    </div>
  </div>
</template>
z
<script setup lang="ts">
import {computed, defineEmits, defineProps, ref} from 'vue';
import TextInput from "./TextInput.vue";
import Fa6Icon from "./Fa6Icon.vue";
import PrimaryButton from "./PrimaryButton.vue";
import {Product} from "../../../scripts/Interfaces/product";
import ProductInventoryStatut from "./ProductInventoryStatut.vue";
import ProductRating from "./ProductRating.vue";
import {product_inventory_status} from "../../../scripts/constantes";

const props = defineProps<{ product: Product }>();

const quantity = ref(1)


const quantite_dispo = computed(() => {
  if (props.product.inventory_status === product_inventory_status.outofstock) {
    return "0";
  }

  return props.product.quantity;
})

// Définir les événements émis par le composant
const emit = defineEmits<{
  (e: 'add-to-cart', product: Product, quantity: number): void;
  (e: 'consulte-product', product: Product): void;
}>();

// Fonction pour ajouter le produit au panier
const add_to_cart = () => {
  emit('add-to-cart', props.product,quantity.value);
  quantity.value = 1;
};
const consulte_product = () => {
  emit('consulte-product', props.product);
};

</script>

