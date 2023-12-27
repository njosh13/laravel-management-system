import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { upperFirst, camelCase } from "lodash";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import route from "ziggy-js";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

const registerAppBaseComponents = (app) => {
    const components = import.meta.globEager("./Components/[App]*.(vue|js)");

    Object.entries(components).forEach(([path, definition]) => {
        const componentName = upperFirst(
            camelCase(
                // Gets the file name regardless of folder depth
                path
                    .split("/")
                    .pop()
                    .replace(/\.\w+$/, ""),
            ),
        );

        app.component(componentName, definition.default || definition);
    });
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob("./Pages/**/*.vue")),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Head", Head)
            .component("Link", Link)
            .mixin({
                methods: {
                    route,
                },
            });
        vueApp.config.devtools = false;
        vueApp.config.debug = false;
        vueApp.config.silent = true;

        registerAppBaseComponents(vueApp);

        vueApp.mount(el);
        return vueApp;
    },
    progress: {
        // The color of the progress bar...
        color: "#4B5563",
        // Whether to include the default NProgress styles...
        includeCSS: true,

        // Whether the NProgress spinner will be shown...
        showSpinner: true,
    },
});
