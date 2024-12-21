import "./bootstrap";
import { createApp } from "vue";
import { createPinia } from "pinia";
import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";
import.meta.glob(["../images/**", "../fonts/**"]);

import Card from "./components/Card.vue";
import NbPanier from "./components/nbPanier.vue";
import Panier from "./components/panier.vue";
// import Index from './Pages/panier/index.vue';
import CardAdmin from "./components/card-admin.vue";
import Index from "./components/index.vue";
// import NbFavoris from './components/nbFavoris.vue';
// import NavBar from './components/nav-bar.vue';
const app = createApp();
const pinia = createPinia();
app.use(Toast, { position: POSITION.BOTTOM_RIGHT });
app.use(pinia);
app.component("card", Card);
app.component("card-admin", CardAdmin);
app.component("nbPanier", NbPanier);
// app.component("nbFavoris",NbFavoris);
app.component("panier", Panier);
app.component("index", Index);
// app.component("nav-bar",NavBar)
app.mount("#root");
