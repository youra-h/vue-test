import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

//Прогрессбар
import VueProgressBar from 'vue-progressbar'
//Управление мета тегами
import VueMeta from 'vue-meta'
//ПОдключение кук
import VueCookie from 'vue-cookie'
// Snackbar
import Notifications from 'vue-notification'

//Подключение Material Design Lite
import VueMaterialDL from 'material-design-lite'
import 'material-design-lite/material.min.css';
//Набор для css разметки
import './assets/mark-kit.css';
//Default css
import "./assets/default/index.css";

// Vue.use(VueAxios, axios)
Vue.use(VueMaterialDL)
//Установка и настройка прогрессбара
Vue.use(VueProgressBar, {
    color: 'var(--color-bg-component)',
    failedColor: 'var(--color-text-error)',
    thickness: '3px'
})

Vue.use(VueMeta, {
    // optional pluginOptions
    refreshOnceOnNavigation: true
})

Vue.use(VueCookie);

Vue.use(Notifications)

Vue.config.productionTip = true

new Vue({
    router,
    store,
    mounted() {
        this.$Progress.finish()
    },
    created() {

        //Запуск прогресбара
        this.$router.beforeEach((to, from, next) => {
            //  Если есть мета для route
            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress
                this.$Progress.parseMeta(meta)
            }
            //Запуск прогресбара
            this.$Progress.start()
            //Следующая страница
            next()
        })

        this.$router.afterEach((to, from) => {
            //Остановка прогресбара
            this.$Progress.finish()
        })

        const token = localStorage.getItem('token');
        console.log(token);
        if (token) {
            // this.$http.defaults.headers.common['Authorization'] = token
        }
    },
    render: h => h(App)
}).$mount('#app');