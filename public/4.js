(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[4],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/BaseButton.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/frontend/components/BaseButton.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "BaseButton",
  render: function render(h) {
    return h('a', {
      "class": {
        'button_1yvW-': true,
        'button_w100_1u9YG': this.w100,
        'button_big_2E3bj': this.big,
        'button_danger_MQ1Nv': this.danger,
        'button_disabled_24ii9': this.disabled,
        'button_primary_1xn_Z': this.primary,
        'button_close_3WhzG': this.buttonclose,
        'button_inprogress_19TV8': this.buttoninprogress,
        'button_notStarted_1FaBX': this.buttonNotStarted
      },
      on: {
        'click': this.clickHandler
      },
      attrs: {
        'href': '/',
        "disabled": this.disabled,
        'type': 'a'
      }
    }, this.$slots["default"]);
  },
  computed: {
    tag: function tag() {
      if (this.to) {
        return "router-link";
      }

      return "button";
    }
  },
  props: {
    to: {
      required: false
    },
    type: {
      required: false,
      "default": "button"
    },
    w100: Boolean,
    disabled: Boolean,
    big: Boolean,
    danger: Boolean,
    primary: Boolean,
    buttonclose: Boolean,
    buttoninprogress: Boolean,
    buttonNotStarted: Boolean,
    onClick: {
      type: Function,
      required: false
    }
  },
  methods: {
    clickHandler: function clickHandler() {
      if (this.onClick) this.onClick();
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _BaseButton__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../BaseButton */ "./resources/js/frontend/components/BaseButton.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  name: "TableTournaments",
  components: {
    BaseButton: _BaseButton__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  methods: {
    onCancel: function onCancel() {},
    GetCountry: function GetCountry(name) {
      return name.indexOf(" ") != -1 ? name.substring(0, name.indexOf(" ")) : name;
    },
    GetLeag: function GetLeag(name) {
      return name.indexOf(" ") != -1 && name.lastIndexOf("W") != -1 ? name.substring(name.indexOf(" "), name.lastIndexOf("W")) : "";
    },
    getNameTournament: function getNameTournament(country, leag) {
      return this.GetCountry(country) + this.GetLeag(leag);
    },
    GetWeek: function GetWeek(name) {
      return name.lastIndexOf("W") != -1 ? name.substring(name.lastIndexOf("W"), name.length) : "";
    },
    tableButtonName: function tableButtonName(status, user, active) {
      if (!active) {
        return this.choosedLang == "RU" ? "Приостановлен" : "Stopped";
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
          return this.choosedLang == "RU" ? "Регистрация не началась" : "Registration has not begun";
        } else if (status === 1) {
          return this.choosedLang == "RU" ? "Активен " : "Active";
        } else if (status === 2) {
          return this.choosedLang == "RU" ? "Идет " : "Active";
        } else {
          return this.choosedLang == "RU" ? "Завершён" : "Complete";
        }
      }
    },
    isTournamentInProgress: function isTournamentInProgress(status) {
      if (status === "in progress") {
        return true;
      }

      return false;
    },
    isTournamentClose: function isTournamentClose(status) {
      if (status === "done") {
        return true;
      }

      return false;
    },
    convertNumbers: function convertNumbers(number) {
      return number.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, "$1 ");
    },
    formattedDate: function formattedDate(date) {
      var dateOut = moment__WEBPACK_IMPORTED_MODULE_0___default()(date).toDate();
      var weekDay = "Вс,Пн,Вт,Ср,Чт,Пт,Сб,".split(",");
      var weekDayEn = "Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday".split(",");
      var week = this.choosedLang == "RU" ? weekDay[dateOut.getDay()] : weekDayEn[dateOut.getDay()];
      return "".concat(moment__WEBPACK_IMPORTED_MODULE_0___default()(dateOut).format("DD.MM"), " ").concat(week, " ").concat(dateOut.getHours(), ":").concat(dateOut.getMinutes() == "0" ? "00" : dateOut.getMinutes(), " ");
    }
  },
  props: {
    tableData: Array,
    IsMyGames: Boolean
  },
  data: function data() {
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
  beforeRouteEnter: function beforeRouteEnter(to, from, next) {
    window.scrollTop = 0;
    next();
  },
  mounted: function mounted() {
    var that = this;
    var ContainerWidth = $("#tournamentContainer").width();
    this.blockCount = Math.floor(ContainerWidth / (this.oneBlockSize + 40)) > 6 ? 6 : Math.floor(ContainerWidth / (this.oneBlockSize + 40)) < 1 ? 1 : Math.floor(ContainerWidth / (this.oneBlockSize + 40));
    $(window).resize(function () {
      that.blockCount = Math.floor(ContainerWidth / (that.oneBlockSize + 40)) > 6 ? 6 : Math.floor(ContainerWidth / (that.oneBlockSize + 40)) < 1 ? 1 : Math.floor(ContainerWidth / (that.oneBlockSize + 40));
    }); // if (this.userIsAuthorized) {
    //     this.dispatch("getMyGames");
    // }
  },
  computed: {
    myGames: function myGames() {//return this.getters.myGames;
      //return this.tableData;
      //return [];
    },
    tournaments: function tournaments() {
      return this.tableData; // return this.tableData.map(item => {
      //     let found = this.$store.getters.myGames
      //         .map(function (el) {
      //             return el.id;
      //         })
      //         .indexOf(item.id);
      //     found >= 0 ? (item.isParticipant = true) : (item.isParticipant = false);
      //     return item;
      // });
    },
    userIsAuthorized: function userIsAuthorized() {
      return true;
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/frontend/components/BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.button_1yvW-[data-v-fe589746] {\n    box-sizing: border-box;\n    display: flex;\n    align-items: center;\n    justify-content: center;\n    font-family: \\\"Noto Sans\\\";\n    font-weight: bold;\n    font-size: 14px;\n    line-height: 24px;\n    background: #50d2c2;\n    text-transform: uppercase;\n    color: #fff;\n    border-radius: 4px;\n    border: none;\n    cursor: pointer;\n    transition: 0.3s ease;\n    padding: 10px 30px;\n    text-decoration: none;\n    text-align: center\n}\n.button_1yvW-[data-v-fe589746]:focus {\n    outline: 0\n}\n.button_1yvW-[data-v-fe589746]:hover {\n    background: #31bead\n}\n@media screen and (min-width: 1024px) {\n.button_1yvW-[data-v-fe589746] {\n        font-size: 18px\n}\n}\n.button_w100_1u9YG[data-v-fe589746] {\n    width: 100%\n}\n.button_big_2E3bj[data-v-fe589746] {\n    padding: 15px 20px;\n    text-transform: uppercase\n}\n.button_disabled_24ii9[data-v-fe589746] {\n    background-color: #BFBCBC\n}\n.button_disabled_24ii9[data-v-fe589746]:hover {\n    background-color: #BFBCBC\n}\n.button_primary_1xn_Z[data-v-fe589746] {\n    background-color: #464375\n}\n.button_primary_1xn_Z[data-v-fe589746]:hover {\n    background-color: #333055\n}\n.button_danger_MQ1Nv[data-v-fe589746] {\n    background-color: #fa5959\n}\n.button_danger_MQ1Nv[data-v-fe589746]:hover {\n    background-color: #f92727\n}\n.button_inprogress_19TV8[data-v-fe589746] {\n    background: darkorange\n}\n.button_inprogress_19TV8[data-v-fe589746]:hover {\n    background-color: orange;\n    color: white;\n    text-decoration: none\n}\n.button_notStarted_1FaBX[data-v-fe589746] {\n    background: #ddd !important;\n    color: #000\n}\n.button_notStarted_1FaBX[data-v-fe589746]:hover {\n    color: #000\n}\n.button_close_3WhzG[data-v-fe589746] {\n    background: indianred\n}\n.button_close_3WhzG[data-v-fe589746]:hover {\n    background-color: #f92727;\n    color: white;\n    text-decoration: none\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var escape = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/url/escape.js */ "./node_modules/css-loader/lib/url/escape.js");
exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.tour-with-garant[data-v-4cea023b] {\n    margin-top: -65px !important\n}\n.tableTournamentsList[data-v-4cea023b] {\n    width: 100%;\n    margin-right: auto;\n    margin-left: auto;\n    justify-content: space-between;\n    margin-top: -15px\n}\n@media screen and (max-width: 768px) {\n.tableTournamentsList[data-v-4cea023b] {\n        justify-content: center\n}\n}\n.ruble_span[data-v-4cea023b] {\n    font-size: 35px;\n    vertical-align: text-top;\n    position: relative;\n    right: 6px;\n    bottom: 12px;\n    font-weight: bold;\n    color: #50d2c2\n}\n.tournamentBodyHeader[data-v-4cea023b] {\n    margin-left: auto !important;\n    margin-right: auto !important;\n    width: 100%;\n    border-bottom: solid 1px #50d2c2\n}\n.tooltips[data-v-4cea023b] {\n    cursor: pointer;\n    font-size: 14px;\n    color: #50d2c2;\n    font-weight: bold\n}\n.customtournamentbutton[data-v-4cea023b] {\n    width: 100% !important;\n    border-radius: 0px;\n    border-bottom-left-radius: 6px;\n    border-bottom-right-radius: 6px\n}\n.customtournamentbutton[data-v-4cea023b]:hover {\n    color: white !important\n}\n.mygamesIcon[data-v-4cea023b] {\n    width: auto;\n    height: auto;\n    max-height: 35px;\n    max-width: 35px\n}\n.sqr[data-v-4cea023b] {\n    font-size: 11px\n}\n.arrowDown[data-v-4cea023b] {\n    transform: rotate(180deg)\n}\np[data-v-4cea023b] {\n    margin-bottom: 5px\n}\n.rouble[data-v-4cea023b] {\n    font-size: 20px;\n    position: relative;\n    right: 5px\n}\n.tableTournaments[data-v-4cea023b] {\n    width: 100%;\n    margin-bottom: 20px\n}\n.tableTournaments .tournament-card[data-v-4cea023b] {\n    height: 325px;\n    background-color: white;\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/tcardbg.png */ "./resources/js/frontend/images/tournamentCards/tcardbg.png")) + ");\n    background-position: center;\n    background-repeat: no-repeat;\n    background-size: cover;\n    border-radius: 10px\n}\n.tableTournaments .tournament-card__icon-leag[data-v-4cea023b] {\n    height: auto;\n    width: auto;\n    max-width: 80px;\n    position: absolute;\n    left: 15px;\n    bottom: 0;\n    top: 0;\n    margin: auto\n}\n.tableTournaments .tournament-card__head[data-v-4cea023b] {\n    display: flex;\n    background-size: 100%;\n    height: 165px\n}\n.tableTournaments .tournament-card__head-first[data-v-4cea023b] {\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/11.png */ "./resources/js/frontend/images/tournamentCards/11.png")) + ");\n    background-position: left top;\n    background-repeat: no-repeat\n}\n.tableTournaments .tournament-card__head-second[data-v-4cea023b] {\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/22.png */ "./resources/js/frontend/images/tournamentCards/22.png")) + ");\n    background-position: left top;\n    background-repeat: no-repeat\n}\n.tableTournaments .tournament-card__head-third[data-v-4cea023b] {\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/33.png */ "./resources/js/frontend/images/tournamentCards/33.png")) + ");\n    background-position: left top;\n    background-repeat: no-repeat\n}\n.tableTournaments .tournament-card__head-fourth[data-v-4cea023b] {\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/4.png */ "./resources/js/frontend/images/tournamentCards/4.png")) + ");\n    background-position: left top;\n    background-repeat: no-repeat\n}\n.tableTournaments .tournament-card__name-info[data-v-4cea023b] {\n    width: 60%\n}\n.tableTournaments .tournament-card__img-icons[data-v-4cea023b] {\n    color: #464375;\n    height: auto;\n    width: auto;\n    max-height: 20px\n}\n.tableTournaments .tournament-card__name-box[data-v-4cea023b] {\n    display: flex;\n    padding: 10px\n}\n.tableTournaments .tournament-card__icon[data-v-4cea023b] {\n    height: auto;\n    width: auto;\n    max-height: 46px\n}\n.tableTournaments .tournament-card__tournament-name[data-v-4cea023b] {\n    padding-left: 5px;\n    font-style: normal;\n    font-weight: bold;\n    font-size: 15px;\n    line-height: 22px;\n    color: white\n}\n.tableTournaments .tournament-card__garant-info[data-v-4cea023b] {\n    width: 199px;\n    position: relative;\n    top: -11px\n}\n.tableTournaments .tournament-card__super-prize-value[data-v-4cea023b] {\n    font-style: normal;\n    font-weight: normal;\n    font-size: 12px;\n    line-height: 16px;\n    color: #464375;\n    padding-left: 10px\n}\n.tableTournaments .tournament-card__super-prize-box-value[data-v-4cea023b] {\n    font-style: normal;\n    font-weight: bold;\n    font-size: 28px;\n    line-height: 68px;\n    letter-spacing: 0.05em;\n    color: #ffffff;\n    padding: 5px;\n    padding-left: 10px\n}\n.tableTournaments .tournament-card__super-prize-box[data-v-4cea023b] {\n    height: 55px;\n    width: 199px\n}\n.tableTournaments .tournament-card__super-prize-box-leag[data-v-4cea023b] {\n    height: 110px;\n    width: 120px;\n    position: relative\n}\n.tableTournaments .tournament-card__super-prize-box-first[data-v-4cea023b] {\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/11_1.png */ "./resources/js/frontend/images/tournamentCards/11_1.png")) + ");\n    background-position: left top;\n    background-repeat: no-repeat\n}\n.tableTournaments .tournament-card__super-prize-box-second[data-v-4cea023b] {\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/man.png */ "./resources/js/frontend/images/tournamentCards/man.png")) + ");\n    background-position: left top;\n    background-repeat: no-repeat;\n    background-position: 30%;\n    background-position-y: 10px;\n    height: 100px\n}\n.tableTournaments .tournament-card__super-prize-box-third[data-v-4cea023b] {\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/man.png */ "./resources/js/frontend/images/tournamentCards/man.png")) + ");\n    background-position: left top;\n    background-repeat: no-repeat\n}\n.tableTournaments .tournament-card__super-prize-box-fourth[data-v-4cea023b] {\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/man.png */ "./resources/js/frontend/images/tournamentCards/man.png")) + ");\n    background-size: 25%;\n    background-repeat: no-repeat;\n    background-position-x: 30%;\n    margin-bottom: 4px\n}\n.tableTournaments .tournament-card__super-prize[data-v-4cea023b] {\n    width: 121px;\n    height: 24px;\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/prize.png */ "./resources/js/frontend/images/tournamentCards/prize.png")) + ");\n    background-position: left top;\n    background-repeat: no-repeat;\n    position: relative;\n    top: 15px\n}\n.tableTournaments .tournament-card__money-info[data-v-4cea023b] {\n    width: 43%\n}\n.tableTournaments .tournament-card__prize[data-v-4cea023b] {\n    text-align: right;\n    padding: 0 20px;\n    margin-top: -48px\n}\n.tableTournaments .tournament-card__prize-value[data-v-4cea023b] {\n    font-style: normal;\n    font-weight: bold;\n    font-size: 36px;\n    line-height: 49px;\n    letter-spacing: 0.05em;\n    color: #464375;\n    margin-bottom: 0px\n}\n.tableTournaments .tournament-card__buyin[data-v-4cea023b] {\n    display: grid;\n    text-align: right;\n    padding: 15px 20px 0 0\n}\n.tableTournaments .tournament-card__title[data-v-4cea023b] {\n    font-style: normal;\n    font-weight: normal;\n    font-size: 12px;\n    line-height: 16px;\n    text-align: right;\n    color: #464375;\n    margin-bottom: 0px\n}\n@media screen and (min-width: 461px) {\n.tableTournaments .tournament-card__title[data-v-4cea023b] {\n        font-size: 14px\n}\n}\n.tableTournaments .tournament-card__buyin-value[data-v-4cea023b] {\n    font-style: normal;\n    font-weight: bold;\n    font-size: 24px;\n    line-height: 33px;\n    letter-spacing: 0.05em;\n    text-transform: uppercase;\n    color: #464375;\n    margin-bottom: 0px\n}\n.tableTournaments .tournament-card__reg-info[data-v-4cea023b] {\n    margin: 28px 0 14px 0;\n    display: flex;\n    padding: 0 20px\n}\n.tableTournaments .tournament-card__count[data-v-4cea023b] {\n    width: 30%\n}\n.tableTournaments .tournament-card__end-date[data-v-4cea023b] {\n    width: 70%\n}\n.tableTournaments .tournament-card__reg-info-box[data-v-4cea023b] {\n    align-items: center;\n    justify-content: flex-end;\n    margin-top: 10px;\n    display: flex\n}\n.tableTournaments .tournament-card__count-value[data-v-4cea023b] {\n    font-style: normal;\n    font-weight: bold;\n    font-size: 24px;\n    line-height: 33px;\n    letter-spacing: 0.05em;\n    text-transform: uppercase;\n    color: #464375;\n    padding-left: 10px\n}\n.tableTournaments .tournament-card__date-value[data-v-4cea023b] {\n    font-style: normal;\n    font-weight: bold;\n    font-size: 16px;\n    line-height: 22px;\n    padding-left: 10px;\n    letter-spacing: 0.05em;\n    color: #464375\n}\n.tableTournaments .tournament-card__footer[data-v-4cea023b] {\n    text-align: center;\n    margin-top: 0px\n}\n.tableTournaments .tournament-card__button[data-v-4cea023b] {\n    width: 100% !important;\n    border-radius: 0px;\n    border-bottom-left-radius: 6px;\n    border-bottom-right-radius: 6px\n}\n.tableTournaments .tournament-card__button[data-v-4cea023b]:hover {\n    color: white !important\n}\n.tableTournaments .tournamentBlock[data-v-4cea023b] {\n    border-radius: 10px;\n    box-shadow: 0 0 43px rgba(0, 0, 0, 0.12);\n    border-radius: 6px;\n    margin-bottom: 0px\n}\n.tableTournaments .tournamentBlock .tournamentHeader[data-v-4cea023b] {\n    border-top-left-radius: 6px;\n    border-top-right-radius: 6px;\n    min-height: 100px;\n    background: #464375\n}\n.tableTournaments .tournamentBlock .tournamentHeader .tournaentCol[data-v-4cea023b] {\n    display: table;\n    margin-top: 5px;\n    padding: 0px;\n    padding-left: 20px;\n    padding-top: 3px\n}\n@media screen and (min-width: 390px) {\n.tableTournaments .tournamentBlock .tournamentHeader .tournaentCol[data-v-4cea023b] {\n        padding-left: 0px\n}\n}\n.tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .tournamentWeek[data-v-4cea023b] {\n    display: table-cell;\n    vertical-align: middle;\n    font-size: 17px;\n    font-weight: bold;\n    color: #fff;\n    padding-top: 27px;\n    position: relative;\n    top: 10px\n}\n@media screen and (min-width: 390px) {\n.tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .tournamentWeek[data-v-4cea023b] {\n        top: 0;\n        font-size: 21px\n}\n}\n.tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .freeTournament[data-v-4cea023b] {\n    color: #50d2c2\n}\n.tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .tournamentName[data-v-4cea023b] {\n    display: table-cell;\n    height: 100px;\n    text-align: left;\n    vertical-align: middle;\n    height: 89px;\n    color: #fff;\n    font-size: 18px;\n    margin-bottom: 0px;\n    margin-top: 10px\n}\n@media screen and (min-width: 390px) {\n.tableTournaments .tournamentBlock .tournamentHeader .tournaentCol .tournamentName[data-v-4cea023b] {\n        font-size: 20px\n}\n}\n.tableTournaments .tournamentBlock .tournamentHeader .tournamentIconCenter[data-v-4cea023b] {\n    margin-bottom: auto;\n    margin-top: 15px\n}\n.tableTournaments .tournamentBlock .tournamentHeader .tournamentIconCenter .tournamentIcon[data-v-4cea023b] {\n    margin-left: 0px;\n    margin-right: 0px;\n    height: auto;\n    width: auto;\n    max-width: 70px;\n    max-height: 70px\n}\n@media screen and (min-width: 461px) {\n.tableTournaments .tournamentBlock .tournamentHeader .tournamentIconCenter .tournamentIcon[data-v-4cea023b] {\n        margin-left: 0px;\n        margin-right: 0px\n}\n}\n.tableTournaments .tournamentBlock .tournamentBody[data-v-4cea023b] {\n    background-image: url(" + escape(__webpack_require__(/*! ../../images/tournamentCards/bgtt2.jpg */ "./resources/js/frontend/images/tournamentCards/bgtt2.jpg")) + ");\n    background-repeat: no-repeat;\n    background-size: cover;\n    background-color: rgba(255, 255, 255, 0.6);\n    background-blend-mode: hard-light;\n    padding: 10px;\n    padding-top: 5px;\n    padding-left: 15px;\n    padding-right: 15px;\n    padding-bottom: 5px\n}\n.tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock[data-v-4cea023b] {\n    height: 30px;\n    display: inline-block\n}\n.tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock .tournamentImage[data-v-4cea023b] {\n    width: 26px;\n    height: 20px\n}\n.tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock .tournamentImageCup[data-v-4cea023b] {\n    width: 19px;\n    height: 21px\n}\n.tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock .tournamentImageClock[data-v-4cea023b] {\n    height: 20px;\n    width: 20px\n}\n@media screen and (min-width: 1440px) {\n.tableTournaments .tournamentBlock .tournamentBody .inline .inlineblock .tournamentImageClock[data-v-4cea023b] {\n        height: 24px;\n        width: 24px\n}\n}\n.tableTournaments .tournamentBlock .tournamentBody .tournamentTextPr[data-v-4cea023b] {\n    margin-bottom: -5px;\n    text-align: right;\n    color: #464375;\n    font-size: 15px;\n    font-weight: bold\n}\n@media screen and (min-width: 1440px) {\n.tableTournaments .tournamentBlock .tournamentBody .tournamentTextPr[data-v-4cea023b] {\n        font-size: 19px;\n        text-align: right\n}\n}\n.tableTournaments .tournamentBlock .tournamentBody .tournamentText[data-v-4cea023b] {\n    margin-bottom: 0px;\n    text-align: left;\n    color: #464375;\n    font-size: 10px\n}\n@media screen and (min-width: 390px) {\n.tableTournaments .tournamentBlock .tournamentBody .tournamentText[data-v-4cea023b] {\n        font-size: 14px\n}\n}\n@media screen and (min-width: 1440px) {\n.tableTournaments .tournamentBlock .tournamentBody .tournamentText[data-v-4cea023b] {\n        font-size: 16px\n}\n}\n.tableTournaments .tournamentBlock .tournamentBody .tournamentBuyIn[data-v-4cea023b] {\n    text-align: left;\n    padding-top: 1px;\n    color: #50d2c2;\n    margin-bottom: 5px;\n    font-size: 20px\n}\n.tableTournaments .tournamentBlock .tournamentBody .tournamentCount[data-v-4cea023b] {\n    text-align: center;\n    color: #464375;\n    font-weight: bold;\n    margin-bottom: 5px;\n    font-size: 20px\n}\n.tableTournaments .tournamentBlock .tournamentBody .tournamentPrize.superPrize[data-v-4cea023b] {\n    color: #fa5959\n}\n.tableTournaments .tournamentBlock .tournamentBody .tournamentPrize[data-v-4cea023b] {\n    margin-bottom: 5px;\n    text-align: right;\n    color: #464375;\n    font-size: 24px;\n    font-weight: bold;\n    padding-top: 1px;\n    line-height: 50px\n}\n@media screen and (min-width: 390px) {\n.tableTournaments .tournamentBlock .tournamentBody .tournamentPrize[data-v-4cea023b] {\n        font-size: 36px\n}\n}\n@media screen and (min-width: 1440px) {\n.tableTournaments .tournamentBlock .tournamentBody .tournamentPrize[data-v-4cea023b] {\n        font-size: 38px;\n        text-align: right\n}\n}\n.tableTournaments .tournamentBlock .tournamentBody .tournamentStart[data-v-4cea023b] {\n    margin-top: auto;\n    margin-bottom: auto;\n    padding-left: 5px;\n    text-align: left;\n    color: #464375;\n    font-size: 13px\n}\n@media screen and (min-width: 1440px) {\n.tableTournaments .tournamentBlock .tournamentBody .tournamentStart[data-v-4cea023b] {\n        font-size: 15px\n}\n}\n.tableTournaments .tournamentBlock .tournamentBody .tournamentEnd[data-v-4cea023b] {\n    margin-top: auto;\n    margin-bottom: auto;\n    padding-left: 5px;\n    text-align: left;\n    font-weight: bold;\n    padding-top: 4px;\n    color: #464375;\n    font-size: 12px\n}\n@media screen and (min-width: 390px) {\n.tableTournaments .tournamentBlock .tournamentBody .tournamentEnd[data-v-4cea023b] {\n        font-size: 16px\n}\n}\n@media screen and (min-width: 1440px) {\n.tableTournaments .tournamentBlock .tournamentBody .tournamentEnd[data-v-4cea023b] {\n        font-size: 18px\n}\n}\n.tableTournaments .tournamentBlock .tournamentFooter[data-v-4cea023b] {\n    text-align: center;\n    margin-top: 0px\n}\n@media screen and (min-width: 390px) {\n.tableTournaments .pdRight[data-v-4cea023b] {\n        padding-right: 15px\n}\n}\n@media screen and (min-width: 390px) {\n.tableTournaments .pdLeft[data-v-4cea023b] {\n        padding-left: 15px\n}\n}\n.tableTournaments .mygamesTable[data-v-4cea023b] {\n    border-spacing: 0px 7px !important;\n    border-collapse: separate;\n    width: 100%\n}\n.tableTournaments .mygamesTable thead tr[data-v-4cea023b] {\n    height: 40px;\n    background: #464375\n}\n.tableTournaments .mygamesTable thead tr th[data-v-4cea023b] {\n    color: #fff;\n    text-align: center;\n    font-size: 14px;\n    font-weight: normal\n}\n.tableTournaments .mygamesTable thead tr th[data-v-4cea023b]:first-child {\n    border-top-left-radius: 6px;\n    border-bottom-left-radius: 6px\n}\n.tableTournaments .mygamesTable thead tr th[data-v-4cea023b]:last-child {\n    border-top-right-radius: 6px;\n    border-bottom-right-radius: 6px\n}\n.tableTournaments .mygamesTable tbody tr td[data-v-4cea023b] {\n    height: 45px;\n    background: #fbfbfb;\n    border-bottom: solid 2px #ddd;\n    text-align: center\n}\n.tableTournaments .mygamesTable tbody tr td[data-v-4cea023b]:first-child {\n    border-top-left-radius: 6px;\n    border-bottom-left-radius: 6px\n}\n.tableTournaments .mygamesTable tbody tr td[data-v-4cea023b]:last-child {\n    padding-right: 5px;\n    border-top-right-radius: 6px;\n    border-bottom-right-radius: 6px\n}\n.tournamentElement[data-v-4cea023b] {\n    margin-top: 20px;\n    max-width: 340px;\n    min-width: 290px;\n    height: 100%;\n    box-shadow: 0 3px 17px rgba(0, 0, 0, 0.15);\n    border-radius: 9px;\n    margin-bottom: 10px;\n    padding-left: 0px !important;\n    padding-right: 0px !important\n}\n@media screen and (max-width: 461px) {\n.tournamentElement[data-v-4cea023b] {\n        max-width: 100%\n}\n}\n.ruble_svg_tour_stroke[data-v-4cea023b] {\n    max-width: 12px;\n}\n.ruble_svg_tour[data-v-4cea023b] {\n    max-width: 16px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/moment/locale sync recursive ^\\.\\/.*$":
/*!**************************************************!*\
  !*** ./node_modules/moment/locale sync ^\.\/.*$ ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var map = {
	"./af": "./node_modules/moment/locale/af.js",
	"./af.js": "./node_modules/moment/locale/af.js",
	"./ar": "./node_modules/moment/locale/ar.js",
	"./ar-dz": "./node_modules/moment/locale/ar-dz.js",
	"./ar-dz.js": "./node_modules/moment/locale/ar-dz.js",
	"./ar-kw": "./node_modules/moment/locale/ar-kw.js",
	"./ar-kw.js": "./node_modules/moment/locale/ar-kw.js",
	"./ar-ly": "./node_modules/moment/locale/ar-ly.js",
	"./ar-ly.js": "./node_modules/moment/locale/ar-ly.js",
	"./ar-ma": "./node_modules/moment/locale/ar-ma.js",
	"./ar-ma.js": "./node_modules/moment/locale/ar-ma.js",
	"./ar-sa": "./node_modules/moment/locale/ar-sa.js",
	"./ar-sa.js": "./node_modules/moment/locale/ar-sa.js",
	"./ar-tn": "./node_modules/moment/locale/ar-tn.js",
	"./ar-tn.js": "./node_modules/moment/locale/ar-tn.js",
	"./ar.js": "./node_modules/moment/locale/ar.js",
	"./az": "./node_modules/moment/locale/az.js",
	"./az.js": "./node_modules/moment/locale/az.js",
	"./be": "./node_modules/moment/locale/be.js",
	"./be.js": "./node_modules/moment/locale/be.js",
	"./bg": "./node_modules/moment/locale/bg.js",
	"./bg.js": "./node_modules/moment/locale/bg.js",
	"./bm": "./node_modules/moment/locale/bm.js",
	"./bm.js": "./node_modules/moment/locale/bm.js",
	"./bn": "./node_modules/moment/locale/bn.js",
	"./bn.js": "./node_modules/moment/locale/bn.js",
	"./bo": "./node_modules/moment/locale/bo.js",
	"./bo.js": "./node_modules/moment/locale/bo.js",
	"./br": "./node_modules/moment/locale/br.js",
	"./br.js": "./node_modules/moment/locale/br.js",
	"./bs": "./node_modules/moment/locale/bs.js",
	"./bs.js": "./node_modules/moment/locale/bs.js",
	"./ca": "./node_modules/moment/locale/ca.js",
	"./ca.js": "./node_modules/moment/locale/ca.js",
	"./cs": "./node_modules/moment/locale/cs.js",
	"./cs.js": "./node_modules/moment/locale/cs.js",
	"./cv": "./node_modules/moment/locale/cv.js",
	"./cv.js": "./node_modules/moment/locale/cv.js",
	"./cy": "./node_modules/moment/locale/cy.js",
	"./cy.js": "./node_modules/moment/locale/cy.js",
	"./da": "./node_modules/moment/locale/da.js",
	"./da.js": "./node_modules/moment/locale/da.js",
	"./de": "./node_modules/moment/locale/de.js",
	"./de-at": "./node_modules/moment/locale/de-at.js",
	"./de-at.js": "./node_modules/moment/locale/de-at.js",
	"./de-ch": "./node_modules/moment/locale/de-ch.js",
	"./de-ch.js": "./node_modules/moment/locale/de-ch.js",
	"./de.js": "./node_modules/moment/locale/de.js",
	"./dv": "./node_modules/moment/locale/dv.js",
	"./dv.js": "./node_modules/moment/locale/dv.js",
	"./el": "./node_modules/moment/locale/el.js",
	"./el.js": "./node_modules/moment/locale/el.js",
	"./en-au": "./node_modules/moment/locale/en-au.js",
	"./en-au.js": "./node_modules/moment/locale/en-au.js",
	"./en-ca": "./node_modules/moment/locale/en-ca.js",
	"./en-ca.js": "./node_modules/moment/locale/en-ca.js",
	"./en-gb": "./node_modules/moment/locale/en-gb.js",
	"./en-gb.js": "./node_modules/moment/locale/en-gb.js",
	"./en-ie": "./node_modules/moment/locale/en-ie.js",
	"./en-ie.js": "./node_modules/moment/locale/en-ie.js",
	"./en-il": "./node_modules/moment/locale/en-il.js",
	"./en-il.js": "./node_modules/moment/locale/en-il.js",
	"./en-in": "./node_modules/moment/locale/en-in.js",
	"./en-in.js": "./node_modules/moment/locale/en-in.js",
	"./en-nz": "./node_modules/moment/locale/en-nz.js",
	"./en-nz.js": "./node_modules/moment/locale/en-nz.js",
	"./en-sg": "./node_modules/moment/locale/en-sg.js",
	"./en-sg.js": "./node_modules/moment/locale/en-sg.js",
	"./eo": "./node_modules/moment/locale/eo.js",
	"./eo.js": "./node_modules/moment/locale/eo.js",
	"./es": "./node_modules/moment/locale/es.js",
	"./es-do": "./node_modules/moment/locale/es-do.js",
	"./es-do.js": "./node_modules/moment/locale/es-do.js",
	"./es-us": "./node_modules/moment/locale/es-us.js",
	"./es-us.js": "./node_modules/moment/locale/es-us.js",
	"./es.js": "./node_modules/moment/locale/es.js",
	"./et": "./node_modules/moment/locale/et.js",
	"./et.js": "./node_modules/moment/locale/et.js",
	"./eu": "./node_modules/moment/locale/eu.js",
	"./eu.js": "./node_modules/moment/locale/eu.js",
	"./fa": "./node_modules/moment/locale/fa.js",
	"./fa.js": "./node_modules/moment/locale/fa.js",
	"./fi": "./node_modules/moment/locale/fi.js",
	"./fi.js": "./node_modules/moment/locale/fi.js",
	"./fil": "./node_modules/moment/locale/fil.js",
	"./fil.js": "./node_modules/moment/locale/fil.js",
	"./fo": "./node_modules/moment/locale/fo.js",
	"./fo.js": "./node_modules/moment/locale/fo.js",
	"./fr": "./node_modules/moment/locale/fr.js",
	"./fr-ca": "./node_modules/moment/locale/fr-ca.js",
	"./fr-ca.js": "./node_modules/moment/locale/fr-ca.js",
	"./fr-ch": "./node_modules/moment/locale/fr-ch.js",
	"./fr-ch.js": "./node_modules/moment/locale/fr-ch.js",
	"./fr.js": "./node_modules/moment/locale/fr.js",
	"./fy": "./node_modules/moment/locale/fy.js",
	"./fy.js": "./node_modules/moment/locale/fy.js",
	"./ga": "./node_modules/moment/locale/ga.js",
	"./ga.js": "./node_modules/moment/locale/ga.js",
	"./gd": "./node_modules/moment/locale/gd.js",
	"./gd.js": "./node_modules/moment/locale/gd.js",
	"./gl": "./node_modules/moment/locale/gl.js",
	"./gl.js": "./node_modules/moment/locale/gl.js",
	"./gom-deva": "./node_modules/moment/locale/gom-deva.js",
	"./gom-deva.js": "./node_modules/moment/locale/gom-deva.js",
	"./gom-latn": "./node_modules/moment/locale/gom-latn.js",
	"./gom-latn.js": "./node_modules/moment/locale/gom-latn.js",
	"./gu": "./node_modules/moment/locale/gu.js",
	"./gu.js": "./node_modules/moment/locale/gu.js",
	"./he": "./node_modules/moment/locale/he.js",
	"./he.js": "./node_modules/moment/locale/he.js",
	"./hi": "./node_modules/moment/locale/hi.js",
	"./hi.js": "./node_modules/moment/locale/hi.js",
	"./hr": "./node_modules/moment/locale/hr.js",
	"./hr.js": "./node_modules/moment/locale/hr.js",
	"./hu": "./node_modules/moment/locale/hu.js",
	"./hu.js": "./node_modules/moment/locale/hu.js",
	"./hy-am": "./node_modules/moment/locale/hy-am.js",
	"./hy-am.js": "./node_modules/moment/locale/hy-am.js",
	"./id": "./node_modules/moment/locale/id.js",
	"./id.js": "./node_modules/moment/locale/id.js",
	"./is": "./node_modules/moment/locale/is.js",
	"./is.js": "./node_modules/moment/locale/is.js",
	"./it": "./node_modules/moment/locale/it.js",
	"./it-ch": "./node_modules/moment/locale/it-ch.js",
	"./it-ch.js": "./node_modules/moment/locale/it-ch.js",
	"./it.js": "./node_modules/moment/locale/it.js",
	"./ja": "./node_modules/moment/locale/ja.js",
	"./ja.js": "./node_modules/moment/locale/ja.js",
	"./jv": "./node_modules/moment/locale/jv.js",
	"./jv.js": "./node_modules/moment/locale/jv.js",
	"./ka": "./node_modules/moment/locale/ka.js",
	"./ka.js": "./node_modules/moment/locale/ka.js",
	"./kk": "./node_modules/moment/locale/kk.js",
	"./kk.js": "./node_modules/moment/locale/kk.js",
	"./km": "./node_modules/moment/locale/km.js",
	"./km.js": "./node_modules/moment/locale/km.js",
	"./kn": "./node_modules/moment/locale/kn.js",
	"./kn.js": "./node_modules/moment/locale/kn.js",
	"./ko": "./node_modules/moment/locale/ko.js",
	"./ko.js": "./node_modules/moment/locale/ko.js",
	"./ku": "./node_modules/moment/locale/ku.js",
	"./ku.js": "./node_modules/moment/locale/ku.js",
	"./ky": "./node_modules/moment/locale/ky.js",
	"./ky.js": "./node_modules/moment/locale/ky.js",
	"./lb": "./node_modules/moment/locale/lb.js",
	"./lb.js": "./node_modules/moment/locale/lb.js",
	"./lo": "./node_modules/moment/locale/lo.js",
	"./lo.js": "./node_modules/moment/locale/lo.js",
	"./lt": "./node_modules/moment/locale/lt.js",
	"./lt.js": "./node_modules/moment/locale/lt.js",
	"./lv": "./node_modules/moment/locale/lv.js",
	"./lv.js": "./node_modules/moment/locale/lv.js",
	"./me": "./node_modules/moment/locale/me.js",
	"./me.js": "./node_modules/moment/locale/me.js",
	"./mi": "./node_modules/moment/locale/mi.js",
	"./mi.js": "./node_modules/moment/locale/mi.js",
	"./mk": "./node_modules/moment/locale/mk.js",
	"./mk.js": "./node_modules/moment/locale/mk.js",
	"./ml": "./node_modules/moment/locale/ml.js",
	"./ml.js": "./node_modules/moment/locale/ml.js",
	"./mn": "./node_modules/moment/locale/mn.js",
	"./mn.js": "./node_modules/moment/locale/mn.js",
	"./mr": "./node_modules/moment/locale/mr.js",
	"./mr.js": "./node_modules/moment/locale/mr.js",
	"./ms": "./node_modules/moment/locale/ms.js",
	"./ms-my": "./node_modules/moment/locale/ms-my.js",
	"./ms-my.js": "./node_modules/moment/locale/ms-my.js",
	"./ms.js": "./node_modules/moment/locale/ms.js",
	"./mt": "./node_modules/moment/locale/mt.js",
	"./mt.js": "./node_modules/moment/locale/mt.js",
	"./my": "./node_modules/moment/locale/my.js",
	"./my.js": "./node_modules/moment/locale/my.js",
	"./nb": "./node_modules/moment/locale/nb.js",
	"./nb.js": "./node_modules/moment/locale/nb.js",
	"./ne": "./node_modules/moment/locale/ne.js",
	"./ne.js": "./node_modules/moment/locale/ne.js",
	"./nl": "./node_modules/moment/locale/nl.js",
	"./nl-be": "./node_modules/moment/locale/nl-be.js",
	"./nl-be.js": "./node_modules/moment/locale/nl-be.js",
	"./nl.js": "./node_modules/moment/locale/nl.js",
	"./nn": "./node_modules/moment/locale/nn.js",
	"./nn.js": "./node_modules/moment/locale/nn.js",
	"./oc-lnc": "./node_modules/moment/locale/oc-lnc.js",
	"./oc-lnc.js": "./node_modules/moment/locale/oc-lnc.js",
	"./pa-in": "./node_modules/moment/locale/pa-in.js",
	"./pa-in.js": "./node_modules/moment/locale/pa-in.js",
	"./pl": "./node_modules/moment/locale/pl.js",
	"./pl.js": "./node_modules/moment/locale/pl.js",
	"./pt": "./node_modules/moment/locale/pt.js",
	"./pt-br": "./node_modules/moment/locale/pt-br.js",
	"./pt-br.js": "./node_modules/moment/locale/pt-br.js",
	"./pt.js": "./node_modules/moment/locale/pt.js",
	"./ro": "./node_modules/moment/locale/ro.js",
	"./ro.js": "./node_modules/moment/locale/ro.js",
	"./ru": "./node_modules/moment/locale/ru.js",
	"./ru.js": "./node_modules/moment/locale/ru.js",
	"./sd": "./node_modules/moment/locale/sd.js",
	"./sd.js": "./node_modules/moment/locale/sd.js",
	"./se": "./node_modules/moment/locale/se.js",
	"./se.js": "./node_modules/moment/locale/se.js",
	"./si": "./node_modules/moment/locale/si.js",
	"./si.js": "./node_modules/moment/locale/si.js",
	"./sk": "./node_modules/moment/locale/sk.js",
	"./sk.js": "./node_modules/moment/locale/sk.js",
	"./sl": "./node_modules/moment/locale/sl.js",
	"./sl.js": "./node_modules/moment/locale/sl.js",
	"./sq": "./node_modules/moment/locale/sq.js",
	"./sq.js": "./node_modules/moment/locale/sq.js",
	"./sr": "./node_modules/moment/locale/sr.js",
	"./sr-cyrl": "./node_modules/moment/locale/sr-cyrl.js",
	"./sr-cyrl.js": "./node_modules/moment/locale/sr-cyrl.js",
	"./sr.js": "./node_modules/moment/locale/sr.js",
	"./ss": "./node_modules/moment/locale/ss.js",
	"./ss.js": "./node_modules/moment/locale/ss.js",
	"./sv": "./node_modules/moment/locale/sv.js",
	"./sv.js": "./node_modules/moment/locale/sv.js",
	"./sw": "./node_modules/moment/locale/sw.js",
	"./sw.js": "./node_modules/moment/locale/sw.js",
	"./ta": "./node_modules/moment/locale/ta.js",
	"./ta.js": "./node_modules/moment/locale/ta.js",
	"./te": "./node_modules/moment/locale/te.js",
	"./te.js": "./node_modules/moment/locale/te.js",
	"./tet": "./node_modules/moment/locale/tet.js",
	"./tet.js": "./node_modules/moment/locale/tet.js",
	"./tg": "./node_modules/moment/locale/tg.js",
	"./tg.js": "./node_modules/moment/locale/tg.js",
	"./th": "./node_modules/moment/locale/th.js",
	"./th.js": "./node_modules/moment/locale/th.js",
	"./tk": "./node_modules/moment/locale/tk.js",
	"./tk.js": "./node_modules/moment/locale/tk.js",
	"./tl-ph": "./node_modules/moment/locale/tl-ph.js",
	"./tl-ph.js": "./node_modules/moment/locale/tl-ph.js",
	"./tlh": "./node_modules/moment/locale/tlh.js",
	"./tlh.js": "./node_modules/moment/locale/tlh.js",
	"./tr": "./node_modules/moment/locale/tr.js",
	"./tr.js": "./node_modules/moment/locale/tr.js",
	"./tzl": "./node_modules/moment/locale/tzl.js",
	"./tzl.js": "./node_modules/moment/locale/tzl.js",
	"./tzm": "./node_modules/moment/locale/tzm.js",
	"./tzm-latn": "./node_modules/moment/locale/tzm-latn.js",
	"./tzm-latn.js": "./node_modules/moment/locale/tzm-latn.js",
	"./tzm.js": "./node_modules/moment/locale/tzm.js",
	"./ug-cn": "./node_modules/moment/locale/ug-cn.js",
	"./ug-cn.js": "./node_modules/moment/locale/ug-cn.js",
	"./uk": "./node_modules/moment/locale/uk.js",
	"./uk.js": "./node_modules/moment/locale/uk.js",
	"./ur": "./node_modules/moment/locale/ur.js",
	"./ur.js": "./node_modules/moment/locale/ur.js",
	"./uz": "./node_modules/moment/locale/uz.js",
	"./uz-latn": "./node_modules/moment/locale/uz-latn.js",
	"./uz-latn.js": "./node_modules/moment/locale/uz-latn.js",
	"./uz.js": "./node_modules/moment/locale/uz.js",
	"./vi": "./node_modules/moment/locale/vi.js",
	"./vi.js": "./node_modules/moment/locale/vi.js",
	"./x-pseudo": "./node_modules/moment/locale/x-pseudo.js",
	"./x-pseudo.js": "./node_modules/moment/locale/x-pseudo.js",
	"./yo": "./node_modules/moment/locale/yo.js",
	"./yo.js": "./node_modules/moment/locale/yo.js",
	"./zh-cn": "./node_modules/moment/locale/zh-cn.js",
	"./zh-cn.js": "./node_modules/moment/locale/zh-cn.js",
	"./zh-hk": "./node_modules/moment/locale/zh-hk.js",
	"./zh-hk.js": "./node_modules/moment/locale/zh-hk.js",
	"./zh-mo": "./node_modules/moment/locale/zh-mo.js",
	"./zh-mo.js": "./node_modules/moment/locale/zh-mo.js",
	"./zh-tw": "./node_modules/moment/locale/zh-tw.js",
	"./zh-tw.js": "./node_modules/moment/locale/zh-tw.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./node_modules/moment/locale sync recursive ^\\.\\/.*$";

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/frontend/components/BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--5-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--5-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--5-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--5-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=template&id=4cea023b&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=template&id=4cea023b&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "tableTournaments" },
    [
      _c(
        "b-row",
        { staticClass: "tableTournamentsList" },
        _vm._l(_vm.tournaments, function(tcol) {
          var _obj, _obj$1
          return _c(
            "b-col",
            {
              key: tcol.id,
              staticClass: "tournamentElement",
              attrs: { cols: 12 / _vm.blockCount }
            },
            [
              _c("div", { staticClass: "tournament-card" }, [
                _c(
                  "div",
                  {
                    staticClass: "tournament-card__head",
                    class:
                      ((_obj = {}),
                      (_obj[_vm.first] = tcol.tournamentType == "Main"),
                      (_obj[_vm.second] = tcol.tournamentType == "MainGarant"),
                      (_obj[_vm.third] = tcol.tournamentType == "Default"),
                      (_obj[_vm.fourth] = tcol.tournamentType == "MainFree"),
                      _obj)
                  },
                  [
                    _c("div", { staticClass: "tournament-card__name-info" }, [
                      _c("div", { staticClass: "tournament-card__name-box" }, [
                        tcol.tournamentType == "Main"
                          ? _c("img", {
                              staticClass: "tournament-card__icon",
                              attrs: { src: tcol.icon, alt: "" }
                            })
                          : _vm._e(),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            staticClass: "tournament-card__tournament-name",
                            attrs: { href: tcol.link }
                          },
                          [
                            _vm._v(
                              "\n                                " +
                                _vm._s(tcol.name) +
                                "\n                            "
                            )
                          ]
                        )
                      ]),
                      _vm._v(" "),
                      tcol.tournamentType == "Main"
                        ? _c(
                            "div",
                            { staticClass: "tournament-card__garant-info" },
                            [
                              _c(
                                "div",
                                { staticClass: "tournament-card__super-prize" },
                                [
                                  _c(
                                    "span",
                                    {
                                      staticClass:
                                        "tournament-card__super-prize-value"
                                    },
                                    [_vm._v("супер приз")]
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "div",
                                {
                                  staticClass:
                                    "tournament-card__super-prize-box",
                                  class:
                                    ((_obj$1 = {}),
                                    (_obj$1[_vm.super_first] =
                                      tcol.tournamentType == "Main"),
                                    _obj$1)
                                },
                                [
                                  _c(
                                    "span",
                                    {
                                      staticClass:
                                        "tournament-card__super-prize-box-value"
                                    },
                                    [
                                      _vm._v(
                                        "\n                " +
                                          _vm._s(
                                            _vm.convertNumbers(
                                              tcol.buyin * 1000
                                            )
                                          ) +
                                          "\n                "
                                      ),
                                      _c("i", { staticClass: "rouble" }, [
                                        _vm._v("₽")
                                      ])
                                    ]
                                  )
                                ]
                              )
                            ]
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      tcol.tournamentType != "Main"
                        ? _c(
                            "div",
                            { staticClass: "tournament-card__garant-info" },
                            [
                              _c(
                                "div",
                                {
                                  staticClass:
                                    "tournament-card__super-prize-box-leag"
                                },
                                [
                                  tcol.tournamentType != "Main"
                                    ? _c("img", {
                                        staticClass:
                                          "tournament-card__icon-leag",
                                        attrs: { src: tcol.icon, alt: "" }
                                      })
                                    : _vm._e()
                                ]
                              )
                            ]
                          )
                        : _vm._e()
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "tournament-card__money-info" }, [
                      _c("div", { staticClass: "rw" }, [
                        _c("div", { staticClass: "tournament-card__buyin" }, [
                          _c("p", { staticClass: "tournament-card__title" }, [
                            _vm._v(
                              "\n                                    вступительный\n                                    "
                            ),
                            _c("br"),
                            _vm._v("взнос\n                                ")
                          ]),
                          _vm._v(" "),
                          _c(
                            "p",
                            { staticClass: "tournament-card__buyin-value" },
                            [
                              _vm._v(
                                "\n                                    " +
                                  _vm._s(
                                    tcol.buyin == 0
                                      ? "FREE"
                                      : _vm.convertNumbers(tcol.buyin)
                                  ) +
                                  "\n                                    "
                              ),
                              tcol.buyin != 0
                                ? _c("i", { staticClass: "rouble" }, [
                                    _vm._v("₽")
                                  ])
                                : _vm._e()
                            ]
                          )
                        ])
                      ])
                    ])
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "tournament-card__body" }, [
                  _c(
                    "div",
                    {
                      staticClass: "tournament-card__prize",
                      class: {
                        "tour-with-garant": tcol.tournamentType == "MainGarant"
                      }
                    },
                    [
                      tcol.tournamentType == "MainGarant"
                        ? _c("p", { staticClass: "tournament-card__title" }, [
                            _vm._v(
                              "\n                            гарантированный\n                            "
                            ),
                            _c("br"),
                            _vm._v("призовой фонд\n                        ")
                          ])
                        : _c("p", { staticClass: "tournament-card__title" }, [
                            _vm._v("призовой фонд")
                          ]),
                      _vm._v(" "),
                      tcol.tournamentType == "MainFree"
                        ? _c(
                            "p",
                            { staticClass: "tournament-card__prize-value" },
                            [
                              _vm._v(
                                "\n                            " +
                                  _vm._s(
                                    Math.floor(tcol.currRegCount * 0.15) > 65
                                      ? _vm.convertNumbers(
                                          tcol.prizFund +
                                            (Math.floor(
                                              tcol.currRegCount * 0.15
                                            ) -
                                              65) *
                                              100
                                        )
                                      : _vm.convertNumbers(tcol.prizFund)
                                  ) +
                                  "\n                            "
                              ),
                              _c("i", { staticClass: "rouble" }, [_vm._v("₽")])
                            ]
                          )
                        : _c(
                            "p",
                            { staticClass: "tournament-card__prize-value" },
                            [
                              _vm._v(
                                "\n                            " +
                                  _vm._s(
                                    tcol.tournamentType == "MainGarant"
                                      ? tcol.currRegCount * tcol.buyin * 0.8 >
                                        tcol.prizFund
                                        ? _vm.convertNumbers(
                                            tcol.buyin * tcol.currRegCount
                                          )
                                        : _vm.convertNumbers(tcol.prizFund)
                                      : _vm.convertNumbers(tcol.prizFund)
                                  ) +
                                  "\n                            "
                              ),
                              _c("i", { staticClass: "rouble" }, [_vm._v("₽")])
                            ]
                          )
                    ]
                  ),
                  _vm._v(" "),
                  _c("div", { staticClass: "tournament-card__reg-info" }, [
                    _c("div", { staticClass: "tournament-card__count" }, [
                      _c(
                        "p",
                        {
                          staticClass: "tournament-card__title",
                          staticStyle: { "text-align": "left" }
                        },
                        [_vm._v("участники")]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass: "tournament-card__reg-info-box",
                          staticStyle: { "justify-content": "end" }
                        },
                        [
                          _c("img", {
                            staticClass: "tournament-card__img-icons",
                            attrs: {
                              src: __webpack_require__(/*! ../../images/tournamentCards/people.png */ "./resources/js/frontend/images/tournamentCards/people.png"),
                              alt: ""
                            }
                          }),
                          _vm._v(" "),
                          _c(
                            "span",
                            { staticClass: "tournament-card__count-value" },
                            [_vm._v(_vm._s(tcol.currRegCount))]
                          )
                        ]
                      )
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "tournament-card__end-date" }, [
                      _vm.IsMyGames
                        ? _c(
                            "p",
                            {
                              staticClass: "tournament-card__title",
                              staticStyle: { "text-align": "right" }
                            },
                            [
                              _vm._v(
                                "завершение\n                                турнира"
                              )
                            ]
                          )
                        : _c(
                            "p",
                            {
                              staticClass: "tournament-card__title",
                              staticStyle: { "text-align": "right" }
                            },
                            [_vm._v("конец регистрации")]
                          ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass: "tournament-card__reg-info-box",
                          staticStyle: { height: "33px" }
                        },
                        [
                          _c("img", {
                            staticClass: "tournament-card__img-icons",
                            attrs: {
                              src: __webpack_require__(/*! ../../images/tournamentCards/calendar.png */ "./resources/js/frontend/images/tournamentCards/calendar.png"),
                              alt: ""
                            }
                          }),
                          _vm._v(" "),
                          _c(
                            "span",
                            { staticClass: "tournament-card__date-value" },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.IsMyGames
                                    ? _vm.formattedDate(tcol.endDate)
                                    : _vm.formattedDate(tcol.regEndDate)
                                )
                              )
                            ]
                          )
                        ]
                      )
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "tournament-card__footer" },
                  [
                    _c(
                      "BaseButton",
                      {
                        staticClass: "tournament-card__button",
                        attrs: {
                          to: {
                            name: "tournamentDetail",
                            params: { id: tcol.id }
                          },
                          w100: true,
                          wf200: true,
                          buttonNotStarted: tcol.regStatus || !tcol.isActive,
                          buttonclose: _vm.isTournamentClose(
                            tcol.tournamentStatus
                          ),
                          buttoninprogress: _vm.isTournamentInProgress(
                            tcol.tournamentStatus
                          )
                        }
                      },
                      [
                        _vm._v(
                          "\n                        " +
                            _vm._s(
                              tcol.regStatus
                                ? _vm.choosedLang == "RU"
                                  ? "Регистрация не началась"
                                  : "Registration has not begun"
                                : _vm.tableButtonName(
                                    tcol.tournamentStatus,
                                    tcol.isParticipant,
                                    tcol.isActive
                                  )
                            ) +
                            "\n                    "
                        )
                      ]
                    )
                  ],
                  1
                )
              ])
            ]
          )
        }),
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/frontend/components/BaseButton.vue":
/*!*********************************************************!*\
  !*** ./resources/js/frontend/components/BaseButton.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _BaseButton_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BaseButton.vue?vue&type=script&lang=js& */ "./resources/js/frontend/components/BaseButton.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _BaseButton_vue_vue_type_style_index_0_id_fe589746_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css& */ "./resources/js/frontend/components/BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _BaseButton_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  "fe589746",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/frontend/components/BaseButton.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/frontend/components/BaseButton.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/frontend/components/BaseButton.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BaseButton_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./BaseButton.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/BaseButton.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BaseButton_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/frontend/components/BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css&":
