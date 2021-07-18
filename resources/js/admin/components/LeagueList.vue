<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <multiselect @select="selectLeague" :multiple="true" label="text" track-by="text" :searchable="true"
                             v-model="value"
                             :options="leagues"></multiselect>
            </div>
        </div>
        <div class="row match" v-if="value.length && matches.length">

            <div class="col-md-12">
                <div class="portlet light bordered" style="padding: 12px 10px 15px;">
                    <div class="portlet-body">
                        <div class="panel panel-default" v-for="(game, index) in matches">
                            <div class="panel-heading">
                                <img width="32" height="32" :src="game.logo"/>
                                {{game.name}} {{game.country}}
                                <button class="btn blue float-right" @click="getAllBets(game.id)"
                                        >Получить
                                    кофф
                                </button>
                            </div>
                            <div class="panel-body">
                                <table v-if="game.matches.length"
                                       class="table table-striped matchesTable table-bordered"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Выбор</th>
                                        <th>Дата матча</th>
                                        <th>Команда 1</th>
                                        <th>Команда 2</th>
                                        <th>Кофф.</th>
                                        <th>Управление</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(g, i) in game.matches" :key="i">
                                        <td style="vertical-align:middle">
                                            <input @change="handleChange(g)" type="checkbox" class="form-control"/>
                                        </td>
                                        <td style="vertical-align:middle">{{g.event_date}}</td>
                                        <td style="vertical-align:middle">
                                            {{g.homeTeam.team_name}}
                                            <img width="32" height="32" :src="g.homeTeam.logo" alt="">
                                        </td>
                                        <td style="vertical-align:middle">
                                            {{g.awayTeam.team_name}}
                                            <img width="32" height="32" :src="g.awayTeam.logo" alt="">
                                        </td>
                                        <td>
                                            <button :class="game.id" class="btn blue" :id="game.id" v-if="g.odds === null"
                                                    @click="getBets(g.fixture_id, game.id)">Получить
                                                кофф
                                            </button>
                                            <div v-else-if="g.odds !== null && g.odds.bets != null">
                                                <ul v-for="(bet, indx) in g.odds.bets">
                                                    <span>{{bet.label_name}}</span>
                                                    <li v-for="(value, v) in bet.values">
                                                        {{value.value}} - {{value.odd}}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div v-else>
                                                <span>Не возможно получить кофф</span>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import Multiselect from 'vue-multiselect'
    import 'vue-multiselect/dist/vue-multiselect.min.css'

    export default {
        name: 'LeagueList',
        components: {
            Multiselect
        },
        data: () => ({
            value: [],
            leagues: [],
            matches: [],
            selected: []
        }),
        methods: {
            handleChange(game) {
                let index = this.selected.findIndex(s => s.fixture_id === game.fixture_id);
                if (index === -1) {
                    this.selected.push(game);
                    $("#matchesInput").val(JSON.stringify(this.selected));
                } else {
                    this.selected.splice(index, 1);
                    $("#matchesInput").val(JSON.stringify(this.selected));
                }
            },
            getBets(id, league_id) {
                axios.post('/admin/parser/betsByMatchId', {
                    match_id: id
                }).then(response => {
                    if (response.status === 200) {
                        let leagueIndex = this.matches.findIndex(l => l.id === league_id);
                        if (leagueIndex > -1) {
                            let index = this.matches[leagueIndex].matches.findIndex(m => m.fixture_id === id);
                            if (index > -1) {
                                console.log(leagueIndex, index)
                                this.matches[leagueIndex].matches[index].odds = response.data.odds;
                            }
                        }
                    }
                })
                .catch(error => {
                    let leagueIndex = this.matches.findIndex(l => l.id === league_id);
                    if (leagueIndex > -1) {
                        let index = this.matches[leagueIndex].matches.findIndex(m => m.fixture_id === id);
                        if (index > -1) {
                            console.log(leagueIndex, index)
                            console.log(error.response.data)
                            this.matches[leagueIndex].matches[index].odds = error.response.data;
                        }
                    }
                });
            },
            getAllBets(id){
                var elems = document.querySelectorAll("[id='"+id+"']");
                for(var i = 0; i < elems.length; i++)
                        elems[i].click();
                    },
            selectLeague(event) {
                if (this.value.findIndex(l => l.id === event.id) === -1) {
                    axios.post('/admin/parser/matchesByLeagueId', {
                        league_id: event.id,
                        season: event.season.year,
                    }).then(response => {
                        if (response.status === 200 ) {
                            this.matches.push(response.data.matches);

                        }
                    })
                }
            }
        },
        mounted() {
            axios.get('/admin/parser/leagues')
                .then(response => {
                    if (response.status === 200) {
                        this.leagues = JSON.parse(response.data.leagues);
                    }
                });
        }
    }
</script>
