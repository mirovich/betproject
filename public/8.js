(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);


function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

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

/* harmony default export */ __webpack_exports__["default"] = (_defineProperty({
  name: "TournamentDetailPage",
  components: {
    'Tabs': function Tabs() {
      return __webpack_require__.e(/*! import() */ 1).then(__webpack_require__.bind(null, /*! ../components/Tabs */ "./resources/js/frontend/components/Tabs.vue"));
    },
    'GamesInTournament': function GamesInTournament() {
      return __webpack_require__.e(/*! import() */ 5).then(__webpack_require__.bind(null, /*! ../components/tournaments/GamesInTournament */ "./resources/js/frontend/components/tournaments/GamesInTournament.vue"));
    }
  },
  methods: {
    switchTab: function switchTab(tab) {
      this.tabStatus = tab;
      console.log(this.tabStatus);

      if (this.tabStatus === 1) {
        return this.matches;
        return this.endDate;
      } else {
        return 'qq';
      }
    }
  },
  data: function data() {
    return {
      tournament: [],
      tabFlag: 1,
      tabStatus: 1,
      tabs: {
        1: ["Матчи", "Matches"],
        2: ["Участники", "Participants"]
      }
    };
  },
  computed: {
    thisDate: function thisDate() {
      return this.$moment(new Date()).toDate();
    },
    // userId() {
    //     return this.tournament.userId;
    // },
    tournamentId: function tournamentId() {
      return this.id;
    },
    usersTournamentBet: function usersTournamentBet() {
      return this.tournament.userTournamentBets;
    },
    name: function name() {
      return this.tournament.tournamentName;
    },
    description: function description() {
      return this.tournament.description;
    },
    startDate: function startDate() {
      return this.tournament.startDate;
    },
    endDate: function endDate() {
      return this.tournament.endDate;
    },
    matches: function matches() {
      return this.tournament.events;
    },
    eventBets: function eventBets() {
      return this.tournament.eventBets;
    },
    distribution: function distribution() {
      return this.tournament.distribution;
    },
    betTypes: function betTypes() {
      return this.tournament.betTypes;
    },
    betTypeOutcomes: function betTypeOutcomes() {
      return this.tournament.betTypeOutcomes;
    },
    buyin: function buyin() {
      return this.tournament.buyin;
    }
  },
  mounted: function mounted() {},
  props: {
    id: Number
  }
}, "mounted", function mounted() {
  var _this = this;

  return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return axios__WEBPACK_IMPORTED_MODULE_1___default.a.get('/GetTournamentInfo/' + _this.id).then(function (result) {
              _this.tournament = result.data.data;
            });

          case 2:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }))();
}));

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=template&id=3cb5eac3&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=template&id=3cb5eac3&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************************/
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
    [
      _c(
        "b-row",
        [
          _c("b-col", { attrs: { cols: "12" } }, [
            _c("div", { staticClass: "tournament-detail-head" }, [
              _c("div", { staticClass: "tournament-id" }, [
                _c("span", { staticClass: "tournament-id-text" }, [
                  _vm._v("ID: " + _vm._s(_vm.id))
                ])
              ]),
              _vm._v(" "),
              _c("section", { staticClass: "container-head" }, [
                _c("div", { staticClass: "container-item" }, [
                  _c("div", { staticClass: "tournament-logo" }, [
                    _c("img", {
                      staticClass: "tournament-logo-img",
                      attrs: {
                        src: _vm.tournament.icon,
                        alt: "Логотип турнира"
                      }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "tournament-header-block" }, [
                    _c("span", { staticClass: "tournament-header" }, [
                      _vm._v(_vm._s(_vm.name))
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "tournamet-info-header" }, [
                      _c("span", { staticClass: "tournament-date" }, [
                        _vm._v(
                          _vm._s(_vm.startDate) + " - " + _vm._s(_vm.endDate)
                        )
                      ]),
                      _vm._v(" "),
                      _c("span", { staticClass: "tournament-detail-info" }, [
                        _c(
                          "i",
                          {
                            staticClass:
                              "material-icons tournament-detail-info__icon"
                          },
                          [_vm._v("people2")]
                        )
                      ])
                    ])
                  ])
                ])
              ])
            ])
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c("Tabs", {
        attrs: { tabs: _vm.tabs, "tab-flag": _vm.tabStatus },
        on: { switchTab: _vm.switchTab }
      }),
      _vm._v(" "),
      _c("GamesInTournament", {
        attrs: {
          matches: _vm.matches,
          tournamentId: _vm.tournamentId,
          userid: this.$userId,
          price: _vm.tournament.buyin
        }
      }),
      _vm._v(" "),
      _c("br"),
      _vm._v(" "),
      _c("div")
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/frontend/components/TournamentDetailPage.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/frontend/components/TournamentDetailPage.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _TournamentDetailPage_vue_vue_type_template_id_3cb5eac3_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TournamentDetailPage.vue?vue&type=template&id=3cb5eac3&scoped=true& */ "./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=template&id=3cb5eac3&scoped=true&");
/* harmony import */ var _TournamentDetailPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TournamentDetailPage.vue?vue&type=script&lang=js& */ "./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _TournamentDetailPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _TournamentDetailPage_vue_vue_type_template_id_3cb5eac3_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _TournamentDetailPage_vue_vue_type_template_id_3cb5eac3_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "3cb5eac3",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/frontend/components/TournamentDetailPage.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TournamentDetailPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./TournamentDetailPage.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TournamentDetailPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=template&id=3cb5eac3&scoped=true&":
/*!**************************************************************************************************************!*\
  !*** ./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=template&id=3cb5eac3&scoped=true& ***!
  \**************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TournamentDetailPage_vue_vue_type_template_id_3cb5eac3_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./TournamentDetailPage.vue?vue&type=template&id=3cb5eac3&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/frontend/components/TournamentDetailPage.vue?vue&type=template&id=3cb5eac3&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TournamentDetailPage_vue_vue_type_template_id_3cb5eac3_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TournamentDetailPage_vue_vue_type_template_id_3cb5eac3_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);