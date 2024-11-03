<template>
  <div class="pagination" v-if="total">
    <!--=========================================================================================================-->
    <!--  Récupérer le total des items, items par page.  ex: Lignes 1 à 3 sur 3 -->
    <!--=========================================================================================================-->
    <div class="text-container" v-if="!selected_items_count">
      <p class="text">
        <em>{{ from }}</em>
        à
        <em>{{ per_page < total ? per_page : total }}</em>
        sur
        <em>{{ total }}</em>
      </p>
    </div>


    <!--=========================================================================================================-->
    <!-- Récupérer les item sélectionner par le nombre total des items. ex : Sélection de 5 lignes sur 32 -->
    <!--=========================================================================================================-->
    <div class="text-container" v-else>
      <p class="text">
        Sélection de <em>{{ selected_items_count }}</em>
        ligne<span v-if="selected_items_count>1">s</span> sur
        <em>{{ total }}</em>
      </p>
    </div>


    <!--=========================================================================================================-->
    <!-- Lister les chois des items par page. ex : [5, 10...] -->
    <!--=========================================================================================================-->
    <div v-if="total > pagination_per_page[1]" class="links-container per-page-container">
      <button class="link par-page-link" disabled>Par page</button>
      <button v-for="choix in pagination_per_page.filter(choix=> choix < total * 2)" :key="choix" class="link"
              :class="{'link-active': per_page == choix}"
              @click="changer_par_page(choix)"
              type="button"
      >
        {{ choix }}
      </button>
    </div>


    <!--=========================================================================================================-->
    <!-- Les pages disponibles ça dépend des items  -->
    <!--=========================================================================================================-->
    <div class="links-container" v-if="links.slice(1, -1).length > 1">
      <!--=========================================================================================================-->
      <!-- Boutton précédant.-->
      <!--=========================================================================================================-->
      <button
          v-if="prev_page_url"
          class="previous-link link"
          @click="handle_page_change(prev_page_url || '')"
      >
        <Fa6Icon name="chevron-left"/>
      </button>
      <!--=========================================================================================================-->
      <!-- Liens principales. en cas de total des liens > 6, en affichant les liens avec '...'.-->
      <!--=========================================================================================================-->
      <template v-if="links.length > 6">
        <button
            v-for="link in links.slice(1, 3)"
            :key="link.label"
            @click="handle_page_change(link.url || '')"
            class="link"
            :class="{'link-active': link.active}">
          {{ link.label }}
        </button>


        <button class="link" v-if="!(current_page - 2 === 1)">...</button>
        <!--=========================================================================================================-->
        <!-- Cas des liens non inclus dans les 2 premiers et dérniers liens.-->
        <!--=========================================================================================================-->
        <div class="links-container"
             v-if="!is_current_page_in_slice(-3, -1) && !is_current_page_in_slice(1,3)"
        >
          <button
              class="link"
              :class="{'link-active': links.at(current_page)?.active}"
              @click="handle_page_change(links.at(current_page)?.url as string)"
          >
            {{ links.at(current_page)?.label }}
          </button>


          <button class="link" v-if="!(current_page + 2 === last_page)">...</button>
        </div>
        <button
            v-for="link in links.slice(-3, -1)"
            class="link"
            :class="{'link-active': link.active}"
            @click="handle_page_change(link.url || '')"
        >
          {{ link.label }}
        </button>
      </template>
      <!--=========================================================================================================-->
      <!-- Liens principales, en cas de total des liens < 6, en affichant les liens sans '...'.-->
      <!--=========================================================================================================-->
      <button
          v-else
          v-for="link in links.slice(1, -1)"
          :key="link.label"
          class="link"
          :class="{'link-active': link.active}"
          @click="handle_page_change(link.url || '')"
      >
        {{ link.label }}
      </button>


      <!--=========================================================================================================-->
      <!-- Boutton suivant.-->
      <!--=========================================================================================================-->
      <button
          v-if="next_page_url"
          class="next-link link"
          @click="handle_page_change(next_page_url || '')"
      >
        <Fa6Icon name="chevron-right" classes="text-sm"/>
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
//=========================================================================================================
// Vue & Constants
//=========================================================================================================
import {router} from "@inertiajs/vue3";
import {PaginatorInterface} from "../../../scripts/Interfaces/pagination";
import Fa6Icon from "./Fa6Icon.vue";
import {pagination_per_page} from "../../../scripts/constantes";

//=========================================================================================================
// Définir le prop
//=========================================================================================================
const props = withDefaults(defineProps<PaginatorInterface>(), {})


//=========================================================================================================
// Handle per page changed
//=========================================================================================================

//=========================================================================================================
// Handle per page changed
//=========================================================================================================
const changer_par_page = async (par_page: number) => {
  router.get(props.path, {
    per_page: par_page,
  }, {
    preserveScroll: true,
    replace: true,
  })
}


const handle_page_change = async (link: string) => {
  router.get(link)
}


//=========================================================================================================
// Fonction pour verifier c'est le lien est non existe dans les 2 premiers ou dérniers liens.
//=========================================================================================================
const is_current_page_in_slice = (start, end): boolean => {
  return props.links.slice(start, end).some(link => Number(link.label) === props.current_page)
}
</script>

<style scoped lang="scss">
.pagination {
  @apply grid grid-cols-3 bg-transparent items-center text-gray-500;

  .text-container {
    @apply justify-self-start;

    .text {
      @apply text-sm;

      em {
        @apply font-medium text-gray-700 not-italic;
      }
    }
  }

  .links-container {
    @apply isolate inline-flex -space-x-px rounded-md border border-gray-200 justify-self-end;

    .link {
      @apply p-2 px-3 text-sm border-x border-gray-200 flex justify-center items-center;

      &:hover {
        @apply bg-gray-400 text-white;
      }

      &:first-child {
        @apply border-none;
      }

      &:last-child {
        @apply border-none;
      }
    }

    .link-active {
      @apply bg-gray-200;
    }

    .previous-link {
      @apply rounded-l-md;
    }

    .next-link {
      @apply rounded-r-md;
    }
  }

  .per-page-container {
    @apply justify-self-center mx-auto;

    .par-page-link {
      @apply rounded-md whitespace-nowrap;

      &:hover {
        @apply bg-white text-gray-700;
      }
    }
  }
}

</style>