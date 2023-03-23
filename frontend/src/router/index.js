import Vue from 'vue'
import VueRouter from 'vue-router'
import Main from '@/views/main/Main'

Vue.use(VueRouter)

const routes = [
    {
        path: '/404',
        name: '404',
        meta: { layout: 'guest' },
        component: () => System.import('../views/default/PageError.vue')
    },
    {
        path: '*',
        redirect: '/404'
    },
    {
        path: '/',
        name: 'main',
        meta: { layout: 'main' },
        component: Main
    },
    {
        path: '/about',
        name: 'about',
        meta: { layout: 'main' },
        component: () => System.import('../views/main/About.vue')
    },
    {
        path: '/login',
        name: 'login',
        meta: { layout: 'guest', title: 'Login' },
        component: () => System.import('../views/guest/Login.vue')
    },
    {
        path: '/signup',
        name: 'signup',
        meta: { layout: 'guest' },
        component: () => System.import('../views/guest/Signup.vue')
    },
    {
        path: '/verify-email',
        name: 'verify-email',
        meta: { layout: 'guest' },
        component: () => System.import('../views/guest/VerifyEmail.vue')
    },
    {
        path: '/reset-request',
        name: 'reset-request',
        meta: { layout: 'guest' },
        component: () => System.import('../views/guest/ResetRequest.vue')
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        meta: { layout: 'guest' },
        component: () => System.import('../views/guest/ResetPassword.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
