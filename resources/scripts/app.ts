import './bootstrap';
import '../css/app.css';
import "vue-toastification/dist/index.css";

import {createApp, DefineComponent, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from 'ziggy-js';
import AppLayout from "../views/vue/Layouts/AppLayout.vue";
import Toast from "vue-toastification";
import {ToastOptions} from "vue-toastification/src/types";
import {POSITION} from "vue-toastification/src";

const toast_options: ToastOptions = {
    timeout: 2000,
    position: POSITION.TOP_LEFT,
    toastClassName:'z-55',
    bodyClassName:'z-55'
};


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title: string) => `${title} - ${appName}`,
    resolve: async name => {
        const page: DefineComponent = await resolvePageComponent(
            `../views/vue/${name}.vue`,
            import.meta.glob<DefineComponent>("../views/vue/**/*.vue")
        );

        page.default.layout = page.default.layout || AppLayout;

        return page;
    },
    setup({el, App, props, plugin}) {
        const vueApp = createApp({render: () => h(App, props)});

        vueApp.use(plugin);
        vueApp.use(ZiggyVue);
        vueApp.use(Toast, toast_options);

        vueApp.mount(el as HTMLElement);
    },
    progress: {
        delay: 250,
        color: 'red',
        showSpinner: false,
    },
});
