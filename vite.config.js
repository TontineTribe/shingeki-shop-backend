import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue"


export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
              'resources/css/admin/article/form.css', 
              'resources/css/admin/article/index.css', 
              'resources/css/admin/products/card.css', 
              'resources/css/admin/products/form.css', 
              'resources/css/admin/products/index.css', 
              'resources/css/admin/admin.css', 
              'resources/css/client/article.css', 
              'resources/css/client/index.css', 
              'resources/css/partials/card-article.css', 
              'resources/css/partials/input.css', 
              'resources/css/partials/select.css', 
              'resources/css/accueil.css', 
              'resources/css/all.min.css', 
              'resources/css/bulles.css', 
              'resources/css/card.css', 
              'resources/css/errors.css', 
              'resources/css/fontawesome.min.css', 
              'resources/css/formulaire.css', 
              'resources/css/inscription.css', 
              'resources/css/notAuthorize.css', 
              'resources/css/pagination.css', 
              'resources/css/panier.css', 
              'resources/css/show.css', 
              'resources/css/sorry.css', 
              'resources/css/star.css', 
              'resources/css/style.css', 
              'resources/css/variables.css', 
              'resources/js/composables/index.js',
              'resources/js/store/store.js',
              'resources/js/app.js',
              'resources/js/bootstrap.js',
              'resources/js/formulaire.js',
              'resources/js/heart.js',
              'resources/js/responsive-navbar.js',
              'resources/js/star.js',
            ],
            refresh: true,
        }),
    ],
    resolve:{
        alias:{
            vue:"vue/dist/vue.esm-bundler.js"
        },
        resolve: name => {
          const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
          return pages[`./Pages/${name}.vue`]
        },
    }
});