/*!******************************************************************************************************************!*\
  !*** ./resources/js/frontend/components/BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css& ***!
  \******************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_BaseButton_vue_vue_type_style_index_0_id_fe589746_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--5-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--5-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/BaseButton.vue?vue&type=style&index=0&id=fe589746&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_BaseButton_vue_vue_type_style_index_0_id_fe589746_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_BaseButton_vue_vue_type_style_index_0_id_fe589746_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_BaseButton_vue_vue_type_style_index_0_id_fe589746_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_BaseButton_vue_vue_type_style_index_0_id_fe589746_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_BaseButton_vue_vue_type_style_index_0_id_fe589746_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/frontend/components/tournaments/TableTournaments.vue":
/*!***************************************************************************!*\
  !*** ./resources/js/frontend/components/tournaments/TableTournaments.vue ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _TableTournaments_vue_vue_type_template_id_4cea023b_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TableTournaments.vue?vue&type=template&id=4cea023b&scoped=true& */ "./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=template&id=4cea023b&scoped=true&");
/* harmony import */ var _TableTournaments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TableTournaments.vue?vue&type=script&lang=js& */ "./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _TableTournaments_vue_vue_type_style_index_0_id_4cea023b_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css& */ "./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _TableTournaments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _TableTournaments_vue_vue_type_template_id_4cea023b_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _TableTournaments_vue_vue_type_template_id_4cea023b_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "4cea023b",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/frontend/components/tournaments/TableTournaments.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TableTournaments.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css&":
/*!************************************************************************************************************************************!*\
  !*** ./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css& ***!
  \************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_style_index_0_id_4cea023b_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader??ref--5-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--5-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=style&index=0&id=4cea023b&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_style_index_0_id_4cea023b_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_style_index_0_id_4cea023b_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_style_index_0_id_4cea023b_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_style_index_0_id_4cea023b_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_style_index_0_id_4cea023b_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=template&id=4cea023b&scoped=true&":
/*!**********************************************************************************************************************!*\
  !*** ./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=template&id=4cea023b&scoped=true& ***!
  \**********************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_template_id_4cea023b_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TableTournaments.vue?vue&type=template&id=4cea023b&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/tournaments/TableTournaments.vue?vue&type=template&id=4cea023b&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_template_id_4cea023b_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TableTournaments_vue_vue_type_template_id_4cea023b_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/11.png":
/*!*************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/11.png ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/11.png?0680ab872ee7c829fe76340a94f8ad40";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/11_1.png":
/*!***************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/11_1.png ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/11_1.png?82ba575796ffacc60536da10e1d307c2";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/22.png":
/*!*************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/22.png ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/22.png?752bfe999764e82baf9adfb589d4cd3f";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/33.png":
/*!*************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/33.png ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/33.png?a43e0d2b685549a2d130e9693ebdacf5";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/4.png":
/*!************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/4.png ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/4.png?71a51ba4af75801ad433fca93c18df95";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/bgtt2.jpg":
/*!****************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/bgtt2.jpg ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/bgtt2.jpg?908d5cc24067efb59acd8ddd4e3ba00c";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/calendar.png":
/*!*******************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/calendar.png ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/calendar.png?ca5c1b5a45581cb75a863b669671e0c1";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/man.png":
/*!**************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/man.png ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/man.png?e495d8212c5099452090b581af135f83";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/people.png":
/*!*****************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/people.png ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/people.png?e00f2a9f67b417998828b9697d872a50";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/prize.png":
/*!****************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/prize.png ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/prize.png?ee6241556d4211de2fba64053da4bb2c";

/***/ }),

/***/ "./resources/js/frontend/images/tournamentCards/tcardbg.png":
/*!******************************************************************!*\
  !*** ./resources/js/frontend/images/tournamentCards/tcardbg.png ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/tcardbg.png?fdd1ae99f7d29b334fcb70caf511e980";

/***/ })

}]);