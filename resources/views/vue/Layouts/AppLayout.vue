<script setup>
import {Link, usePage} from '@inertiajs/vue3';
import ApplicationMark from '../Components/ApplicationMark.vue';
import ResponsiveNavLink from '../Components/ResponsiveNavLink.vue';
import {computed, ref} from 'vue';
import CartIcon from '../Components/CartIcon.vue';
import NavLink from '../Components/NavLink.vue';
import {route} from 'ziggy-js';


const panier_info = computed(() => usePage().props.panier_info);

const showingNavigationDropdown = ref(false);

</script>

<template>
  <div class="min-h-screen bg-white max-w-7xl mx-auto">
    <nav class="border-b border-gray-100">
      <!-- Primary Navigation Menu -->
      <div class="flex justify-between h-16">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
          <Link :href="route('home')">
            <ApplicationMark class="block h-9 w-auto"/>
          </Link>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ms-6">
          <div class="ms-3 relative">
            <NavLink :href="route('home')">
              Product
            </NavLink>
          </div>

          <div class="ms-3 relative">
            <NavLink :href="route('contact')">
              Contact
            </NavLink>
          </div>
          <div class="ms-3 relative">
            <CartIcon v-bind="panier_info"></CartIcon>
          </div>
        </div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
          <button
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
              @click="showingNavigationDropdown = ! showingNavigationDropdown">
            <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 24 24"
            >
              <path
                  :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                  :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>

      <!-- Responsive Navigation Menu (Mobile)-->
      <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
          <ResponsiveNavLink :href="route('home')" :active="route().current('home')">
            Home
          </ResponsiveNavLink>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">

        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <main>
      <slot/>
    </main>
  </div>
</template>
