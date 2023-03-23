<template lang="html">
    <header class="layout__header">
        <div class="layout__header-row">


            <router-link :to="{ name: 'main' }" class="layout-title">
                Login
            </router-link>

            <!-- <div class="div-box" style="background: red">
                1
            </div>
            <div class="div-box" style="background: green">
                2
            </div>
            <div class="div-box" style="background: blue">
                3
            </div> -->
            <div class="layout-spacer"></div>
            <!-- <button type="button" name="button" @click="setCookie()">Куки сет</button>
            <button type="button" name="button" @click="getCookie()">Куки гет</button> -->
            <nav class="navigation">
                <!-- <menu-language></menu-language> -->
                <div class="nav-spacer"></div>
                <router-link
                    :to="{ name: 'login'}"
                    :class="['cmp cmp-gray btn button-login']"
                    tag="button">
                        Вход
                </router-link>
                <div class="nav-spacer"></div>
                <router-link
                    :to="{ name: 'signup'}"
                    :class="['navigation__link ttu button-register']">
                    Регистрация
                </router-link>
            </nav>
        </div>
    </header>
</template>

<script>

// import MenuLanguage from "@/components/MenuLanguage.vue";

export default {
    components: {
        // MenuLanguage
    },
    methods: {
        // setCookie() {
        //     this.$cookie.set('test', 'Hello world!', 1);
        // },
        // getCookie() {
        //     console.log(this.$cookie.get('test'));
        // }
    }
}

</script>

<style type="css">
.layout__header {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;

    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;

    -webkit-flex-wrap: nowrap;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;

    -webkit-justify-content: flex-start;
    -ms-flex-pack: start;
    justify-content: flex-start;

    -webkit-flex-shrink: 0;
    -ms-flex-negative: 0;
    flex-shrink: 0;

    box-sizing: border-box;
    width: 100%;
    padding: 16px 30px;
    border: none;

    background-color: var(--color-bg-card);
    color: var(--color-text-light--1);
    font-family: var(--font-family-alt);
    font-size: 0.92em;
    font-weight: 400;
    letter-spacing: .04em;
    box-shadow: 0 1px 15px rgba(0,0,0,.04), 0 1px 6px rgba(0,0,0,.04);
}

.layout__header-row {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;

    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;

    -webkit-flex-wrap: nowrap;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;

    -webkit-align-items: center;
        -ms-flex-align: center;
            align-items: center;

    width: 100%;
    box-sizing: border-box;
    height: 40px;
}

.layout__header-row>* {
    -webkit-flex-shrink: 0;
    -ms-flex-negative: 0;
    flex-shrink: 0;
}

/*HEADER COMPONENTS*/

.layout-title {
    color: var(--color-text-link);
    font-size: 1.6em;
    text-transform: uppercase;
    font-weight: inherit;
    padding-right: 30px;
}

.layout-title span {
    text-transform: lowercase;
    font-size: 0.5em;
    color: var(--color-text-light--2);
}

.layout-spacer {
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
}

.layout__header-row .navigation {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-wrap: nowrap;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    box-sizing: border-box;

    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;

    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;

    /* height: 100%; */
}


.layout__header-row .navigation__link {
    margin: 0;
    font-family: inherit;
    font-weight: inherit;
    color: var(--color-text-light--2);
}

.layout__header-row .navigation__link:hover {
    color: var(--color-text-light--1);
}

.nav-spacer {
    width: 0.7em;
}

/* BUTTONS */

.button-login {
    font-family: inherit;
    font-size: inherit;
    height: 2.25em;        
}

.button-register {
    font-size: 0.9em;
}

</style>
