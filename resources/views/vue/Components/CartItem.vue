<template>
  <div class="cart-item">
    <img :src="item.image" alt="Product Image" class="cart-item__image" />
    <div class="cart-item__details">
      <h3 class="cart-item__name">{{ item.name }}</h3>
      <p class="cart-item__price">{{ item.price }} €</p>
      <div class="cart-item__quantity">
        <button @click="decreaseQuantity" :disabled="item.quantity <= 1">-</button>
        <span>{{ item.quantity }}</span>
        <button @click="increaseQuantity">+</button>
      </div>
    </div>
    <button @click="removeItem" class="cart-item__remove">Supprimer</button>
  </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import {CartItem} from "../../../scripts/Interfaces/cart";

const props = defineProps<{ item: CartItem }>();

// Définir les événements émis par le composant
const emit = defineEmits<{
  (e: 'remove', id: number): void;
  (e: 'updateQuantity', id: number, quantity: number): void;
}>();

// Fonction pour augmenter la quantité de l'article
const increaseQuantity = () => {
  emit('updateQuantity', props.item.id, props.item.quantity + 1);
};

// Fonction pour diminuer la quantité de l'article
const decreaseQuantity = () => {
  if (props.item.quantity > 1) {
    emit('updateQuantity', props.item.id, props.item.quantity - 1);
  }
};

// Fonction pour supprimer l'article du panier
const removeItem = () => {
  emit('remove', props.item.id);
};
</script>

<style scoped>
.cart-item {
  display: flex;
  align-items: center;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.cart-item__image {
  width: 80px;
  height: 80px;
  object-fit: cover;
  margin-right: 15px;
}

.cart-item__details {
  flex-grow: 1;
}

.cart-item__name {
  font-size: 1.2rem;
  margin: 0;
}

.cart-item__price {
  color: #888;
  margin: 5px 0;
}

.cart-item__quantity {
  display: flex;
  align-items: center;
}

.cart-item__quantity button {
  width: 30px;
  height: 30px;
  font-size: 1rem;
  background-color: #ddd;
  border: none;
  cursor: pointer;
}

.cart-item__quantity span {
  margin: 0 10px;
}

.cart-item__remove {
  background-color: #f44336;
  color: #fff;
  padding: 5px 10px;
  border: none;
  cursor: pointer;
}
</style>
