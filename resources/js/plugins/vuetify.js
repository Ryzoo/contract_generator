import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

export default new Vuetify({
    icons: {
        iconfont: 'fa',
    },
    theme: {
        themes: {
            light: {
                primary: '#4059be',
                secondary: '#4b2e7f',
                accent: '#995cfe',
                error: '#D42E37',
                info: '#35a9f3',
                success: '#77bc7a',
                warning: '#ffc107',
            },
            dark: {
                primary: '#4059be',
                secondary: '#4b2e7f',
                accent: '#995cfe',
                error: '#D42E37',
                info: '#35a9f3',
                success: '#77bc7a',
                warning: '#ffc107',
            },
        },
    },
})
