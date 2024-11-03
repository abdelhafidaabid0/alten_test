<template>
    <span :class="badgeClass" class="px-3 py-1 rounded-full text-white font-semibold text-xs">
        {{ statusText }}
    </span>
</template>

<script setup lang="ts">
// Define the props to receive the product's inventory status
import { computed, defineProps } from 'vue';
import {InventoryStatus} from "../../../scripts/Interfaces/product";
import {product_inventory_status} from "../../../scripts/constantes";

// Type for inventory status options

// Props to receive the inventory status of the product
const props = defineProps<{
  inventory_status: InventoryStatus;
}>();

// Compute the badge text based on the inventory status
const statusText = computed(() => {
  switch (props.inventory_status) {
    case product_inventory_status.instock:
      return 'En Stock';
    case product_inventory_status.lowstock:
      return 'Stock Faible';
    case product_inventory_status.outofstock:
      return 'Rupture de Stock';
    default:
      return '';
  }
});

// Compute the badge color class based on the inventory status
const badgeClass = computed(() => {
  switch (props.inventory_status) {
    case product_inventory_status.instock:
      return 'bg-green-500';
    case product_inventory_status.lowstock:
      return 'bg-yellow-500';
    case product_inventory_status.outofstock:
      return 'bg-red-500';
    default:
      return 'bg-gray-500';
  }
});
</script>

