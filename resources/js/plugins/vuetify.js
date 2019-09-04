import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify);

export default new Vuetify({
    icons: {
        iconfont: 'fa',
    },
    theme: {
        themes: {
            light: {
                primary: '#d4ac71',
                secondary: '#324a58',
                accent: '#ccbd99',
                error: '#ff675f',
                info: '#35a9f3',
                success: '#77bc7a',
                warning: '#FFC107'
            },
        },
    }
})
