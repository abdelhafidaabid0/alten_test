<template>
  <div class="p-4 bg-white shadow-md rounded-lg">
    <h2 class="text-lg font-semibold">Filtres de produits</h2>

    <!-- Category Filter -->
    <div class="grid grid-cols-12 gap-2 justify-items-start place-items-center">
      <div class="col-span-2 w-full">
        <label class="block font-medium mb-2">Statut</label>
        <select v-model="selectedStatut" @change="applyFilters" class="w-full p-2 border border-gray-300 rounded">
          <option :value="0">Toutes les status</option>
          <option v-for="(statut,index) in status" :key="index" :value="index">
            {{ statut }}
          </option>
        </select>
      </div>
      <div class="col-span-2 w-full">
        <label class="block font-medium mb-2">Catégorie</label>
        <select v-model="selectedCategory" @change="applyFilters" class="w-full p-2 border border-gray-300 rounded">
          <option :value="0">Toutes les catégories</option>
          <option v-for="(category,index) in categories" :key="index" :value="index">
            {{ category }}
          </option>
        </select>
      </div>

      <!-- Price Range Filter -->


      <!-- Rating Filter -->
      <div class="col-span-2 w-full">
        <label class="block font-medium mb-2">Évaluation minimale</label>
        <select v-model="selectedRating" @change="applyFilters" class="w-full p-2 border border-gray-300 rounded">
          <option :value="0">Toutes les évaluations</option>
          <option v-for="(rating,index) in ratings" :key="index" :value="index">
            {{ rating }}
          </option>
        </select>
      </div>
      <div class="col-span-4">
        <label class="block font-medium mb-2">Prix</label>
        <div class="flex items-center space-x-2">
          <input type="number" v-model.number="minPrice" @blur="applyFilters" placeholder="Min"
                 class="w-full p-2 border border-gray-300 rounded">
          <span>-</span>
          <input type="number" v-model.number="maxPrice" @blur="applyFilters" placeholder="Max"
                 class="w-full p-2 border border-gray-300 rounded">
        </div>
      </div>
      <!-- Reset Filters Button -->
      <div class="col-span-2 w-full">
        <PrimaryButton @click="resetFilters" type="danger">Réinitialiser les filtres</PrimaryButton>
      </div>
    </div>

  </div>
</template>

<script setup lang="ts">
import {computed, defineEmits, ref} from 'vue';
import PrimaryButton from "./PrimaryButton.vue";
import {usePage} from "@inertiajs/vue3";

// Dummy data for categories and ratings (replace with API data if available)
const categories = computed(() => usePage().props.categories_list);
const status = computed(() => usePage().props.statuts_list);
const ratings = computed(() => usePage().props.rating_list);
const active_filters = computed(() => usePage().props.active_filters);

// Define reactive filter variables
const selectedStatut = ref<string | null>(active_filters.value.statut ?? 0);
const selectedCategory = ref<string | null>(active_filters.value.category ?? 0);
const minPrice = ref<number | null>(active_filters.value.min_price);
const maxPrice = ref<number | null>(active_filters.value.max_price);
const selectedRating = ref<number | null>(active_filters.value.min_rating);

// Emit event to send filters to parent component
const emit = defineEmits<{
  (e: 'filter-changed', filters: {
    statut: string | null | number;
    category: string | null | number;
    min_price: number | null;
    max_price: number | null;
    min_rating: number | null;
  }): void;
}>();

// Function to emit filters to parent component
const applyFilters = () => {
  emit('filter-changed', {
    statut: selectedStatut.value,
    category: selectedCategory.value,
    min_price: minPrice.value,
    max_price: maxPrice.value,
    min_rating: selectedRating.value,
  });
};

// Function to reset filters
const resetFilters = () => {
  selectedStatut.value = 0;
  selectedCategory.value = 0;
  minPrice.value = 0;
  maxPrice.value = 0;
  selectedRating.value = 0;
  applyFilters();
};
</script>

