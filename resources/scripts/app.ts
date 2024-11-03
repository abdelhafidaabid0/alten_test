import './bootstrap';
import '../css/app.css';

import {createApp, DefineComponent, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from 'ziggy-js';
import AppLayout from "../views/vue/Layouts/AppLayout.vue";

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

        vueApp.mount(el as HTMLElement);
    },
    progress: {
        delay: 250,
        color: 'red',
        showSpinner: false,
    },
});
