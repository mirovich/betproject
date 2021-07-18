import Vue from 'vue';
import BootstrapVue from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

Vue.use(BootstrapVue)
const frontend = new Vue({
    components: {
        'tournaments-page': () => import("./components/TournamentsPage"),
        'tournament-detail-page': () => import("./components/TournamentDetailPage"),
    },
    el: '#app'
});
