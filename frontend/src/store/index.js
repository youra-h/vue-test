import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user : {}
    },
    mutations: {
        auth_request(state){
            state.status = 'loading'
        },
        auth_success(state, token, user){
            state.status = 'success'
            state.token = token
            state.user = user
        },
        auth_error(state){
            state.status = 'error'
        },
        logout(state){
            state.status = ''
            state.token = ''
        },
    },
    getters : {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
    },
    actions: {
        login({commit}, user){
            return new Promise((resolve, reject) => {
                commit('auth_request')
                console.log(user);
                http.post('/rst/ok', user)
                    .then(resp => {
                        alert('qwe');
                        console.log(resp.data);
                        // console.log(resp.data.qwe);
                        // const token = resp.data.token
                        // const user = resp.data.user
                        // localStorage.setItem('token', token)
                        // // http.defaults.headers.common['Authorization'] = token
                        // commit('auth_success', token, user)
                        resolve(resp)
                    })
                    .catch(err => {
                        alert('asd');
                        console.log(err);
                        commit('auth_error')
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        },
        logout({commit}){
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.removeItem('token')
                delete http.defaults.headers.common['Authorization']
                resolve()
            })
        }
    },
    modules: {
    }
})
