import './bootstrap';
import { createInertiaApp } from '@inertiajs/inertia-svelte';
import { InertiaProgress } from '@inertiajs/progress';

// Skip booting the Inertia app if the current page is any of the auth routes.
// We haven't converted the auth routes to using inertia yet.
const shouldCreateInertiaApp = [
  'login',
  'register',
  'forgot-password',
  'reset-password',
  'confirm-password',
  'verify-email',
].every((value) => !window.location.pathname.includes(value));

if (shouldCreateInertiaApp) {
  InertiaProgress.init();

  createInertiaApp({
    resolve: (name) => require(`./pages/${name}.svelte`),
    setup({ el, App, props }) {
      new App({ target: el, props });
    },
  }).catch((error) => {
    alert(error.message);
  });
}
