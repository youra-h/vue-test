<template lang="html">
    <card>
        <card-title>
            Вход
        </card-title>
        <form @submit.prevent>
            <card-content>
                <row-cmp>
                    Пользователь
                    <template v-slot:cmp>
                        <text-field :property="cmp_username" @on-change="(value) => username = value" />
                    </template>
                </row-cmp>

                <row-cmp>
                    Пароль
                    <template v-slot:cmp>
                        <text-field
                            :property="cmp_password"
                            @on-change="(value) => (password = value)"
                        />
                    </template>
                </row-cmp>
                
                <row-cmp height="80px">
                    <template v-slot:cmp>
                        <check-box name="remember-me"> Запомнить меня </check-box>
                    </template>
                </row-cmp>
            </card-content>
            <card-actions>
                <column cols="6" class="footer-text">
                    <router-link
                        :to="{ name: 'reset-request'}"
                        :class="['footer-link']"
                        >
                            Восстановить пароль
                    </router-link>
                </column>
                <column cols="6" class="row-flex jc-flex-end">
                    <button class="mdl-button mdl-js-button mdl-button--primary"
                    type="submit"
                    @click="onSubmit()"
                    :disabled="!enabledSubmit()">
                    Вход
                </button>
            </column>
        </card-actions>
    </form>
</card>
</template>

<script>
import Functions from "@/common/functions.js";
import http from "@/common/http.js";

import Card from "@/components/Card/Card.vue";
import CardTitle from "@/components/Card/CardTitle.vue";
import CardContent from "@/components/Card/CardContent.vue";
import CardActions from "@/components/Card/CardActions.vue";

import TextField from "@/components/TextField.vue";
import CheckBox from "@/components/CheckBox.vue";

import RowCmp from "@/components/RowCmp.vue";
import Column from "@/components/Column.vue";

export default {
    metaInfo() {
        return {
            title: "Вход",
        };
    },
    data() {
        return {
            cmp_username: {
                label: "Пользователь",
                placeHolder: "Введите email",
                name: "username",
                inputType: "text",
                autocomplete: true,
            },
            cmp_password: {
                label: "Пароль",
                placeHolder: "Введите пароль",
                name: "password",
                inputType: "password",
                message: {
                    info: "Пароль должен содержать более 5 символов",
                },
                btns: {
                    pass: true,
                },
            },
            username: "",
            password: "",
        };
    },
    components: {
        Card,
        CardTitle,
        CardContent,
        CardActions,
        TextField,
        CheckBox,
        RowCmp,
        Column,
    },
    methods: {
        enabledSubmit() {
            return (
                Functions.validateEmail(this.username) &&
                this.password.length > 5
            );
        },
        onSubmit() {
            if (this.password.length < 6) {
                this.$notify({
                    type: "error",
                    group: "foo",
                    text: "Пароль короче 6 символов",
                });
                return;
            }

            const data = http
                .instance()
                .post("user/login", {
                    username: this.username,
                    password: this.password,
                });

            data.then((response) => {
                if (response.type === "success") {
                    this.$router.push('/')
                    // бизнес логика
                }

                this.$notify({
                    group: "foo",
                    type: response.type,
                    text: response.message
                });
            });
        },
    },
};
</script>
