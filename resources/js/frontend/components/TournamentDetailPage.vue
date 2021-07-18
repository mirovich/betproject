<template>
    <div>
        <b-row>
            <b-col cols="12">
                <div class="tournament-detail-head">
                    <div class="tournament-id">
                        <span class="tournament-id-text">ID: {{id}}</span>
                    </div>
                    <section class="container-head">
                        <div class="container-item">
                            <div class="tournament-logo">
                                <img
                                    :src="tournament.icon"
                                    alt="Логотип турнира"
                                    class="tournament-logo-img"></div>
                            <div class="tournament-header-block">
                                <span class="tournament-header">{{name}}</span>
                                <div class="tournamet-info-header">
                                    <span class="tournament-date">{{startDate}} - {{endDate}}</span>
                                    <span class="tournament-detail-info">
                                        <i class="material-icons tournament-detail-info__icon">people2</i>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </b-col>
        </b-row>
        <Tabs :tabs="tabs" :tab-flag="tabStatus" @switchTab="switchTab"></Tabs>
        <GamesInTournament :matches="matches" :tournamentId ="tournamentId" :userid="this.$userId"  :price="tournament.buyin"></GamesInTournament>

        <br />
        <div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "TournamentDetailPage",
        components: {
            'Tabs': () => import('../components/Tabs'),
            'GamesInTournament': () => import('../components/tournaments/GamesInTournament')
        },
        methods: {
            switchTab(tab) {

                this.tabStatus = tab;
                console.log(this.tabStatus)
                if( this.tabStatus === 1 ){
                    return this.matches;
                    return this.endDate;
                }else{
                    return 'qq'

                }
            }

        },
        data: () => ({
            tournament: [],
            tabFlag: 1,
            tabStatus: 1,
            tabs: {1: ["Матчи", "Matches"], 2: ["Участники", "Participants"]},
        }),
        computed: {

            thisDate() {
                return this.$moment(new Date()).toDate();

            },
            // userId() {
            //     return this.tournament.userId;
            // },
            tournamentId() {
                return this.id;
            },
            usersTournamentBet() {
                 return this.tournament.userTournamentBets;
            },
            name() {
                return this.tournament.tournamentName;
            },
            description() {
                return this.tournament.description;
            },
            startDate() {
                return this.tournament.startDate;
            },
            endDate() {
                return this.tournament.endDate;
            },
            matches() {
                return this.tournament.events;
            },
            eventBets() {
                return this.tournament.eventBets;
            },
            distribution() {
                return this.tournament.distribution;
            },
            betTypes() {
                return this.tournament.betTypes;
            },
            betTypeOutcomes() {
                return this.tournament.betTypeOutcomes;
            },
            buyin() {
                return this.tournament.buyin;
            },

        },
        mounted() {
        },
        props: {
            id: Number,
        },
        async mounted() {
            await axios.get('/GetTournamentInfo/' + this.id)
                .then(result => {
                    this.tournament = result.data.data;

                })
        }
    }
</script>

<style scoped>

</style>
