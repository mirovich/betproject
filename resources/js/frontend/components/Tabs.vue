<template>
    <div class="site-navigation tabs">
        <ul class="navigation-list" :class="{outlined, rounded}">
            <li class="navigation-item" v-for="(tab, name) in tabs" :key="name">
                <span @click="switchTab(Number.parseInt(name))" class="navigation-link"
                      :class="{'active-link': tabFlag === Number.parseInt(name)}">
                        {{tab[0]}}
                </span>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        name: "Tabs",
        props: {
            outlined: {
                type: Boolean,
                default: false
            },
            rounded: {
                type: Boolean,
                default: true
            },
            tabs: {
                type: Object,
                required: false,
                default: {}
            },
            tabFlag: {
                type: Number,
                required: false,
                default: false
            }
        },
        methods: {
            switchTab(tab) {
                this.$emit("switchTab", tab);
            }
        }
    };
</script>

<style lang="scss" scoped>
    .tabs {
        margin-bottom: 20px;
    }

    .rounded {
        border-radius: 4px
    }

    .rounded li {
        border-radius: 4px
    }

    .site-navigation.outlined {
        background-color: transparent
    }

    .site-navigation.outlined span {
        color: #000;
        opacity: 0.4
    }

    .site-navigation.outlined .active-link {
        opacity: 1
    }

    .site-navigation {
        width: 100%
    }

    .navigation-list {
        background-color: #5463C9;
        z-index: 0;
        margin: 0;
        padding: 0;
        height: 100%;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        align-self: center;
        list-style: none
    }

    .navigation-item {
        flex: auto;
        cursor: pointer
    }

    .navigation-link {
        text-align: center;
        margin: 0 0 2px 0;
        padding: 15px 15px 10px;
        display: block;
        color: rgba(255, 255, 255, 0.5);
        font-size: 16px;
        font-weight: 300;
        text-decoration: none;
        text-transform: uppercase;
        box-sizing: border-box
    }

    @media screen and (max-width: 414px) {
        .navigation-link {
            font-size: 14px;
            margin: 0 0 2px 0;
            width: 100%;
            text-align: center
        }
    }

    .navigation-link:hover, .active-link {
        position: relative;
        color: #fff
    }

    .navigation-link:hover:before, .active-link:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 4px;
        border-radius: 4px;
        bottom: -2px;
        left: 0;
        background-color: #50d2c2
    }
</style>
