require("./bootstrap");

import Vue from "vue";

import { InertiaApp } from "@inertiajs/inertia-vue";
import { InertiaForm } from "laravel-jetstream";
import PortalVue from "portal-vue";

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

const app = document.getElementById("app");

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => {
                    const pattren = "^[a-zA-Z0-9]+::+.*$";
                    const reg = new RegExp(pattren);

                    if (name.match(reg)) {
                        // Import comoponents from modules
                        let parts = name.split("::");
                        let module_name =
                            parts[0].charAt(0).toUpperCase() + parts[0].slice(1);
                        let c_name = parts[1];

                        return import(
                            `~/${module_name}/Resources/assets/js/Pages/${c_name}.vue`
                        ).then(module => module.default);
                    }

                    return require(`./Pages/${name}`).default;
                }
            }
        })
}).$mount(app);
