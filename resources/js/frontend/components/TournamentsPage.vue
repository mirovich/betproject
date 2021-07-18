<template>
    <div>
        <Tabs :tabs="tabs" :tab-flag="tournamentStatus" @switchTab="switchTab"></Tabs>
        <TableTournaments :table-data="tableFilterTournament"></TableTournaments>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "TournamentsPage",
        components: {
            "Tabs": () => import("./Tabs"),
            "TableTournaments": () => import('./tournaments/TableTournaments')
        },
        computed: {
            tableFilterTournament() {
                let tournaments = this.tournaments;
                if (this.tournamentStatus === 1) {
                    tournaments = tournaments.filter(tournament => {
                        return tournament.tournamentStatus !== 3;
                    });
                } else if (this.tournamentStatus === 2) {
                    tournaments = tournaments.filter(tournament => {
                        return tournament.tournamentStatus === 3;
                    });
                }
                return tournaments;
            }
        },
        async mounted() {
            await axios.get('/GetTournaments')
                .then(response => {
                    this.tournaments = response.data.data;
                });
        },
        methods: {
            switchTab(flag) {
                this.tournamentStatus = flag;
            },
        },
        data: () => ({
            tournaments: [],
            tabs: {
                1: ["Открытые", "Opened"],
                2: ["Завершенные", "Closed"]
            },
            tournamentStatus: 1
        })
    }
</script>

<style scoped>

</style>
