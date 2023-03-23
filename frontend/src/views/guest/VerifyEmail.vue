<template lang="html">
    <card>
        <div class="message">
            {{ message }}
        </div>
    </card>
</template>

<script>
import Card from "@/components/Card/Card.vue";
import CardContent from "@/components/Card/CardContent.vue";

import http from "@/common/http.js";

export default {
    metaInfo() {
        return {
            title: "Email подтвержден",
        };
    },
    data() {
        return {
            message: ''
        }
    },
    created() {
        // 
        const data = http
                .instance()
                .post("user/verifyemail", {
                    token: this.$route.query.token
                });

            data.then((response) => {
                this.message = response.message;
            });

    },  
    components: {
        Card,
        CardContent
    },
};
</script>

<style>
.message {
    padding: 20px;
}
</style>

<!-- http://localhost:8080/verify-email?token=332093fcbf4f8401850dc35290ec03f2 -->