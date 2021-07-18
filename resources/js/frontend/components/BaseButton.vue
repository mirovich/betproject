<script>
    export default {
        name: "BaseButton",
        render(h) {
            return h('a', {
                class: {
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
                    'click': this.clickHandler,
                },
                attrs: {
                    'href': '/',
                    "disabled": this.disabled,
                    'type': 'a'
                }
            }, this.$slots.default);
        },
        computed: {
            tag() {
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
                default: "button"
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
            clickHandler() {
                if (this.onClick) this.onClick();
            }
        }
    };

</script>

<style scoped>
    .button_1yvW- {
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: \"Noto Sans\";
        font-weight: bold;
        font-size: 14px;
        line-height: 24px;
        background: #50d2c2;
        text-transform: uppercase;
        color: #fff;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        transition: 0.3s ease;
        padding: 10px 30px;
        text-decoration: none;
        text-align: center
    }

    .button_1yvW-:focus {
        outline: 0
    }

    .button_1yvW-:hover {
        background: #31bead
    }

    @media screen and (min-width: 1024px) {
        .button_1yvW- {
            font-size: 18px
        }
    }

    .button_w100_1u9YG {
        width: 100%
    }

    .button_big_2E3bj {
        padding: 15px 20px;
        text-transform: uppercase
    }

    .button_disabled_24ii9 {
        background-color: #BFBCBC
    }

    .button_disabled_24ii9:hover {
        background-color: #BFBCBC
    }

    .button_primary_1xn_Z {
        background-color: #464375
    }

    .button_primary_1xn_Z:hover {
        background-color: #333055
    }

    .button_danger_MQ1Nv {
        background-color: #fa5959
    }

    .button_danger_MQ1Nv:hover {
        background-color: #f92727
    }

    .button_inprogress_19TV8 {
        background: darkorange
    }

    .button_inprogress_19TV8:hover {
        background-color: orange;
        color: white;
        text-decoration: none
    }

    .button_notStarted_1FaBX {
        background: #ddd !important;
        color: #000
    }

    .button_notStarted_1FaBX:hover {
        color: #000
    }

    .button_close_3WhzG {
        background: indianred
    }

    .button_close_3WhzG:hover {
        background-color: #f92727;
        color: white;
        text-decoration: none
    }
</style>
