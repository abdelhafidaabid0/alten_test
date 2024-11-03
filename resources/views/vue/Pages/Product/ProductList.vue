<template>
  <div class="grid gap-2">
    <SectionTitle>Liste des Produits</SectionTitle>
    <ProductFiltres @filter-changed="fetchFilteredProducts"/>
    <Pagination v-bind="products"></Pagination>
    <div
        class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-2 min-h-[75vh] place-items-start grid-flow-row auto-rows-[minmax(0,_1fr)]">
      <template v-for="product in products.data" :key="product.id">
        <ProductItem :product="product" @consulteProduct="consulte_product" @addToCart="add_to_cart"/>
      </template>
    </div>
    <Pagination v-bind="products"></Pagination>
    <Modal closeable :show="show_detail" @close="show_detail=false" >
      <ProductDetail :product="selected_product" @CloseDetail="show_detail = false" @addToCart="add_to_cart"></ProductDetail>
    </Modal>
  </div>
</template>

<script setup lang="ts">
import {defineProps, ref} from 'vue';
import SectionTitle from "../../Components/SectionTitle.vue";
import ProductItem from "../../Components/ProductItem.vue";
import Pagination from "../../Components/Pagination.vue";
import {PaginatorInterface} from "../../../../scripts/Interfaces/pagination";
import {Product} from "../../../../scripts/Interfaces/product";
import ProductFiltres from "../../Components/ProductFiltres.vue";
import {router} from "@inertiajs/vue3";
import ProductDetail from "./ProductDetail.vue";
import Modal from "../../Components/Modal.vue";

const props = defineProps<{ products: PaginatorInterface<Product> }>();

const products = ref(props.products);

// Function to fetch products based on filters
const fetchFilteredProducts = (filters: {
  statut: string | null,
  category: string | null;
  min_price: number | null;
  max_price: number | null;
  rating: number | null
}) => {
  // Fetch products from API or perform filter logic here
  filters.page = 1;
  router.get(props.products.path, filters, {
    preserveScroll: true,
    replace: true,
  })
  // Example: Use filters to send a request to the backend API
};

const show_detail = ref(false);
const selected_product = ref(null)

const consulte_product = (product: Product) => {
  show_detail.value = true;
  selected_product.value = product;
}
const add_to_cart = (product: Product,quantity:number) => {
  console.log(product,quantity)
}

</script>
