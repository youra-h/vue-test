<template>
    <div id="app">
        <vue-progress-bar></vue-progress-bar>
        <!-- Компонент GuestLayout or MainLayout, передаются в DefaultLayout -->
        <default-layout>
            <component :is="layout">
                <!-- В слот передается html по роутеру например окошко Login -->
                <router-view />
            </component>
        </default-layout>
    </div>
</template>

<script>

import DefaultLayout from "@/views/layouts/DefaultLayout"
import GuestLayout from "@/views/layouts/GuestLayout"
import MainLayout from "@/views/layouts/MainLayout"

export default {
    metaInfo: {
      title: 'Dispute',
      meta: [
        { vmid: 'description', property: 'description', content: 'Dispute' },
      ],
      htmlAttrs: {
        lang: 'ru'
      }
    },
    computed: {
        layout() {
            if (this.$route.meta.layout)
                return (this.$route.meta.layout || 'main') + '-layout';
            else
                return false;
        },
        isLoggedIn() {
            return this.$store.getters.isLoggedIn
        }
    },
    methods: {
        logout: function () {
            this.$store.dispatch('logout')
                .then(() => {
                    this.$router.push('/login')
                })
        }
    },
    components: {
        DefaultLayout,
        GuestLayout,
        MainLayout
    }
}
</script>
