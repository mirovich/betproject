<template>
<div class="BetsInGame card">
            <p> Победитель</p>
                <span> 1</span><span> x</span><span> 2</span>
                <br>
                <select v-model="firstScoreList[matchId]" >
                    <option v-for="(bet, index) in bets.slice(0, 3)" :key="`first${index}`" >
                        {{ bet.odd * 100 }}
                    </option>
                </select>

                <br>
                <p>3 гола и больше</p>
                <span> ДА </span><span> НЕТ </span>
                <br>
                <select v-model="secondScoreList[matchId]" >
                    <option v-for="(bet, index) in bets.slice(3, 5)" :key="`second${index}`" >
                        {{ bet.odd * 100 }}
                    </option>
                </select>

                <div> {{ this.secondScore }} </div>

                </div>
</template>


<script>
    export default {
        name: "BetsInGame",
        data: () => ({
            secondScore: null,
            firstScore: null,
        }),

        methods: {
            secondHandleScore(event) {
                this.secondScore[this.matchId] = event.target.value;
                //console.log(this.secondScore);
            },
            firstHandleScore(event) {
                this.firstScore[this.matchId] = event.target.value;
                //console.log(this.firstScore);
            }
        },
        props: {
            matchId: {
                required: true,
                type: String
            },
            bets: {
                type: Array,
                default:() => []
            },
            firstScoreList: {
                required: true,
                type: Object,

            },
            secondScoreList: {
                required: true,
                type: Object
            },
        },


    };
</script>
