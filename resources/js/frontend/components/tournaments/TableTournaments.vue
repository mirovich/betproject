<template>
    <div class="tableTournaments">
        <b-row class="tableTournamentsList">
            <b-col :cols="12 / blockCount" v-for="tcol in tournaments" :key="tcol.id" class="tournamentElement">
                <div class="tournament-card">
                    <div
                        class="tournament-card__head"
                        :class="{ [first]: tcol.tournamentType == 'Main',
          [second]: tcol.tournamentType == 'MainGarant',
          [third]: tcol.tournamentType == 'Default',
          [fourth]: tcol.tournamentType == 'MainFree'}"
                    >
                        <div class="tournament-card__name-info">
                            <div class="tournament-card__name-box">
                                <img
                                    v-if="tcol.tournamentType == 'Main'"
                                    class="tournament-card__icon"
                                    :src="tcol.icon"
                                    alt
                                />
                                <a :href="tcol.link" class="tournament-card__tournament-name">
                                    {{tcol.name}}
                                </a>
                            </div>
                            <div v-if="tcol.tournamentType == 'Main'" class="tournament-card__garant-info">
                                <div class="tournament-card__super-prize">
                                    <span class="tournament-card__super-prize-value">супер приз</span>
                                </div>
                                <div
                                    class="tournament-card__super-prize-box"
                                    :class="{ [super_first]: tcol.tournamentType == 'Main'}"
                                >
                  <span class="tournament-card__super-prize-box-value">
                    {{ convertNumbers(tcol.buyin * 1000) }}
                    <i class="rouble">₽</i>
                  </span>
                                </div>
                            </div>
                            <div v-if="tcol.tournamentType != 'Main'" class="tournament-card__garant-info">
                                <div class="tournament-card__super-prize-box-leag">
                                    <img
                                        v-if="tcol.tournamentType != 'Main'"
                                        class="tournament-card__icon-leag"
                                        :src="tcol.icon"
                                        alt
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="tournament-card__money-info">
                            <div class="rw">
                                <div class="tournament-card__buyin">
                                    <p class="tournament-card__title">
                                        вступительный
                                        <br/>взнос
                                    </p>
                                    <p class="tournament-card__buyin-value">
                                        {{tcol.buyin == 0 ? "FREE" : convertNumbers(tcol.buyin) }}
                                        <i
                                            v-if="tcol.buyin != 0"
                                            class="rouble"
                                        >₽</i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tournament-card__body">
                        <div
                            class="tournament-card__prize"
                            :class="{'tour-with-garant': tcol.tournamentType == 'MainGarant'}"
                        >
                            <p v-if="tcol.tournamentType == 'MainGarant'" class="tournament-card__title">
                                гарантированный
                                <br/>призовой фонд
                            </p>
                            <p v-else class="tournament-card__title">призовой фонд</p>
                            <p v-if="tcol.tournamentType == 'MainFree'" class="tournament-card__prize-value">
                                {{
                                Math.floor(tcol.currRegCount * 0.15) > 65 ?
                                convertNumbers(tcol.prizFund + (Math.floor(tcol.currRegCount * 0.15) - 65)*100):
                                convertNumbers(tcol.prizFund )
                                }}
                                <i
                                    class="rouble"
                                >₽</i>
                            </p>
                            <p v-else class="tournament-card__prize-value">
                                {{
                                tcol.tournamentType == "MainGarant"
                                ? tcol.currRegCount * tcol.buyin * 0.8 > tcol.prizFund
                                ? convertNumbers(tcol.buyin * tcol.currRegCount)
                                : convertNumbers(tcol.prizFund)
                                : convertNumbers(tcol.prizFund)
                                }}
                                <i
                                    class="rouble"
                                >₽</i>
                            </p>
                        </div>
                        <div class="tournament-card__reg-info">
                            <div class="tournament-card__count">
                                <p class="tournament-card__title" style="text-align:left">участники</p>
                                <div class="tournament-card__reg-info-box" style="justify-content: end;">
                                    <img
                                        class="tournament-card__img-icons"
                                        src="../../images/tournamentCards/people.png"
                                        alt
                                    />
                                    <span class="tournament-card__count-value">{{tcol.currRegCount}}</span>
                                </div>
                            </div>
                            <div class="tournament-card__end-date">
                                <p v-if="IsMyGames" class="tournament-card__title" style="text-align:right">завершение
                                    турнира</p>
                                <p v-else class="tournament-card__title" style="text-align:right">конец регистрации</p>
                                <div class="tournament-card__reg-info-box" style="height: 33px;">
                                    <img
                                        class="tournament-card__img-icons"
                                        src="../../images/tournamentCards/calendar.png"
                                        alt
                                    />
                                    <span
                                        class="tournament-card__date-value"
                                    >{{ IsMyGames ? formattedDate(tcol.endDate) : formattedDate(tcol.regEndDate) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tournament-card__footer">
                        <BaseButton
                            class="tournament-card__button"
                            :to="{ name: 'tournamentDetail', params: { id: tcol.id } }"
                            :w100="true"
                            :wf200="true"
                            :buttonNotStarted="tcol.regStatus || !tcol.isActive"
                            :buttonclose="isTournamentClose(tcol.tournamentStatus)"
                            :buttoninprogress="isTournamentInProgress(tcol.tournamentStatus)"
                        >
                            {{
                            tcol.regStatus
                            ? choosedLang == "RU"
                            ? "Регистрация не началась"
                            : "Registration has not begun"
                            : tableButtonName(tcol.tournamentStatus, tcol.isParticipant, tcol.isActive)
                            }}
                        </BaseButton>
                    </div>
                </div>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import moment from "moment";
    import BaseButton from "../BaseButton";

    export default {
        name: "TableTournaments",
        components: {
            BaseButton
        },
        methods: {
            onCancel() {
            },
            GetCountry(name) {
                return name.indexOf(" ") != -1
                    ? name.substring(0, name.indexOf(" "))
                    : name;
            },
            GetLeag(name) {
                return name.indexOf(" ") != -1 && name.lastIndexOf("W") != -1
                    ? name.substring(name.indexOf(" "), name.lastIndexOf("W"))
                    : "";
            },
            getNameTournament(country, leag) {
                return this.GetCountry(country) + this.GetLeag(leag);
            },
            GetWeek(name) {
                return name.lastIndexOf("W") != -1
                    ? name.substring(name.lastIndexOf("W"), name.length)
                    : "";
            },
            tableButtonName(status, user, active) {
                if (!active) {
                    return this.choosedLang == "RU"
                        ? "Приостановлен"
                        : "Stopped";
                } else {
                    if (status === "ToDo") {
                        if (user || this.IsMyGames) {
                            return this.choosedLang == "RU" ? "Изменить" : "Edit";
                        } else {
                            return this.choosedLang == "RU" ? "Играть" : "Play";
                        }
                    } else if (status === "in progress") {
                        return this.choosedLang == "RU" ? "Идёт" : "Going";
                    } else if (status === "regNotStarted") {
                        return this.choosedLang == "RU"
                            ? "Регистрация не началась"
                            : "Registration has not begun";
                    }else if (status === 1) {
                        return this.choosedLang == "RU"
                            ? "Активен "
                            : "Active";
                    }else if (status === 2) {
                        return this.choosedLang == "RU"
                            ? "Идет "
                            : "Active";
                    } else {
                        return this.choosedLang == "RU"
                            ? "Завершён"
                            : "Complete";
                    }
                }
            },
            isTournamentInProgress(status) {
                if (status === "in progress") {
                    return true;
                }
                return false;
            },
            isTournamentClose(status) {
                if (status === "done") {
                    return true;
                }
                return false;
            },
            convertNumbers(number) {
                return number.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, "$1 ");
            },
            formattedDate(date) {
                let dateOut = moment(date).toDate();
                let weekDay = "Вс,Пн,Вт,Ср,Чт,Пт,Сб,".split(",");
                let weekDayEn = "Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday".split(
                    ","
                );
                let week =
                    this.choosedLang == "RU"
                        ? weekDay[dateOut.getDay()]
                        : weekDayEn[dateOut.getDay()];
                return `${moment(dateOut).format(
                    "DD.MM"
                )} ${week} ${dateOut.getHours()}:${
                    dateOut.getMinutes() == "0" ? "00" : dateOut.getMinutes()
                } `;
            }
        },
        props: {
            tableData: Array,
            IsMyGames: Boolean
        },
        data() {
            return {
                choosedLang: "RU",
                first: "tournament-card__head-first",
                second: "tournament-card__head-second",
                third: "tournament-card__head-third",
                fourth: "tournament-card__head-fourth",
                super_first: "tournament-card__super-prize-box-first",
                super_second: "tournament-card__super-prize-box-second",
                super_third: "tournament-card__super-prize-box-third",
                super_fourth: "tournament-card__super-prize-box-fourth",
                fullPage: true,
                tickCount: 0,
                loader: {},
                secondStageSizeOfBox: 1301,
                thirdStageOfBox: 1024,
                oneBlockSize: 420,
                blockCount: 6,
                secondStageOfBlocks: window.outerWidth <= 1301 ? true : false
            };
        },
        beforeRouteEnter(to, from, next) {
            window.scrollTop = 0;
            next();
        },
        mounted() {
            let that = this;
            let ContainerWidth = $("#tournamentContainer").width();
            this.blockCount =
                Math.floor(ContainerWidth / (this.oneBlockSize + 40)) > 6
                    ? 6
                    : Math.floor(ContainerWidth / (this.oneBlockSize + 40)) < 1
                    ? 1
                    : Math.floor(ContainerWidth / (this.oneBlockSize + 40));
            $(window).resize(function () {
                that.blockCount =
                    Math.floor(ContainerWidth / (that.oneBlockSize + 40)) > 6
                        ? 6
                        : Math.floor(ContainerWidth / (that.oneBlockSize + 40)) < 1
                        ? 1
                        : Math.floor(ContainerWidth / (that.oneBlockSize + 40));
            });

            // if (this.userIsAuthorized) {
            //     this.dispatch("getMyGames");
            // }
        },
        computed: {
            myGames() {
                 //return this.getters.myGames;
                //return this.tableData;
                //return [];
            },
            tournaments() {
                return this.tableData;

                // return this.tableData.map(item => {
                //     let found = this.$store.getters.myGames
                //         .map(function (el) {
                //             return el.id;
                //         })
                //         .indexOf(item.id);
                //     found >= 0 ? (item.isParticipant = true) : (item.isParticipant = false);
                //     return item;
                // });
            },
            userIsAuthorized() {
                return true;
            }
        }
    };
</script>
<style scoped>
    .tour-with-garant {
        margin-top: -65px !important
    }

    .tableTournamentsList {
        width: 100%;
        margin-right: auto;
        margin-left: auto;
        justify-content: space-between;
        margin-top: -15px
    }

    @media screen and (max-width: 768px) {
        .tableTournamentsList {
            justify-content: center
        }
    }

    .ruble_span {
        font-size: 35px;
        vertical-align: text-top;
        position: relative;
        right: 6px;
        bottom: 12px;
        font-weight: bold;
        color: #50d2c2
    }

    .tournamentBodyHeader {
        margin-left: auto !important;
        margin-right: auto !important;
        width: 100%;
        border-bottom: solid 1px #50d2c2
    }

    .tooltips {
        cursor: pointer;
        font-size: 14px;
        color: #50d2c2;
        font-weight: bold
    }

    .customtournamentbutton {
        width: 100% !important;
        border-radius: 0px;
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px
    }

    .customtournamentbutton:hover {
        color: white !important
    }

    .mygamesIcon {
        width: auto;
        height: auto;
        max-height: 35px;
        max-width: 35px
    }

    .sqr {
        font-size: 11px
    }

    .arrowDown {
        transform: rotate(180deg)
    }

    p {
        margin-bottom: 5px
    }

    .rouble {
        font-size: 20px;
        position: relative;
        right: 5px
    }

    .tableTournaments {
        width: 100%;
        margin-bottom: 20px
    }

    .tableTournaments .tournament-card {
        height: 325px;
        background-color: white;
        background-image: url("../../images/tournamentCards/tcardbg.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 10px
    }

    .tableTournaments .tournament-card__icon-leag {
        height: auto;
        width: auto;
        max-width: 80px;
        position: absolute;
        left: 15px;
        bottom: 0;
        top: 0;
        margin: auto
    }

    .tableTournaments .tournament-card__head {
        display: flex;
        background-size: 100%;
        height: 165px
    }

    .tableTournaments .tournament-card__head-first {
        background-image: url("../../images/tournamentCards/11.png");
        background-position: left top;
        background-repeat: no-repeat
    }

    .tableTournaments .tournament-card__head-second {
        background-image: url("../../images/tournamentCards/22.png");
        background-position: left top;
        background-repeat: no-repeat
    }

    .tableTournaments .tournament-card__head-third {
        background-image: url("../../images/tournamentCards/33.png");
        background-position: left top;
        background-repeat: no-repeat
    }

    .tableTournaments .tournament-card__head-fourth {
        background-image: url("../../images/tournamentCards/4.png");
        background-position: left top;
        background-repeat: no-repeat
    }

    .tableTournaments .tournament-card__name-info {
        width: 60%
    }

    .tableTournaments .tournament-card__img-icons {
        color: #464375;
        height: auto;
        width: auto;
        max-height: 20px
    }

    .tableTournaments .tournament-card__name-box {
        display: flex;
        padding: 10px
    }

    .tableTournaments .tournament-card__icon {
        height: auto;
        width: auto;
        max-height: 46px
    }

    .tableTournaments .tournament-card__tournament-name {
        padding-left: 5px;
        font-style: normal;
        font-weight: bold;
        font-size: 15px;
        line-height: 22px;
        color: white
    }

    .tableTournaments .tournament-card__garant-info {
        width: 199px;
        position: relative;
        top: -11px
    }

    .tableTournaments .tournament-card__super-prize-value {
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        line-height: 16px;
        color: #464375;
        padding-left: 10px
    }

    .tableTournaments .tournament-card__super-prize-box-value {
        font-style: normal;
        font-weight: bold;
        font-size: 28px;
        line-height: 68px;
        letter-spacing: 0.05em;
        color: #ffffff;
        padding: 5px;
        padding-left: 10px
    }

    .tableTournaments .tournament-card__super-prize-box {
        height: 55px;
        width: 199px
    }

    .tableTournaments .tournament-card__super-prize-box-leag {
        height: 110px;
        width: 120px;
        position: relative
    }

    .tableTournaments .tournament-card__super-prize-box-first {
        background-image: url("../../images/tournamentCards/11_1.png");
        background-position: left top;
        background-repeat: no-repeat
    }

    .tableTournaments .tournament-card__super-prize-box-second {
        background-image: url("../../images/tournamentCards/man.png");
        background-position: left top;
        background-repeat: no-repeat;
        background-position: 30%;
        background-position-y: 10px;
        height: 100px
    }

    .tableTournaments .tournament-card__super-prize-box-third {
        background-image: url("../../images/tournamentCards/man.png");
        background-position: left top;
        background-repeat: no-repeat
    }

    .tableTournaments .tournament-card__super-prize-box-fourth {
        background-image: url("../../images/tournamentCards/man.png");
        background-size: 25%;
        background-repeat: no-repeat;
        background-position-x: 30%;
        margin-bottom: 4px
    }

    .tableTournaments .tournament-card__super-prize {
        width: 121px;
        height: 24px;
        background-image: url("../../images/tournamentCards/prize.png");
        background-position: left top;
        background-repeat: no-repeat;
        position: relative;
        top: 15px
    }

    .tableTournaments .tournament-card__money-info {
        width: 43%
    }

    .tableTournaments .tournament-card__prize {
        text-align: right;
        padding: 0 20px;
        margin-top: -48px
    }

    .tableTournaments .tournament-card__prize-value {
        font-style: normal;
        font-weight: bold;
        font-size: 36px;
        line-height: 49px;
        letter-spacing: 0.05em;
        color: #464375;
        margin-bottom: 0px
    }

    .tableTournaments .tournament-card__buyin {
        display: grid;
        text-align: right;
        padding: 15px 20px 0 0
    }

    .tableTournaments .tournament-card__title {
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        line-height: 16px;
        text-align: right;
        color: #464375;
        margin-bottom: 0px
    }

    @media screen and (min-width: 461px) {
        .tableTournaments .tournament-card__title {
            font-size: 14px
        }
    }

    .tableTournaments .tournament-card__buyin-value {
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        line-height: 33px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #464375;
        margin-bottom: 0px
    }

    .tableTournaments .tournament-card__reg-info {
        margin: 28px 0 14px 0;
        display: flex;
        padding: 0 20px
    }

    .tableTournaments .tournament-card__count {
        width: 30%
    }

    .tableTournaments .tournament-card__end-date {
        width: 70%
    }

    .tableTournaments .tournament-card__reg-info-box {
        align-items: center;
        justify-content: flex-end;
        margin-top: 10px;
        display: flex
    }

    .tableTournaments .tournament-card__count-value {
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        line-height: 33px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #464375;
        padding-left: 10px
    }

    .tableTournaments .tournament-card__date-value {
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        line-height: 22px;
        padding-left: 10px;
        letter-spacing: 0.05em;
        color: #464375
    }

    .tableTournaments .tournament-card__footer {
        text-align: center;
        margin-top: 0px
    }

    .tableTournaments .tournament-card__button {
        width: 100% !important;
        border-radius: 0px;
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px
    }

    .tableTournaments .tournament-card__button:hover {
        color: white !important
    }

    .tableTournaments .tournamentBlock {
        border-radius: 10px;
        box-shadow: 0 0 43px rgba(0, 0, 0, 0.12);
        border-radius: 6px;
        margin-bottom: 0px
    }

    .tableTournaments .tournamentBlock .tournamentHeader {
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        min-height: 100px;
        background: #464375
    }

    .tableTournaments .tournamentBlock .tournamentHeader .tournaentCol {
        display: table;
        margin-top: 5px;
        padding: 0px;
        padding-left: 20px;
        padding-top: 3px
    }

    @media screen and (min-width: 390px) {
        .tableTournaments .tournamentBlock .tournamentHeader .tournaentCol {
            padding-left: 0px
        }
    }

    .tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .tournamentWeek {
        display: table-cell;
        vertical-align: middle;
        font-size: 17px;
        font-weight: bold;
        color: #fff;
        padding-top: 27px;
        position: relative;
        top: 10px
    }

    @media screen and (min-width: 390px) {
        .tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .tournamentWeek {
            top: 0;
            font-size: 21px
        }
    }

    .tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .freeTournament {
        color: #50d2c2
    }

    .tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .tournamentName {
        display: table-cell;
        height: 100px;
        text-align: left;
        vertical-align: middle;
        height: 89px;
        color: #fff;
        font-size: 18px;
        margin-bottom: 0px;
        margin-top: 10px
    }

    @media screen and (min-width: 390px) {
        .tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .tournamentName {
            font-size: 20px
        }
    }

    .tableTournaments .tournamentBlock .tournamentHeader .tournamentIconCenter {
        margin-bottom: auto;
        margin-top: 15px
    }

    .tableTournaments .tournamentBlock .tournamentHeader .tournamentIconCenter .tournamentIcon {
        margin-left: 0px;
        margin-right: 0px;
        height: auto;
        width: auto;
        max-width: 70px;
        max-height: 70px
    }

    @media screen and (min-width: 461px) {
        .tableTournaments .tournamentBlock .tournamentHeader .tournamentIconCenter .tournamentIcon {
            margin-left: 0px;
            margin-right: 0px
        }
    }

    .tableTournaments .tournamentBlock .tournamentBody {
        background-image: url("../../images/tournamentCards/bgtt2.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-color: rgba(255, 255, 255, 0.6);
        background-blend-mode: hard-light;
        padding: 10px;
        padding-top: 5px;
        padding-left: 15px;
        padding-right: 15px;
        padding-bottom: 5px
    }

    .tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock {
        height: 30px;
        display: inline-block
    }

    .tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock .tournamentImage {
        width: 26px;
        height: 20px
    }

    .tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock .tournamentImageCup {
        width: 19px;
        height: 21px
    }

    .tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock .tournamentImageClock {
        height: 20px;
        width: 20px
    }

    @media screen and (min-width: 1440px) {
        .tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock .tournamentImageClock {
            height: 24px;
            width: 24px
        }
    }

    .tableTournaments .tournamentBlock .tournamentBody .tournamentTextPr {
        margin-bottom: -5px;
        text-align: right;
        color: #464375;
        font-size: 15px;
        font-weight: bold
    }

    @media screen and (min-width: 1440px) {
        .tableTournaments .tournamentBlock .tournamentBody .tournamentTextPr {
            font-size: 19px;
            text-align: right
        }
    }

    .tableTournaments .tournamentBlock .tournamentBody .tournamentText {
        margin-bottom: 0px;
        text-align: left;
        color: #464375;
        font-size: 10px
    }

    @media screen and (min-width: 390px) {
        .tableTournaments .tournamentBlock .tournamentBody .tournamentText {
            font-size: 14px
        }
    }

    @media screen and (min-width: 1440px) {
        .tableTournaments .tournamentBlock .tournamentBody .tournamentText {
            font-size: 16px
        }
    }

    .tableTournaments .tournamentBlock .tournamentBody .tournamentBuyIn {
        text-align: left;
        padding-top: 1px;
        color: #50d2c2;
        margin-bottom: 5px;
        font-size: 20px
    }

    .tableTournaments .tournamentBlock .tournamentBody .tournamentCount {
        text-align: center;
        color: #464375;
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 20px
    }

    .tableTournaments .tournamentBlock .tournamentBody .tournamentPrize.superPrize {
        color: #fa5959
    }

    .tableTournaments .tournamentBlock .tournamentBody .tournamentPrize {
        margin-bottom: 5px;
        text-align: right;
        color: #464375;
        font-size: 24px;
        font-weight: bold;
        padding-top: 1px;
        line-height: 50px
    }

    @media screen and (min-width: 390px) {
        .tableTournaments .tournamentBlock .tournamentBody .tournamentPrize {
            font-size: 36px
        }
    }

    @media screen and (min-width: 1440px) {
        .tableTournaments .tournamentBlock .tournamentBody .tournamentPrize {
            font-size: 38px;
            text-align: right
        }
    }

    .tableTournaments .tournamentBlock .tournamentBody .tournamentStart {
        margin-top: auto;
        margin-bottom: auto;
        padding-left: 5px;
        text-align: left;
        color: #464375;
        font-size: 13px
    }

    @media screen and (min-width: 1440px) {
        .tableTournaments .tournamentBlock .tournamentBody .tournamentStart {
            font-size: 15px
        }
    }

    .tableTournaments .tournamentBlock .tournamentBody .tournamentEnd {
        margin-top: auto;
        margin-bottom: auto;
        padding-left: 5px;
        text-align: left;
        font-weight: bold;
        padding-top: 4px;
        color: #464375;
        font-size: 12px
    }

    @media screen and (min-width: 390px) {
        .tableTournaments .tournamentBlock .tournamentBody .tournamentEnd {
            font-size: 16px
        }
    }

    @media screen and (min-width: 1440px) {
        .tableTournaments .tournamentBlock .tournamentBody .tournamentEnd {
            font-size: 18px
        }
    }

    .tableTournaments .tournamentBlock .tournamentFooter {
        text-align: center;
        margin-top: 0px
    }

    @media screen and (min-width: 390px) {
        .tableTournaments .pdRight {
            padding-right: 15px
        }
    }

    @media screen and (min-width: 390px) {
        .tableTournaments .pdLeft {
            padding-left: 15px
        }
    }

    .tableTournaments .mygamesTable {
        border-spacing: 0px 7px !important;
        border-collapse: separate;
        width: 100%
    }

    .tableTournaments .mygamesTable thead tr {
        height: 40px;
        background: #464375
    }

    .tableTournaments .mygamesTable thead tr th {
        color: #fff;
        text-align: center;
        font-size: 14px;
        font-weight: normal
    }

    .tableTournaments .mygamesTable thead tr th:first-child {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px
    }

    .tableTournaments .mygamesTable thead tr th:last-child {
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px
    }

    .tableTournaments .mygamesTable tbody tr td {
        height: 45px;
        background: #fbfbfb;
        border-bottom: solid 2px #ddd;
        text-align: center
    }

    .tableTournaments .mygamesTable tbody tr td:first-child {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px
    }

    .tableTournaments .mygamesTable tbody tr td:last-child {
        padding-right: 5px;
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px
    }

    .tournamentElement {
        margin-top: 20px;
        max-width: 340px;
        min-width: 290px;
        height: 100%;
        box-shadow: 0 3px 17px rgba(0, 0, 0, 0.15);
        border-radius: 9px;
        margin-bottom: 10px;
        padding-left: 0px !important;
        padding-right: 0px !important
    }

    @media screen and (max-width: 461px) {
        .tournamentElement {
            max-width: 100%
        }
    }

    .ruble_svg_tour_stroke {
        max-width: 12px;
    }

    .ruble_svg_tour {
        max-width: 16px;
    }
</style>
