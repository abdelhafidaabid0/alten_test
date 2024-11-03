<template>
  <section class="text-gray-600 body-font relative min-h-[90vh]">
    <div class="absolute inset-0 bg-gray-300 cursor-none">
      <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no"
              src="https://maps.google.com/maps?width=100%&height=100%&hl=en&q=rabat+(My%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed"
              style="filter: grayscale(1) contrast(1.2) opacity(0.4);" class="cursor-none"></iframe>
    </div>
    <div class="container px-5 py-24 mx-auto flex">
      <form ref="form_ref" @submit.prevent="submitForm"
            class="flex flex-col gap-2  lg:w-2/3 md:w-1/2 md:ml-auto w-full mt-10 md:mt-0 relative z-10 p-6 bg-white shadow-md rounded-lg max-w-md ">
        <SectionTitle>Contactez-nous</SectionTitle>
        <SectionBorder></SectionBorder>
        <div class="flex flex-col gap-2">
          <InputText label="Nom" id="nom" placeholder="Votre nom"></InputText>
          <InputText label="Émail" id="email" placeholder="Votre Émail"></InputText>
          <InputText label="Sujet" id="sujet" placeholder="Sujet"></InputText>
          <InputTextArea id="message" label="Message" max-length="300" placeholder="Votre message"></InputTextArea>
        </div>
        <!-- Submit Button -->
        <div class="transition-all ease-in-out duration-500 w-full transform">
          <div v-show="message_success"
               class="w-full flex justify-center gap-2 items-center text-green-500 text-center ">
            <Fa6Icon name="check" class="text-green-500 text-3xl"></Fa6Icon>
            <span ref="message_success_ref">{{ message_success }}</span>
          </div>
          <PrimaryButton
              v-show="!message_success"
              type_button="submit"
              class="w-full justify-center"
          >
            Envoyer
          </PrimaryButton>
        </div>
      </form>
    </div>
  </section>
</template>
<script setup lang="ts">
import {computed, onMounted, ref} from 'vue';
import PrimaryButton from "../../Components/PrimaryButton.vue";
import InputText from "../../Components/InputText.vue";
import InputTextArea from "../../Components/InputTextArea.vue";
import SectionBorder from "../../Components/SectionBorder.vue";
import SectionTitle from "../../Components/SectionTitle.vue";
import {router, usePage} from "@inertiajs/vue3";
import {route} from "ziggy-js";
import Fa6Icon from "../../Components/Fa6Icon.vue";

const notifications = computed(() => usePage().version && usePage().props?.notifications || [])
console.log(notifications.value)

const message_success = ref(notifications?.value[0]?.message)
const message_success_ref = ref()

const form_ref = ref(null)

// Submit form function
const submitForm = (event: Event) => {
  const form_data = new FormData(event.target);
  router.post(route("contact.send_message"), form_data, {
    onFinish: () => {
      message_success.value = usePage().props?.notifications[0].message;
      setTimeout(() => {
        location.reload();
      }, 3000)
    }
  })
};
onMounted(() => {
})
</script>

<style scoped>
/* Using Tailwind CSS for styling */
</style>
