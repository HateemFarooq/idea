import './bootstrap'
import { createApp, h } from 'vue'
import { createInertiaApp, Head } from '@inertiajs/vue3'


createInertiaApp({

    title: (title) => title ? `${title} | Admin Panel` : 'Admin Panel',

    resolve: (name) => import(`./Pages/${name}.vue`),

    setup({ el, App, props, plugin }) {

        const vueApp = createApp({ render: () => h(App, props) })

        vueApp.use(plugin)

        vueApp.mount(el)

    },
})