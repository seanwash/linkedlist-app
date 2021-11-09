const mix = require('laravel-mix');

require('laravel-mix-svelte');

const base = mix
  .js('resources/js/app.js', 'public/js')
  .svelte({
    dev: !mix.inProduction(),
  })
  .sourceMaps()
  .postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
  ])
  .disableSuccessNotifications();

if (mix.inProduction()) {
  console.log('Production build');
  mix.version();
}
