import './bootstrap';
import { createInertiaApp } from '@inertiajs/inertia-svelte';
import { InertiaProgress } from '@inertiajs/progress';

InertiaProgress.init();

createInertiaApp({
  resolve: (name) => require(`./pages/${name}.svelte`),
  setup({ el, App, props }) {
    new App({ target: el, props });
  },
}).catch((error) => {
  alert(error.message);
});
