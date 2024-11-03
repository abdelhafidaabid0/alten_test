<template>
  <div class="flex items-center gap-4">
    <label for="sort" class="text-sm font-medium text-gray-700">Trier par :</label>
    <select
        id="sort"
        v-model="selected_sort"
        @change="sort_products"
        class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
    >
      <option value="name_asc">Nom (A-Z)</option>
      <option value="name_desc">Nom (Z-A)</option>
      <option value="price_asc">Prix croissant</option>
      <option value="price_desc">Prix décroissant</option>
      <option value="rating_desc">Meilleures évaluations</option>
    </select>
  </div>
</template>

<script setup lang="ts">
import {ref} from 'vue';
import {router} from '@inertiajs/vue3';
import {route} from 'ziggy-js';

// Définition de la valeur par défaut pour le tri
const selected_sort = ref('name_asc');

// Fonction pour appliquer le tri en envoyant une requête à l'API avec les paramètres de tri
const sort_products = () => {
  const updated_filters = {
    sort: selected_sort.value
  };
  // Redirection avec les nouveaux filtres appliqués
  router.get(route('home'), updated_filters, {preserveScroll: true,});
};
</script>

<style scoped>
/* Style supplémentaire pour le sélecteur de tri */
</style>
