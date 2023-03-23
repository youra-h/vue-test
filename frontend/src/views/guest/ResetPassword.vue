<template lang="html">
    <card>
        <card-title>
            Новый пароль
        </card-title>
        <form @submit.prevent>
            <card-content>
                <row-cmp>
                    Пароль
                    <template v-slot:cmp>
                        <text-field
                            :property="cmp_password"
                            @on-change="(value) => (password = value)"
                        />
                    </template>
                </row-cmp> 

                <row-cmp>
                    Повторите пароль
                    <template v-slot:cmp>
                        <text-field
                            :property="cmp_repeat_password"
                            @on-change="(value) => (repeat_password = value)"
                        />
                    </template>
                </row-cmp> 
            </card-content>
            <card-actions>                
                <column cols="12" class="row-flex jc-flex-end">
                    <button class="mdl-button mdl-js-button mdl-button--primary"
                    type="submit"
                    @click="onSubmit()"
                    :disabled="!enabledSubmit()">
                    Восстановить
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
            title: "Новый пароль",
        };
    },
    data() {
        return {
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

            cmp_repeat_password: {
                label: "Повторите пароль",
                placeHolder: "Повторите пароль",
                name: "repeat_password",
                inputType: "password",
                btns: {
                    pass: true,
                },
            },

            password: "",
            repeat_password: "",
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
                this.password.length > 5 &&
                this.password === this.repeat_password
            );
        },
        onSubmit() {
            if (this.password !== this.repeat_password) {
                this.$notify({
                    type: "error",
                    group: "foo",
                    text: "Пароли не совпадают",
                });
                return;
            }
            
            const data = http
                .instance()
                .post("user/resetpassword", {
                    password: this.password,
                    repeat_password: this.repeat_password,
                    token: this.$route.query.token
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
