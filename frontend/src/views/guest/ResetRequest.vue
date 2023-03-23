<template lang="html">
    <card>
        <card-title>
            Восстановление пароля
        </card-title>
        <form @submit.prevent>
            <card-content>
                <row-cmp>
                    Email
                    <template v-slot:cmp>
                        <text-field :property="cmp_username" @on-change="(value) => username = value" />
                    </template>
                </row-cmp>
            </card-content>
            <card-actions>                
                <column cols="12" class="row-flex jc-flex-end">
                    <button class="mdl-button mdl-js-button mdl-button--primary"
                    type="submit"
                    @click="onSubmit()"
                    :disabled="!enabledSubmit()">
                    Отправить
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
            title: "Восстановление пароля",
        };
    },
    data() {
        return {
            cmp_username: {
                label: "Email",
                placeHolder: "Введите email для восстановления пароля",
                name: "username",
                inputType: "text",
                autocomplete: false,
            },
            username: "",
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
            return Functions.validateEmail(this.username);
        },
        onSubmit() {
            
            const data = http
                .instance()
                .post("user/resetpasswordrequest", {
                    username: this.username,
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

                console.log(response.data);
            });
        },
    },    
};
</script>
