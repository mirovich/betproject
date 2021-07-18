import Vue from 'vue';

new Vue({
    el: '#app',
    components: {
        'league-list': () => import("./components/LeagueList")
    }
})
